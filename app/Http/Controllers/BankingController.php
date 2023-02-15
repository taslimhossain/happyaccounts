<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Banking;
use App\Http\Requests\StoreBankingRequest;
use App\Http\Requests\UpdateBankingRequest;

class BankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankings = Banking::latest()->paginate();
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
}
