<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ProjectTransaction;
use App\Models\GlobalTransaction;
use App\Models\BankTransaction;
use App\Models\VendorTransaction;
use App\Helpers\Constant;
use App\Http\Requests\StoreVendorTransactionRequest;
use App\Http\Requests\StoreOtherTransactionRequest;

use Illuminate\Http\Request;

class VendorTransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendorTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorTransactionRequest $request)
    {

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
            $global_transaction->vendor_id  = intval($request->get('vendor_id'));
            $global_transaction->project_id = intval($request->get('project_id'));

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
            $project_transaction->particulars           = isset(Constant::getTransactions()[$request->get('transaction_type')]) ? Constant::getTransactions()[$request->get('transaction_type')] : 'Project transaction dev mistake';
            $project_transaction->reference             = $request->get('reference');
            $project_transaction->note                  = $request->get('note');
            $project_transaction->user_id               = intval($request->get('user_id'));
            $project_transaction->project_id            = intval($request->get('project_id'));
            $project_transaction->vendor_id             = intval($request->get('vendor_id'));
            $project_transaction->banking_id            = intval($request->get('account'));
            $project_transaction->expenses_id           = intval($request->get('expenses_cateogry'));

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['return_from_vendor']){
                $project_transaction->debit_amount          = 0;
                $project_transaction->credit_amount = intval($request->get('amount'));
                $project_transaction->trans_type  = 'credit';
            }

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['pay_to_vendor']){
                $project_transaction->debit_amount  = intval($request->get('amount'));
                $project_transaction->credit_amount = 0;
                $project_transaction->trans_type  = 'debit';
            }

            try{
                if($project_transaction->save()){
                    $project_transaction_id = $project_transaction->id;
                }
            } catch(\Exception $e){
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

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['return_from_vendor']){
                $bank_transaction->debit_amount  = 0;
                $bank_transaction->credit_amount = intval($request->get('amount'));
                $bank_transaction->trans_type  = 'credit';
            }

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['pay_to_vendor']){
                $bank_transaction->debit_amount  = intval($request->get('amount'));
                $bank_transaction->credit_amount = 0;
                $bank_transaction->trans_type  = 'debit';
            }

            $bank_transaction->banking_id = $request->get('account');
            $bank_transaction->project_id = intval($request->get('project_id'));
            $bank_transaction->user_id    = $request->get('user_id');
            $bank_transaction->vendor_id  = intval($request->get('vendor_id'));
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
                $vendorTransaction_uuid = Str::substr(Str::uuid()->getInteger(), 0, 15);
            } while (VendorTransaction::where('uuid', $vendorTransaction_uuid)->exists());

            $vendor_transaction                        = new VendorTransaction();
            $vendor_transaction->uuid                  = $vendorTransaction_uuid;
            $vendor_transaction->global_transaction_id = $global_transaction_id;
            $vendor_transaction->reference             = $request->get('reference');
            $vendor_transaction->title                 = $request->get('transaction_type');
            $vendor_transaction->particulars           = isset(Constant::getTransactions()[$request->get('transaction_type')]) ? Constant::getTransactions()[$request->get('transaction_type')] : 'Bank transaction dev mistake';

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['return_from_vendor']){
                $vendor_transaction->debit_amount  = 0;
                $vendor_transaction->credit_amount = intval($request->get('amount'));
                $vendor_transaction->trans_type  = 'credit';
            }

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['pay_to_vendor']){
                $vendor_transaction->debit_amount  = intval($request->get('amount'));
                $vendor_transaction->credit_amount = 0;
                $vendor_transaction->trans_type  = 'debit';
            }

            $vendor_transaction->banking_id = $request->get('account');
            $vendor_transaction->project_id = intval($request->get('project_id'));
            $vendor_transaction->user_id    = $request->get('user_id');
            $vendor_transaction->vendor_id  = intval($request->get('vendor_id'));
            $vendor_transaction->trans_date = $request->get('trans_date');
            $vendor_transaction->note       = $request->get('note');

            try{
                $vendor_transaction->save();
            } catch(\Exception $e){
                dd($e->getMessage());
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
                if(isset($vendor_transaction)){
                    $vendor_transaction->delete();
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
            if(isset($vendor_transaction)){
                $vendor_transaction->delete();
            }            
            return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, please try to create  transaction again'])->withInput();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOtherTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function otherstore(StoreOtherTransactionRequest $request)
    {

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
            $global_transaction->project_id = intval($request->get('project_id'));

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
            $project_transaction->particulars           = isset(Constant::getTransactions()[$request->get('transaction_type')]) ? Constant::getTransactions()[$request->get('transaction_type')] : 'Project transaction dev mistake';
            $project_transaction->reference             = $request->get('reference');
            $project_transaction->note                  = $request->get('note');
            $project_transaction->user_id               = intval($request->get('user_id'));
            $project_transaction->project_id            = intval($request->get('project_id'));
            $project_transaction->banking_id            = intval($request->get('account'));
            $project_transaction->expenses_id           = intval($request->get('expenses_cateogry'));

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['return_from_vendor']){
                $project_transaction->debit_amount          = 0;
                $project_transaction->credit_amount = intval($request->get('amount'));
                $project_transaction->trans_type  = 'credit';
            }

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['pay_to_vendor']){
                $project_transaction->debit_amount  = intval($request->get('amount'));
                $project_transaction->credit_amount = 0;
                $project_transaction->trans_type  = 'debit';
            }

            try{
                if($project_transaction->save()){
                    $project_transaction_id = $project_transaction->id;
                }
            } catch(\Exception $e){
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

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['return_from_vendor']){
                $bank_transaction->debit_amount  = 0;
                $bank_transaction->credit_amount = intval($request->get('amount'));
                $bank_transaction->trans_type  = 'credit';
            }

            if(intval($request->get('transaction_type')) === Constant::TRANSACTIONS['pay_to_vendor']){
                $bank_transaction->debit_amount  = intval($request->get('amount'));
                $bank_transaction->credit_amount = 0;
                $bank_transaction->trans_type  = 'debit';
            }

            $bank_transaction->banking_id = $request->get('account');
            $bank_transaction->project_id = intval($request->get('project_id'));
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
                if(isset($project_transaction)){
                    $project_transaction->delete();
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
            if(isset($project_transaction)){
                $project_transaction->delete();
            }
            if(isset($bank_transaction)){
                $bank_transaction->delete();
            }         
            return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, please try to create  transaction again'])->withInput();
        }

    }

}
