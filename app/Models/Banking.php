<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banking extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getPerPage()
    {
        return 15;
    }

    public function scopeAccountBalance($query, $bank_id){
        $amount = $query->where('id', $bank_id)->withSum('Transaction', 'bank_transactions.debit_amount')
        ->withSum('Transaction', 'bank_transactions.credit_amount')
        ->first();
        return $amount->transaction_sum_bank_transactionscredit_amount - $amount->transaction_sum_bank_transactionsdebit_amount;
    }

    public function Transaction(){
        return $this->hasMany(BankTransaction::class, 'banking_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', \App\Helpers\Constant::ROW_STATUS['active']);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', \App\Helpers\Constant::ROW_STATUS['in_active']);
    }

}
