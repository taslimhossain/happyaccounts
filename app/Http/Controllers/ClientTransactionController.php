<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ProjectTransaction;

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
        dd($request->all());
        $request->validated();
        // Get the current user id
        $user_id = Auth::id();
        $request->merge(['user_id' => $user_id]);

        do {
            $uuid = Str::uuid()->getInteger();
        } while (ProjectTransaction::where('uuid', $uuid)->exists() || OtherModel::where('uuid', $uuid)->exists());


        do {
            $uuid = Str::uuid()->getInteger();
        } while (ProjectTransaction::where('uuid', $uuid)->exists());

        $project_transaction                = new ProjectTransaction();
        $project_transaction->uuid          = $uuid;
        $project_transaction->project_title = $request->get('project_title');
        $project_transaction->reference     = $request->get('reference');
        $project_transaction->note          = $request->get('note');
        $project_transaction->user_id       = intval($request->get('user_id'));
        $project_transaction->project_id    = intval($request->get('project_id'));
        $project_transaction->client_id     = intval($request->get('client_id'));
        $project_transaction->banking_id    = intval($request->get('account'));

        dd($project_transaction);
        dd($request->all());



        DB::beginTransaction();

        try {
            $transaction_client->save();
            $transaction_bank->save();
            $transaction_vendor->save();
        
            DB::commit();
            
            // all three transactions were saved successfully
            return 'Success!';
        } catch (\Exception $e) {
            DB::rollback();
        
            // there was an error saving one or more transactions, so roll back
            // and delete the previously saved items
            $transaction_client->delete();
            $transaction_bank->delete();
            $transaction_vendor->delete();
        
            return 'Error: ' . $e->getMessage();
        }




        // try{
        //     if($project_transaction->save()){
        //         return to_route('project.index')->with(['message' => 'Success! Your project has been created.']);
        //     }
        // }
        // catch(\Exception $e){
        //     return to_route('project.create')->with(['status' => false, 'message' => 'Sorry something wrong, please try to create project again'])->withInput();
        // }
    }

}
