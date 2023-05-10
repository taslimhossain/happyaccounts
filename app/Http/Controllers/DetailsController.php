<?php

namespace App\Http\Controllers;
use App\Models\BankTransaction;
use App\Models\GlobalTransaction;
use App\Models\ClientTransaction;
use App\Models\OfficeTransaction;
use App\Models\ProjectTransaction;
use App\Models\VendorTransaction;
use Illuminate\Http\Request;

class DetailsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details_transaction(Request $request)
    {

        $transaction_id = $request->get('transaction_id');

        $global_transaction  = GlobalTransaction::where('uuid', $transaction_id )->first();
        $bank_transaction    = BankTransaction::with('bankName')->where('global_transaction_id', $global_transaction->id)->first();
        $client_transaction  = ClientTransaction::with('bankName','projectName', 'clientName')->where('global_transaction_id', $global_transaction->id)->first();
        $office_transaction  = OfficeTransaction::where('global_transaction_id', $global_transaction->id)->first();
        $vendor_transaction  = VendorTransaction::with('projectName', 'vendorName', 'projectTransaction')->where('global_transaction_id', $global_transaction->id)->first();
        $project_transaction = ProjectTransaction::with('expensesName', 'bankName', 'projectName', 'vendorName', 'clientName', 'projectTransaction')->where('global_transaction_id', $global_transaction->id)->first();
        
        return $details = compact('global_transaction','bank_transaction', 'client_transaction', 'office_transaction', 'vendor_transaction', 'project_transaction');

        echo "<pre>";
        print_r( $details );
        echo "</pre>";


        // return $totalClient    = Client::count('id');
        // $totalVendor    = Vendor::count('id');
        // $currentBalance = BankTransaction::selectRaw('SUM(credit_amount) - SUM(debit_amount) as current_balance')->first()->current_balance;

    }


}
