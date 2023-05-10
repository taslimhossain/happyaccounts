<?php

namespace App\Http\Controllers;

use \Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Banking;
use App\Models\BankTransaction;
use App\Models\OfficeTransaction;
use App\Models\Expenses_categories;
use App\Models\ProjectTransaction;
use App\Models\Project;
use App\Models\Vendor;
use App\Models\Client;
use App\Models\Staff;
use App\Models\VendorTransaction;
use App\Models\ClientTransaction;



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
            ->with('bankName:id,account_name')
            ->withDebitAndCreditTotals()
            ->latest()->get();

            if(request('is_print') && request('is_print') === 'yes'){
                return view('report.bank-transaction.bank-transaction-print', compact('transactions', 'bankings'));
            }
            return view('report.bank-transaction.bank-transaction-all', compact('transactions', 'bankings'));
        } else {
            $transactions = BankTransaction::with('globalTransaction:id,uuid')->with('bankName:id,account_name')->WithBalance()->latest()->paginate();
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
            ->with('bankName:id,account_name')
            ->with('getCategory:id,name')
            ->with('getStaff:id,name')
            ->withDebitAndCreditTotals()
            ->latest()->get();

            if(request('is_print') && request('is_print') === 'yes'){
                return view('report.office-transaction.transaction-print', compact('transactions', 'expenses_categories'));
            }
            return view('report.office-transaction.transaction-all', compact('transactions', 'expenses_categories'));
        } else {
            $transactions = OfficeTransaction::with('globalTransaction:id,uuid')
            ->with('bankName:id,account_name')
            ->with('getCategory:id,name')
            ->with('getStaff:id,name')
            ->latest()->paginate();
        }

        return view('report.office-transaction.transaction', compact('transactions', 'expenses_categories'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectTransaction(Request $request)
    {   

        $banking_id = $request->get('banking_id');
        $trans_type = $request->get('trans_type');
        $projects_id = $request->get('projects_id');
        $pay_to = $request->get('pay_to');
        $projects = Project::Active()->get();

        $expenses_categorie = $request->get('expenses_categorie');
        $expenses_categories = Expenses_categories::ProjectActive()->get();

        if(request()->has('is_filter') && $request->get('is_filter') == 'yes'){
            $transactions = ProjectTransaction::when(request()->has('start_date') && request()->has('end_date') &&  request('start_date') !== null && request('end_date') !== null, function ($query) {
                $startDate = $this->formatDate(request('start_date'));
                $endDate = $this->formatDate(request('end_date'));
                return $query->whereBetween('trans_date', [$startDate, $endDate]);
            })
            ->when(request()->has('projects_id')  && $projects_id !== 'all', function ($query) use ($projects_id) {
                return $projects_id === 'all' ? $query : $query->where('project_id', $projects_id);
            })
            ->when(request()->has('trans_type')  && $trans_type !== 'all', function ($query) use ($trans_type) {
                return $trans_type === 'all' ? $query : $query->where('trans_type', $trans_type);
            })
            ->when(request()->has('pay_to')  && $pay_to !== 'all', function ($query) use ($pay_to) {
                return $pay_to === 'all' ? $query : $query->where('expenses_for', $pay_to);
            })
            ->when(request()->has('expenses_categorie')  && $expenses_categorie !== 'all', function ($query) use ($expenses_categorie) {
                return $expenses_categorie === 'all' ? $query : $query->where('expenses_id', $expenses_categorie);
            })
            ->with('globalTransaction:id,uuid')
            ->with('bankName:id,account_name')
            ->with('projectName:id,project_title')
            ->with('vendorName:id,name')
            ->with('clientName:id,client_name')
            ->with(['projectTransaction' => function ($query) {
                $query->select('id', 'global_transaction_id', 'expenses_id');
                $query->with('expensesName:id,name');
            }])
            ->withDebitAndCreditTotals()
            ->latest()->get();

            if(request('is_print') && request('is_print') === 'yes'){
                return view('report.project-transaction.transaction-print', compact('transactions', 'projects', 'expenses_categories'));
            }
            return view('report.project-transaction.transaction-all', compact('transactions', 'projects', 'expenses_categories'));
        } else {
             $transactions = ProjectTransaction::with('globalTransaction:id,uuid')
            ->with('bankName:id,account_name')
            ->with('projectName:id,project_title')
            ->with('vendorName:id,name')
            ->with('clientName:id,client_name')
            ->with(['projectTransaction' => function ($query) {
                $query->select('id', 'global_transaction_id', 'expenses_id');
                $query->with('expensesName:id,name');
            }])
            ->latest()
            ->paginate();
        }

        return view('report.project-transaction.transaction', compact('transactions', 'projects', 'expenses_categories'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendorTransaction(Request $request)
    {   
        //dd($request->all());
        $vendor_id = $request->get('vendor_id');
        $trans_type = $request->get('trans_type');
        $projects_id = $request->get('projects_id');
        $projects = Project::Active()->get();
        $vendors = Vendor::Active()->get();

        if(request()->has('is_filter') && $request->get('is_filter') == 'yes'){
            $transactions = VendorTransaction::when(request()->has('start_date') && request()->has('end_date') &&  request('start_date') !== null && request('end_date') !== null, function ($query) {
                $startDate = $this->formatDate(request('start_date'));
                $endDate = $this->formatDate(request('end_date'));
                return $query->whereBetween('trans_date', [$startDate, $endDate]);
            })
            ->when(request()->has('projects_id')  && $projects_id !== 'all', function ($query) use ($projects_id) {
                return $projects_id === 'all' ? $query : $query->where('project_id', $projects_id);
            })
            ->when(request()->has('vendor_id')  && $vendor_id !== 'all', function ($query) use ($vendor_id) {
                return $vendor_id === 'all' ? $query : $query->where('vendor_id', $vendor_id);
            })
            ->when(request()->has('trans_type')  && $trans_type !== 'all', function ($query) use ($trans_type) {
                return $trans_type === 'all' ? $query : $query->where('trans_type', $trans_type);
            })
            ->with('globalTransaction:id,uuid')
            ->with('bankName:id,account_name')
            ->with('projectName:id,project_title')
            ->with('vendorName:id,name')
            ->with(['projectTransaction' => function ($query) {
                $query->select('id', 'global_transaction_id', 'expenses_id');
                $query->with('expensesName:id,name');
            }])
            ->withDebitAndCreditTotals()
            ->latest()->get();

            if(request('is_print') && request('is_print') === 'yes'){
                return view('report.vendor-transaction.transaction-print', compact('transactions', 'projects', 'vendors'));
            }
            return view('report.vendor-transaction.transaction-all', compact('transactions', 'projects', 'vendors'));
        } else {

            $transactions = VendorTransaction::with('globalTransaction:id,uuid')
            ->with('bankName:id,account_name')
            ->with('projectName:id,project_title')
            ->with('vendorName:id,name')
            ->with(['projectTransaction' => function ($query) {
                $query->select('id', 'global_transaction_id', 'expenses_id');
                $query->with('expensesName:id,name');
            }])
            ->latest()
            ->paginate();
        }

        return view('report.vendor-transaction.transaction', compact('transactions', 'projects', 'vendors'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientTransaction(Request $request)
    {   
        //dd($request->all());
        $client_id = $request->get('client_id');
        $trans_type = $request->get('trans_type');
        $projects_id = $request->get('projects_id');
        $projects = Project::Active()->get();
        $clients = Client::Active()->get();

        if(request()->has('is_filter') && $request->get('is_filter') == 'yes'){
            $transactions = ClientTransaction::when(request()->has('start_date') && request()->has('end_date') &&  request('start_date') !== null && request('end_date') !== null, function ($query) {
                $startDate = $this->formatDate(request('start_date'));
                $endDate = $this->formatDate(request('end_date'));
                return $query->whereBetween('trans_date', [$startDate, $endDate]);
            })
            ->when(request()->has('projects_id')  && $projects_id !== 'all', function ($query) use ($projects_id) {
                return $projects_id === 'all' ? $query : $query->where('project_id', $projects_id);
            })
            ->when(request()->has('client_id')  && $client_id !== 'all', function ($query) use ($client_id) {
                return $client_id === 'all' ? $query : $query->where('client_id', $client_id);
            })
            ->with('globalTransaction:id,uuid')
            ->with('bankName:id,account_name')
            ->with('projectName:id,project_title')
            ->with('clientName:id,client_name')
            ->withDebitAndCreditTotals()
            ->latest()->get();

            if(request('is_print') && request('is_print') === 'yes'){
                return view('report.client-transaction.transaction-print', compact('transactions', 'projects', 'clients'));
            }
            return view('report.client-transaction.transaction-all', compact('transactions', 'projects', 'clients'));
        } else {
             $transactions = ClientTransaction::with('globalTransaction:id,uuid')->with('bankName:id,account_name')->with('projectName:id,project_title')->with('clientName:id,client_name')->latest()->paginate();
        }

        return view('report.client-transaction.transaction', compact('transactions', 'projects', 'clients'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staffTransaction(Request $request)
    {   
        //dd($request->all());
        $staff_id = $request->get('staff_id');
        $staffs = Staff::active()->get();

        $expenses_categorie = $request->get('expenses_categorie');
        $expenses_categories = Expenses_categories::OfficeActive()->get();

        if(request()->has('is_filter') && $request->get('is_filter') == 'yes'){
            $transactions = OfficeTransaction::where('is_salary', 'yes')
            ->when(request()->has('start_date') && request()->has('end_date') &&  request('start_date') !== null && request('end_date') !== null, function ($query) {
                $startDate = $this->formatDate(request('start_date'));
                $endDate = $this->formatDate(request('end_date'));
                return $query->whereBetween('trans_date', [$startDate, $endDate]);
            })
            ->when(request()->has('staff_id')  && $staff_id !== 'all', function ($query) use ($staff_id) {
                return $staff_id === 'all' ? $query : $query->where('staff_id', $staff_id);
            })
            ->with('globalTransaction:id,uuid')
            ->with('getStaff:id,name')
            ->with('bankName:id,account_name')
            ->withDebitAndCreditTotals()
            ->latest()->get();

            if(request('is_print') && request('is_print') === 'yes'){
                return view('report.staff-transaction.transaction-print', compact('transactions', 'staffs'));
            }
            return view('report.staff-transaction.transaction-all', compact('transactions', 'staffs'));
        } else {
            $transactions = OfficeTransaction::where('is_salary', 'yes')->with('globalTransaction:id,uuid')->with('getStaff:id,name')->with('bankName:id,account_name')->latest()->paginate();
        }

        return view('report.staff-transaction.transaction', compact('transactions', 'staffs'));
    }

}
