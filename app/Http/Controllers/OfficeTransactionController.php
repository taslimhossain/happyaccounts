<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\StoreSalaryRequest;
use Illuminate\Http\Request;
use App\Models\Expenses_categories;
use App\Models\Banking;
use App\Models\GlobalTransaction;
use App\Models\OfficeTransaction;
use App\Models\BankTransaction;

class OfficeTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $transactions = OfficeTransaction::with(['globalTransaction' => function ($query) {
            $query->select('id', 'uuid');
        }])
         ->with(['getCategory' => function ($query) {
            $query->select('id', 'name');
        }])
         ->office()
         ->latest()
         ->paginate();
         return view('expenses.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenses_cateogrys = Expenses_categories::where('expenses_for', 'office')->active()->get();
        $bankings = Banking::active()->get();
        return view('expenses.create', compact('expenses_cateogrys', 'bankings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalaryRequest $request)
    {
        $request->validated();
        // Get the current user id
        $user_id = Auth::id();
        $request->merge(['user_id' => $user_id]);
        $request->merge(['is_salary' => 'no']);

        // Start a database transaction
        DB::beginTransaction();
        try {
            // Start Global Transaction
            do {
                $globalTransaction_uuid = Str::substr(Str::uuid()->getInteger(), 0, 15);
            } while (GlobalTransaction::where('uuid', $globalTransaction_uuid)->exists());
            
            $global_transaction             = new GlobalTransaction();
            $global_transaction->uuid       = $globalTransaction_uuid;
            $global_transaction->title      = $request->get('transaction_type');
            $global_transaction->reference  = $request->get('reference');
            $global_transaction->banking_id = $request->get('account');
            $global_transaction->amount     = intval($request->get('amount'));
            $global_transaction->trans_date = $request->get('trans_date');
            $global_transaction->user_id    = $request->get('user_id');

            try{
                if($global_transaction->save()){
                    $global_transaction_id = $global_transaction->id;
                }
            } catch(\Exception $e){
                DB::rollBack();
                if(isset($global_transaction)){
                    $global_transaction->delete();
                }
                return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong in global transaction, please try to create transaction again'])->withInput();
            }
            // End Global Transaction


            // Start Project Transaction
            do {
                $officeuuid = Str::substr(Str::uuid()->getInteger(), 0, 15);
            } while (OfficeTransaction::where('uuid', $officeuuid)->exists());

            $office_transaction                        = new OfficeTransaction();
            $office_transaction->uuid                  = $officeuuid;
            $office_transaction->global_transaction_id = $global_transaction_id;
            $office_transaction->title                 = $request->get('transaction_type');
            $office_transaction->particulars           = isset(Constant::getTransactions()[$request->get('transaction_type')]) ? Constant::getTransactions()[$request->get('transaction_type')] : 'office transaction dev mistake';
            $office_transaction->reference             = $request->get('reference');
            $office_transaction->note                  = $request->get('note');
            $office_transaction->user_id               = intval($request->get('user_id'));
            $office_transaction->expenses_id           = intval($request->get('expenses_id'));
            $office_transaction->banking_id            = intval($request->get('account'));
            $office_transaction->is_salary             = $request->get('is_salary');

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['office_expenses']){
                $office_transaction->debit_amount  = intval($request->get('amount'));
                $office_transaction->credit_amount = 0;
                $office_transaction->trans_type    = 'debit';
            }

            try{
                if($office_transaction->save()){
                    $office_transaction_id = $office_transaction->id;
                }
            } catch(\Exception $e){
                DB::rollBack();
                if(isset($global_transaction)){
                    $global_transaction->delete();
                }
                if(isset($office_transaction)){
                    $office_transaction->delete();
                }
                return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong in office transaction, please try to create transaction again'])->withInput();
            }

            // Start Bank Transaction
            do {
                $bankTransaction_uuid = Str::substr(Str::uuid()->getInteger(), 0, 15);
            } while (BankTransaction::where('uuid', $bankTransaction_uuid)->exists());

            $bank_transaction                        = new BankTransaction();
            $bank_transaction->uuid                  = $bankTransaction_uuid;
            $bank_transaction->global_transaction_id = $global_transaction_id;
            $bank_transaction->reference             = $request->get('reference');
            $bank_transaction->title                 = $request->get('transaction_type');
            $bank_transaction->particulars           = isset(Constant::getTransactions()[$request->get('transaction_type')]) ? Constant::getTransactions()[$request->get('transaction_type')] : 'Bank transaction dev mistake';

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['office_expenses']){
                $bank_transaction->debit_amount  = intval($request->get('amount'));
                $bank_transaction->credit_amount = 0;
                $bank_transaction->trans_type  = 'debit';
            }

            $bank_transaction->banking_id = $request->get('account');
            $bank_transaction->user_id    = $request->get('user_id');
            $bank_transaction->trans_date = $request->get('trans_date');
            $bank_transaction->note       = $request->get('note');

            try{
                $bank_transaction->save();
            } catch(\Exception $e){
                DB::rollBack();
                if(isset($global_transaction)){
                    $global_transaction->delete();
                }
                if(isset($office_transaction)){
                    $office_transaction->delete();
                }
                if(isset($bank_transaction)){
                    $bank_transaction->delete();
                }
                return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong in bank account, please try to create transaction again'])->withInput();
            }
            // End From Bank Transaction

            DB::commit();
            return redirect()->back()->with(['message' => 'Success! Your transaction has been created.']);

        } catch (Exception $e) {
            DB::rollBack();
            if(isset($global_transaction)){
                $global_transaction->delete();
            }
            if(isset($office_transaction)){
                $office_transaction->delete();
            }
            if(isset($bank_transaction)){
                $bank_transaction->delete();
            }      
            return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, please try to create  transaction again'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
