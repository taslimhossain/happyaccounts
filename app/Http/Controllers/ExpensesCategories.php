<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Expenses_categories;
use Illuminate\Http\Request;

class ExpensesCategories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses_categories = Expenses_categories::where('expenses_for', '=', 'project')->latest()->paginate();
        return view('expenses_categories.index', compact('expenses_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        do {
            $uuid = Str::uuid()->toString();
        } while (Expenses_categories::where('uuid', $uuid)->exists());

        $expenses_categorie               = new Expenses_categories();
        $expenses_categorie->uuid         = $uuid;
        $expenses_categorie->name         = $request->get('name');
        $expenses_categorie->expenses_for = $request->get('expenses_for');
        $expenses_categorie->status       = $request->get('status');

        try{
            if($expenses_categorie->save()){
                return to_route('expenses_categorie.index')->with(['message' => 'Success!  New category has been created.']);
            }
        }
        catch(\Exception $e){
            dd($e);
            return to_route('expenses_categorie.create')->with(['status' => false, 'message' => 'Sorry something wrong, please try to create new category again'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\expenses_categories  $expenses_categories
     * @return \Illuminate\Http\Response
     */
    public function show(expenses_categories $expenses_categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\expenses_categories  $expenses_categories
     * @return \Illuminate\Http\Response
     */
    public function edit(expenses_categories $expenses_categorie)
    {
        return view('expenses_categories.edit', compact('expenses_categorie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\expenses_categories  $expenses_categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, expenses_categories $expenses_categorie)
    {

        $expenses_categorie->name         = $request->get('name');
        $expenses_categorie->expenses_for = $request->get('expenses_for');
        $expenses_categorie->status       = $request->get('status');

        try{
            if($expenses_categorie->update()){
                return redirect()->back()->with(['message' => 'Success! Category has been updated.']);
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, please try to update Category again'])->withInput();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expenses_categorie  $expenses_categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(expenses_categories $expenses_categorie)
    {
        try{
            if($expenses_categorie->delete()){
                return redirect()->back()->with(['message' => 'Category has been deleted successfully']);
            }
        }
        catch(\Exception $e){
             return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, An error occurred while delete Category']);
        }
    }
}
