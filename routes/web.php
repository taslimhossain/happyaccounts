<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BankingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ExpensesCategories;
use App\Http\Controllers\ProjectTransactionController;
use App\Http\Controllers\ClientTransactionController;
use App\Http\Controllers\VendorTransactionController;
use App\Http\Controllers\SalaryTransactionController;
use App\Http\Controllers\OfficeTransactionController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/forms', function () {
    return view('admin');
})->name('forms')->middleware('admin');

Route::get(md5('abcdef'), function () {
    return view('admin');
})->name('mradmin.abc');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/', function () {
        return view('admin');
    })->name('admin');

    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'admin'], static function () {

        Route::get('banking/deposit-transaction-list', [BankingController::class, 'BankTransactionList'])->name('banking.deposit-transaction-list');
        Route::get('banking/{uuid}/deposit-transaction-list', [BankingController::class, 'BankTransactionList'])->name('banking.uuid.deposit-transaction-list');
        Route::get('banking/deposit-transaction', [BankingController::class, 'depositTransaction'])->name('banking.deposit-transaction.create');
        Route::get('banking/{uuid}/deposit-transaction', [BankingController::class, 'depositTransaction'])->name('banking.uuid.deposit-transaction.create');
        Route::post('banking/deposit-transaction/store', [BankingController::class, 'depositTransactionStore'])->name('banking.deposit-transaction.store');
        Route::get('banking/withdraw-transaction', [BankingController::class, 'withdrawTransaction'])->name('banking.withdraw-transaction.create');
        Route::get('banking/{uuid}/withdraw-transaction', [BankingController::class, 'withdrawTransaction'])->name('banking.uuid.withdraw-transaction.create');
        Route::get('banking/transfer-transaction', [BankingController::class, 'transferTransaction'])->name('banking.transfer-transaction.create');
        Route::post('banking/transfer-transaction', [BankingController::class, 'transferTransactionStore'])->name('banking.transfer-transaction.store');
        Route::resource('banking', BankingController::class);
        Route::get('project/expenses_categorie', [ProjectController::class, 'expensesCategories'])->name('project.expenses_categorie');
        Route::get('project/transaction', [ProjectController::class, 'expensesCategories'])->name('project.transaction');
        Route::get('project/{uuid}/client-transaction', [ProjectController::class, 'transactionWithClient'])->name('project.uuid.client-transaction');
        Route::get('project/{uuid}/vendor-transaction', [ProjectController::class, 'transactionWithVendor'])->name('project.uuid.vendor-transaction');
        Route::post('project/client-transaction/store', [ClientTransactionController::class, 'store'])->name('project.client-transaction.store');
        Route::post('project/vendor-transaction/store', [VendorTransactionController::class, 'store'])->name('project.vendor-transaction.store');

        Route::resource('project', ProjectController::class);
        Route::resource('project.transaction', ProjectTransactionController::class);
        Route::resource('client', ClientController::class);
        Route::resource('staff', StaffController::class);
        Route::resource('vendor', VendorController::class);
        
        Route::resource('expenses_categorie', ExpensesCategories::class);

        Route::get('expenses/office-categorie-list', [ExpensesCategories::class, 'officeindex'])->name('expenses.office-categorie.list');
        Route::get('expenses/office-categorie-create', [ExpensesCategories::class, 'officecreate'])->name('expenses.office-categorie.create');
        Route::get('expenses/{uuid}/office-categorie-edit', [ExpensesCategories::class, 'officeedit'])->name('expenses.uuid.office-categorie.edit');
        Route::resource('expenses/salary', SalaryTransactionController::class)->names([
            'index' => 'expenses.salary.index',
            'create' => 'expenses.salary.create',
            'store' => 'expenses.salary.store'
        ]);
        Route::resource('expenses', OfficeTransactionController::class);

        Route::get('report/bank-transaction', [ReportController::class, 'bankTransaction'])->name('report.bank-transaction');
        Route::get('report/office-transaction', [ReportController::class, 'officeTransaction'])->name('report.office-transaction');
        Route::get('report/project-transaction', [ReportController::class, 'projectTransaction'])->name('report.project-transaction');
        Route::get('report/vendor-transaction', [ReportController::class, 'vendorTransaction'])->name('report.vendor-transaction');
        Route::get('report/client-transaction', [ReportController::class, 'clientTransaction'])->name('report.client-transaction');
        Route::get('report/staff-transaction', [ReportController::class, 'staffTransaction'])->name('report.staff-transaction');
    });


});

require __DIR__.'/auth.php';
