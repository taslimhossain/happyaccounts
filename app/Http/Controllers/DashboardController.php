<?php

namespace App\Http\Controllers;
use App\Models\BankTransaction;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalClient    = Client::count('id');
        $totalVendor    = Vendor::count('id');
        $currentBalance = BankTransaction::selectRaw('SUM(credit_amount) - SUM(debit_amount) as current_balance')->first()->current_balance;
        $projects = Project::with('client_details')->latest()->paginate();
        $totalProject    = $projects->total();
        return view('dashboard', compact('currentBalance', 'totalProject', 'totalClient', 'totalVendor', 'projects'));
    }
}
