<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Banking;
use App\Models\GlobalTransaction;
use App\Models\BankTransaction;
use App\Http\Requests\StoreBankingRequest;
use App\Http\Requests\UpdateBankingRequest;
use App\Http\Requests\DepositTransactionStoreRequest;
use App\Helpers\Constant;

class BankingController extends Controller
{

    /*
    * Get project details here
    *
    * @return \App\Models\Project
    */
    protected function getBank()
    {
        $bank_uuid = request()->route('uuid');
        return Banking::where('uuid', $bank_uuid)->firstOrFail();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankings = Banking::withSum('Transaction', 'bank_transactions.debit_amount')
                                    ->withSum('Transaction', 'bank_transactions.credit_amount')
                                    ->latest()
                                    ->paginate();
        return view('banking.index', compact('bankings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBankingRequest  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(StoreBankingRequest $request)
    public function store(StoreBankingRequest $request)
    {

        $request->validated();
        do {
            $uuid = Str::uuid()->toString();
        } while (Banking::where('uuid', $uuid)->exists());

        $banking                  = new Banking();
        $banking->uuid            = $uuid;
        $banking->bank_name       = $request->get('bank_name');
        $banking->branch          = $request->get('branch');
        $banking->account_name    = $request->get('account_name');
        $banking->account_number  = $request->get('account_number');
        $banking->initial_balance = $request->get('initial_balance');

        try{
            if($banking->save()){
                return to_route('banking.index')->with(['message' => 'Bank account add successfully']);
            }
        }
        catch(\Exception $e){
            return to_route('banking.create')->with(['status' => false, 'message' => 'Sorry something wrong, please try to add bank account again'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banking  $banking
     * @return \Illuminate\Http\Response
     */
    public function show(Banking $banking)
    {
        return view('banking.show', compact('banking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banking  $banking
     * @return \Illuminate\Http\Response
     */
    public function edit(Banking $banking)
    {
        return view('banking.edit', compact('banking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBankingRequest  $request
     * @param  \App\Models\Banking  $banking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankingRequest $request, Banking $banking)
    {
        $request->validated();
        $banking->bank_name       = $request->get('bank_name');
        $banking->branch          = $request->get('branch');
        $banking->account_name    = $request->get('account_name');
        $banking->account_number  = $request->get('account_number');
        $banking->initial_balance = $request->get('initial_balance');
        
        try{
            if($banking->update()){
                return redirect()->back()->with(['message' => 'Bank account update successfully']);
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, please try to update bank account again']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banking  $banking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banking $banking)
    {
        try{
            if($banking->delete()){
                return redirect()->back()->with(['message' => 'Bank account deleted successfully']);
            }
        }
        catch(\Exception $e){
             //return redirect()->back()->with('message', 'Sorry something wrong, An error occurred while delete bank account');
             return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, An error occurred while delete bank account']);
        }
    }


    /**
     * Show the form for creating a new deposit transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function depositTransaction()
    {
        $bankings = Banking::active()->get();
        if (request()->route('uuid')) {
            $bank     = $this->getBank();
            return view('banking.transaction.transaction-deposit', compact('bankings', 'bank'));
        }
        return view('banking.transaction.transaction-deposit', compact('bankings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DepositTransactionStoreRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function depositTransactionStore(DepositTransactionStoreRequest $request)
    {
        // dd(Constant::getTransactions()[$request->get('transaction_type')]);
        $request->validated();
        //dd($request->all());

        // Get the current user id
        $user_id = Auth::id();
        $request->merge(['user_id' => $user_id]);

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
        $global_transaction->save();
        $global_transaction_id = $global_transaction->id;
        // End Global Transaction

        // Start Global Transaction
        do {
            $bankTransaction_uuid = Str::substr(Str::uuid()->getInteger(), 0, 15);
        } while (BankTransaction::where('uuid', $bankTransaction_uuid)->exists());

        $bank_transaction                        = new BankTransaction();
        $bank_transaction->uuid                  = $bankTransaction_uuid;
        $bank_transaction->global_transaction_id = $global_transaction_id;
        $bank_transaction->reference             = $request->get('reference');
        $bank_transaction->title                 = $request->get('transaction_type');
        $bank_transaction->particulars           = isset(Constant::getTransactions()[$request->get('transaction_type')]) ? Constant::getTransactions()[$request->get('transaction_type')] : 'Bank transaction dev mistake';
        
        if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['bank_deposit']){
            $bank_transaction->debit_amount          = 0;
            $bank_transaction->credit_amount = intval($request->get('amount'));
        }

        if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['cash_withdrawal']){
            $bank_transaction->credit_amount          = 0;
            $bank_transaction->debit_amount = intval($request->get('amount'));
        }

        $bank_transaction->banking_id = $request->get('account');
        $bank_transaction->user_id    = $request->get('user_id');
        $bank_transaction->trans_date = $request->get('trans_date');
        $bank_transaction->note       = $request->get('note');
        $bank_transaction->save();
        // End Global Transaction


        // dd($global_transaction);
    }

    /**
     * Show the form for creating a new withdraw transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdrawTransaction()
    {

        $bankings = Banking::active()->get();
        if (request()->route('uuid')) {
            $bank     = $this->getBank();
            return view('banking.transaction.transaction-withdraw', compact('bankings', 'bank'));
        }
        return view('banking.transaction.transaction-withdraw', compact('bankings'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function BankTransactionList()
    {

        $transactions = BankTransaction::BankTransactionList();
        if (request()->route('uuid')) {
            $bank     = $this->getBank();
            $transactions = BankTransaction::Bank($bank->id)->BankTransactionList();
            //$transactions = BankTransaction::with('globalTransaction')->WithBalance()->Bank($bank->id)->oldest()->paginate();
        }
        return view('banking.transaction.transaction-list', compact('transactions'));
    }    

}
