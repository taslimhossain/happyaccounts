<?php

namespace App\Http\Controllers;

use App\Models\ProjectTransaction;
use App\Http\Requests\StoreProjectTransactionRequest;
use App\Http\Requests\UpdateProjectTransactionRequest;

class ProjectTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectTransaction  $projectTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectTransaction $projectTransaction)
    {
        echo 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectTransaction  $projectTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectTransaction $projectTransaction)
    {
        echo 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectTransactionRequest  $request
     * @param  \App\Models\ProjectTransaction  $projectTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectTransactionRequest $request, ProjectTransaction $projectTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectTransaction  $projectTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectTransaction $projectTransaction)
    {
        //
    }
}
