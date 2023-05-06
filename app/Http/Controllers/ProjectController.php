<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\ProjectTransaction;
use App\Models\Client;
use App\Models\Expenses_categories;
use App\Models\Vendor;
use App\Models\Banking;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{

    /*
    * Get project details here
    *
    * @return \App\Models\Project
    */
    protected function getProject()
    {
        $project_uuid = request()->route('uuid');
        return Project::where('uuid', $project_uuid)->firstOrFail();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $newproducts = Project::join('expenses_categories', 'projects.client', '=', 'expenses_categories.id')
        // ->select('projects.*', 'expenses_categories.name as category_name')
        // ->get();

        $projects = Project::with('client_details')->latest()->paginate();
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::active()->get();
        return view('project.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        $request->validated();
        do {
            $uuid = Str::uuid()->toString();
        } while (Project::where('uuid', $uuid)->exists());

        $project                = new Project();
        $project->uuid          = $uuid;
        $project->project_title = $request->get('project_title');
        $project->start_date    = $request->get('start_date');
        $project->end_date      = $request->get('end_date');
        $project->client        = $request->get('client');
        $project->project_price = $request->get('project_price');
        $project->status        = $request->get('status');
        $project->description   = $request->get('description');

        try{
            if($project->save()){
                return to_route('project.index')->with(['message' => 'Success! Your project has been created.']);
            }
        }
        catch(\Exception $e){
            return to_route('project.create')->with(['status' => false, 'message' => 'Sorry something wrong, please try to create project again'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project_expense = ProjectTransaction::where('project_id', $project->id)->sum('debit_amount');
        $project = Project::with('client_details')->findOrFail($project->id);
        return view('project.show', compact('project', 'project_expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $clients = Client::active()->get();
        return view('project.edit', compact('project','clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $request->validated();
        $project->project_title = $request->get('project_title');
        $project->start_date    = $request->get('start_date');
        $project->end_date      = $request->get('end_date');
        $project->client        = $request->get('client');
        $project->project_price = $request->get('project_price');
        $project->status        = $request->get('status');
        $project->description   = $request->get('description');

        try{
            if($project->update()){
                return redirect()->back()->with(['message' => 'Success! Your project has been updated.']);
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, please try to update project again'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        try{
            if($project->delete()){
                return redirect()->back()->with(['message' => 'Project deleted successfully']);
            }
        }
        catch(\Exception $e){
             return redirect()->back()->with(['status' => false, 'message' => 'Sorry something wrong, An error occurred while delete Project']);
        }
    }

    /**
     * Display a expenses categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function expensesCategories()
    {
        $expenses_categories = Expenses_categories::where('expenses_for', '=', 'project')->latest()->paginate();
        return view('expenses_categories.index', compact('expenses_categories'));
    }

    /**
     * Display client transaction form.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionWithClient()
    {
        $project           = $this->getProject();
        $clients           = Client::active()->get();
        $bankings          = Banking::active()->get();
        return view('project.transaction.transaction-client', compact('project','clients', 'bankings'));
    }

    /**
     * Display client transaction form.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionWithOther()
    {
        $project           = $this->getProject();
        $clients           = Client::active()->get();
        $expenses_cateogrys = Expenses_categories::projectActive()->get();
        $bankings          = Banking::active()->get();
        return view('project.transaction.transaction-other', compact('project','clients','expenses_cateogrys', 'bankings'));
    }

    /**
     * Display client transaction form.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionWithVendor()
    {
        $project           = $this->getProject();
        $clients           = Client::active()->get();
        $vendors           = Vendor::active()->get();
        $expenses_cateogrys = Expenses_categories::projectActive()->get();
        $bankings          = Banking::active()->get();
        return view('project.transaction.transaction-vendor', compact('project','clients','vendors', 'expenses_cateogrys', 'bankings'));
    }

}
