<?php

namespace App\Http\Controllers;

use \Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Banking;
use App\Models\BankTransaction;
use App\Models\OfficeTransaction;
use App\Models\Expenses_categories;



class ReportController extends Controller
{

    /*
    * Format date
    */
    public function formatDate($date = null)
    {
        if(!$date){
            return;
        }
       return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bankTransaction(Request $request)
    {   
        //dd($request->all());
        $banking_id = $request->get('banking_id');
        $trans_type = $request->get('trans_type');
        $bankings = Banking::active()->get();

        if(request()->has('is_filter') && $request->get('is_filter') == 'yes'){
        $transactions = BankTransaction::when(request()->has('start_date') && request()->has('end_date') &&  request('start_date') !== null && request('end_date') !== null, function ($query) {
                $startDate = $this->formatDate(request('start_date'));
                $endDate = $this->formatDate(request('end_date'));
                return $query->whereBetween('trans_date', [$startDate, $endDate]);
            })
            ->when(request()->has('banking_id')  && $banking_id !== 'all', function ($query) use ($banking_id) {
                return $banking_id === 'all' ? $query : $query->where('banking_id', $banking_id);
            })
            ->when(request()->has('trans_type')  && $trans_type !== 'all', function ($query) use ($trans_type) {
                return $trans_type === 'all' ? $query : $query->where('trans_type', $trans_type);
            })
            ->with('globalTransaction:id,uuid')
            ->withDebitAndCreditTotals()
            ->latest()->get();

            if(request('is_print') && request('is_print') === 'yes'){
                return view('report.bank-transaction.bank-transaction-print', compact('transactions', 'bankings'));
            }
            return view('report.bank-transaction.bank-transaction-all', compact('transactions', 'bankings'));
        } else {
            $transactions = BankTransaction::with('globalTransaction:id,uuid')->WithBalance()->latest()->paginate();
        }

        return view('report.bank-transaction.bank-transaction', compact('transactions', 'bankings'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function officeTransaction(Request $request)
    {   
        //dd($request->all());
        $banking_id = $request->get('banking_id');
        $trans_type = $request->get('trans_type');
        $bankings = Banking::active()->get();

        $expenses_categorie = $request->get('expenses_categorie');
        $expenses_categories = Expenses_categories::OfficeActive()->get();

        if(request()->has('is_filter') && $request->get('is_filter') == 'yes'){
            $transactions = OfficeTransaction::when(request()->has('start_date') && request()->has('end_date') &&  request('start_date') !== null && request('end_date') !== null, function ($query) {
                $startDate = $this->formatDate(request('start_date'));
                $endDate = $this->formatDate(request('end_date'));
                return $query->whereBetween('trans_date', [$startDate, $endDate]);
            })
            ->when(request()->has('expenses_categorie')  && $expenses_categorie !== 'all', function ($query) use ($expenses_categorie) {
                return $expenses_categorie === 'all' ? $query : $query->where('expenses_id', $expenses_categorie);
            })
            ->with('globalTransaction:id,uuid')
            ->withDebitAndCreditTotals()
            ->latest()->get();

            if(request('is_print') && request('is_print') === 'yes'){
                return view('report.office-transaction.transaction-print', compact('transactions', 'expenses_categories'));
            }
            return view('report.office-transaction.transaction-all', compact('transactions', 'expenses_categories'));
        } else {
            $transactions = OfficeTransaction::with('globalTransaction:id,uuid')->latest()->paginate();
        }

        return view('report.office-transaction.transaction', compact('transactions', 'expenses_categories'));

    }
}
