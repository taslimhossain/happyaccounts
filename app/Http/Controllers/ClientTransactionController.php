<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ProjectTransaction;
use App\Models\GlobalTransaction;
use App\Models\BankTransaction;
use App\Models\ClientTransaction;
use App\Helpers\Constant;
use App\Http\Requests\StoreClientTransactionRequest;

use Illuminate\Http\Request;

class ClientTransactionController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientTransactionRequest $request)
    {

        // dd($request->all());
        $request->validated();
        // Get the current user id
        $user_id = Auth::id();
        $request->merge(['user_id' => $user_id]);

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
            $global_transaction->client_id  = $request->get('client_id');
            $global_transaction->project_id            = intval($request->get('project_id'));

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
                $uuid = Str::substr(Str::uuid()->getInteger(), 0, 15);
            } while (ProjectTransaction::where('uuid', $uuid)->exists());

            $project_transaction                        = new ProjectTransaction();
            $project_transaction->uuid                  = $uuid;
            $project_transaction->global_transaction_id = $global_transaction_id;
            $project_transaction->title                 = $request->get('transaction_type');
            $project_transaction->particulars           = isset(Constant::getTransactions()[$request->get('transaction_type')]) ? Constant::getTransactions()[$request->get('transaction_type')] : 'Bank transaction dev mistake';
            $project_transaction->reference             = $request->get('reference');
            $project_transaction->note                  = $request->get('note');
            $project_transaction->user_id               = intval($request->get('user_id'));
            $project_transaction->project_id            = intval($request->get('project_id'));
            $project_transaction->client_id             = intval($request->get('client_id'));
            $project_transaction->banking_id            = intval($request->get('account'));

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['get_from_client']){
                $project_transaction->debit_amount          = 0;
                $project_transaction->credit_amount = intval($request->get('amount'));
                $project_transaction->trans_type  = 'credit';
            }

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['return_to_client']){
                $project_transaction->debit_amount  = intval($request->get('amount'));
                $project_transaction->credit_amount = 0;
                $project_transaction->trans_type  = 'debit';
            }

            try{
                if($project_transaction->save()){
                    $project_transaction_id = $project_transaction->id;
                }
            } catch(\Exception $e){
                dd($e->getMessage());
                DB::rollBack();
                if(isset($global_transaction)){
                    $global_transaction->delete();
                }
                if(isset($project_transaction)){
                    $project_transaction->delete();
                }
                return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong in project transaction, please try to create transaction again'])->withInput();
            }

            // End Project Transaction

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

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['get_from_client']){
                $bank_transaction->debit_amount  = 0;
                $bank_transaction->credit_amount = intval($request->get('amount'));
                $bank_transaction->trans_type  = 'credit';
            }

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['return_to_client']){
                $bank_transaction->debit_amount  = intval($request->get('amount'));
                $bank_transaction->credit_amount = 0;
                $bank_transaction->trans_type  = 'debit';
            }

            $bank_transaction->banking_id = $request->get('account');
            $bank_transaction->project_id            = intval($request->get('project_id'));
            $bank_transaction->user_id    = $request->get('user_id');
            $bank_transaction->client_id  = intval($request->get('client_id'));
            $bank_transaction->trans_date = $request->get('trans_date');
            $bank_transaction->note       = $request->get('note');

            try{
                $bank_transaction->save();
            } catch(\Exception $e){
                DB::rollBack();
                if(isset($global_transaction)){
                    $global_transaction->delete();
                }
                if(isset($project_transaction)){
                    $project_transaction->delete();
                }
                if(isset($bank_transaction)){
                    $bank_transaction->delete();
                }
                return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong in bank account, please try to create transaction again'])->withInput();
            }
            // End From Bank Transaction

            // Start Client Transaction
            do {
                $clientTransaction_uuid = Str::substr(Str::uuid()->getInteger(), 0, 15);
            } while (ClientTransaction::where('uuid', $clientTransaction_uuid)->exists());

            $client_transaction                        = new ClientTransaction();
            $client_transaction->uuid                  = $clientTransaction_uuid;
            $client_transaction->global_transaction_id = $global_transaction_id;
            $client_transaction->reference             = $request->get('reference');
            $client_transaction->title                 = $request->get('transaction_type');
            $client_transaction->particulars           = isset(Constant::getTransactions()[$request->get('transaction_type')]) ? Constant::getTransactions()[$request->get('transaction_type')] : 'Bank transaction dev mistake';

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['get_from_client']){
                $client_transaction->debit_amount  = 0;
                $client_transaction->credit_amount = intval($request->get('amount'));
                $client_transaction->trans_type  = 'credit';
            }

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['return_to_client']){
                $client_transaction->debit_amount  = intval($request->get('amount'));
                $client_transaction->credit_amount = 0;
                $client_transaction->trans_type  = 'debit';
            }

            $client_transaction->banking_id = $request->get('account');
            $client_transaction->project_id = intval($request->get('project_id'));
            $client_transaction->user_id    = $request->get('user_id');
            $client_transaction->client_id  = intval($request->get('client_id'));
            $client_transaction->trans_date = $request->get('trans_date');
            $client_transaction->note       = $request->get('note');

            try{
                $client_transaction->save();
            } catch(\Exception $e){
                DB::rollBack();
                if(isset($global_transaction)){
                    $global_transaction->delete();
                }
                if(isset($project_transaction)){
                    $project_transaction->delete();
                }
                if(isset($bank_transaction)){
                    $bank_transaction->delete();
                }
                if(isset($client_transaction)){
                    $client_transaction->delete();
                }
                return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong in client account, please try to create transaction again'])->withInput();
            }
            // End Client Transaction

            DB::commit();
            return redirect()->back()->with(['message' => 'Success! Your transaction has been created.']);

        } catch (Exception $e) {
            DB::rollBack();
            if(isset($global_transaction)){
                $global_transaction->delete();
            }
            if(isset($project_transaction)){
                $project_transaction->delete();
            }
            if(isset($bank_transaction)){
                $bank_transaction->delete();
            }
            if(isset($client_transaction)){
                $client_transaction->delete();
            }            
            return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, please try to create  transaction again'])->withInput();
        }

    }

}
