<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::latest()->paginate();
        return view('vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorRequest $request)
    {
        $request->validated();
        do {
            $uuid = Str::uuid()->toString();
        } while (Vendor::where('uuid', $uuid)->exists());

        $vendor                  = new Vendor();
        $vendor->uuid            = $uuid;
        $vendor->name            = $request->get('name');
        $vendor->phone           = $request->get('phone');
        $vendor->phone_2         = $request->get('phone_2');
        $vendor->email           = $request->get('email');
        $vendor->address         = $request->get('address');
        $vendor->billing_name    = $request->get('billing_name');
        $vendor->billing_phone   = $request->get('billing_phone');
        $vendor->billing_phone   = $request->get('billing_address');
        $vendor->billing_address = $request->get('billing_phone');
        $vendor->description     = $request->get('description');
        $vendor->status          = $request->get('status');

        try{
            if($vendor->save()){
                return to_route('vendor.index')->with(['message' => 'Success!  Vendor account has been created.']);
            }
        }
        catch(\Exception $e){
            return to_route('vendor.create')->with(['status' => false, 'message' => 'Sorry something wrong, please try to create vendor account again'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('vendor.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorRequest  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $request->validated();
        $vendor->name            = $request->get('name');
        $vendor->phone           = $request->get('phone');
        $vendor->phone_2         = $request->get('phone_2');
        $vendor->email           = $request->get('email');
        $vendor->address         = $request->get('address');
        $vendor->billing_name    = $request->get('billing_name');
        $vendor->billing_phone   = $request->get('billing_phone');
        $vendor->billing_phone   = $request->get('billing_address');
        $vendor->billing_address = $request->get('billing_phone');
        $vendor->description     = $request->get('description');
        $vendor->status          = $request->get('status');

        try{
            if($vendor->update()){
                return redirect()->back()->with(['message' => 'Success! Vendor account has been updated.']);
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, please try to update vendor account again'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        try{
            if($vendor->delete()){
                return redirect()->back()->with(['message' => 'Vendor account deleted successfully']);
            }
        }
        catch(\Exception $e){
             return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, An error occurred while delete vendor account']);
        }
    }
}
