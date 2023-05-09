<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTransaction;
use App\Models\Client;
use App\Models\Project;
use App\Models\Vendor;
use App\Models\Expenses_categories;
use App\Models\Banking;
use App\Http\Requests\StoreProjectTransactionRequest;
use App\Http\Requests\UpdateProjectTransactionRequest;

class ProjectTransactionController extends Controller
{

    /*
    * Get project details here
    *
    * @return \App\Models\Project
    */
    protected function project()
    {
        $project_uuid = request()->route('project');
        return Project::where('uuid', $project_uuid)->firstOrFail();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $project = $this->project();
        $project_title = $project->project_title ? $project->project_title : '';
        $transactions = ProjectTransaction::with('globalTransaction:id,uuid')
        ->where('project_id', $project->id)
        ->with('bankName:id,account_name')
        ->with('projectName:id,project_title')
        ->with('vendorName:id,name')
        ->with('clientName:id,client_name')
        ->with(['projectTransaction' => function ($query) {
            $query->select('id', 'global_transaction_id', 'expenses_id');
            $query->with('expensesName:id,name');
        }])
        ->latest()
        ->paginate();

        return view('project.transaction.transaction', compact('transactions', 'project_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = $this->project();
        $clients = Client::active()->get();
        $vendors = Vendor::active()->get();
        $expenses_cateogrys = Expenses_categories::where('expenses_for', 'project')->active()->get();
        $bankings = Banking::active()->get();
        return view('transaction.create', compact('project','clients','vendors', 'expenses_cateogrys', 'bankings'));
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
