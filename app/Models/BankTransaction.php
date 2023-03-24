<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;
    
    public function getPerPage()
    {
        return 12;
    }


    public function scopeWithBalance($query)
    {
        $queryBuilder = $query->getQuery();
        if (empty($queryBuilder->columns)) {
            return $query->select('*')->selectRaw('SUM(credit_amount - debit_amount) OVER (ORDER BY id) AS balance');
        } else {
            return $query->addSelect(DB::raw('SUM(credit_amount - debit_amount) OVER (ORDER BY id) AS balance'));
        }
    }
    
    public function scopeWithDebitAndCreditTotals($query)
    {
        return $query->select('*')
        ->selectRaw('SUM(debit_amount) OVER (ORDER BY id) AS total_debit')
        ->selectRaw('SUM(credit_amount) OVER (ORDER BY id) AS total_credit');
    }

    public function scopeBank($query, $bank_id)
    {
        if($bank_id){
            return $query->where('banking_id', $bank_id);
        }
    }

    public function scopeBankTransactionList($query){
        return $query->with('globalTransaction:id,uuid')
                    ->select('id','global_transaction_id', 'created_at', 'reference', 'uuid', 'debit_amount', 'credit_amount', 'trans_date')
                    ->latest()
                    ->paginate();
                    
    }

    /**
     * Get the Global Transaction .
     */
    public function globalTransaction()
    {
        return $this->belongsTo(GlobalTransaction::class, 'global_transaction_id', 'id');
    }


    public function getCreateDateAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function getTransDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['trans_date'])->format('d/m/Y');
    }

    public function setTransDateAttribute($value)
    {
        $this->attributes['trans_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

}
