<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->paginate();
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $request->validated();
        do {
            $uuid = Str::uuid()->toString();
        } while (Client::where('uuid', $uuid)->exists());

        $client                  = new Client();
        $client->uuid            = $uuid;
        $client->client_name     = $request->get('client_name');
        $client->phone           = $request->get('phone');
        $client->phone_2         = $request->get('phone_2');
        $client->email           = $request->get('email');
        $client->address         = $request->get('address');
        $client->billing_name    = $request->get('billing_name');
        $client->billing_phone   = $request->get('billing_phone');
        $client->billing_phone   = $request->get('billing_address');
        $client->billing_address = $request->get('billing_phone');
        $client->description     = $request->get('description');
        $client->status          = $request->get('status');

        try{
            if($client->save()){
                return to_route('client.index')->with(['message' => 'Success! Your client account has been created.']);
            }
        }
        catch(\Exception $e){
            return to_route('client.create')->with(['status' => false, 'message' => 'Sorry something wrong, please try to create client account again'])->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $request->validated();
        $client->client_name     = $request->get('client_name');
        $client->phone           = $request->get('phone');
        $client->phone_2         = $request->get('phone_2');
        $client->email           = $request->get('email');
        $client->address         = $request->get('address');
        $client->billing_name    = $request->get('billing_name');
        $client->billing_phone   = $request->get('billing_phone');
        $client->billing_phone   = $request->get('billing_address');
        $client->billing_address = $request->get('billing_phone');
        $client->description     = $request->get('description');
        $client->status          = $request->get('status');

        try{
            if($client->update()){
                return redirect()->back()->with(['message' => 'Success! Your client account has been updated.']);
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, please try to update client account again'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        try{
            if($client->delete()){
                return redirect()->back()->with(['message' => 'Client account deleted successfully']);
            }
        }
        catch(\Exception $e){
             return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, An error occurred while delete Client account']);
        }
    }
}
