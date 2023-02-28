<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::latest()->paginate();
        return view('staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStaffRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStaffRequest $request)
    {
        $request->validated();
        do {
            $uuid = Str::uuid()->toString();
        } while (Staff::where('uuid', $uuid)->exists());

        $staff                 = new Staff();
        $staff->uuid           = $uuid;
        $staff->name           = $request->get('name');
        $staff->phone          = $request->get('phone');
        $staff->email          = $request->get('email');
        $staff->address        = $request->get('address');
        $staff->start_date     = $request->get('start_date');
        $staff->end_date       = $request->get('end_date');
        $staff->sallery_amount = $request->get('sallery_amount');
        $staff->status         = $request->get('status');
        $staff->description    = $request->get('description');

        try{
            if($staff->save()){
                return to_route('staff.index')->with(['message' => 'Success! Staff account has been created.']);
            }
        }
        catch(\Exception $e){
            return to_route('staff.create')->with(['status' => false, 'message' => 'Sorry something wrong, please try to create staff account again'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStaffRequest  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $request->validated();
        $staff->name           = $request->get('name');
        $staff->phone          = $request->get('phone');
        $staff->email          = $request->get('email');
        $staff->address        = $request->get('address');
        $staff->start_date     = $request->get('start_date');
        $staff->end_date       = $request->get('end_date');
        $staff->sallery_amount = $request->get('sallery_amount');
        $staff->status         = $request->get('status');
        $staff->description    = $request->get('description');

        try{
            if($staff->update()){
                return redirect()->back()->with(['message' => 'Success! Staff account has been updated.']);
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, please try to update staff again'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        try{
            if($staff->delete()){
                return redirect()->back()->with(['message' => 'Staff account has been deleted successfully']);
            }
        }
        catch(\Exception $e){
             return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, An error occurred while delete Staff account']);
        }
    }
}
