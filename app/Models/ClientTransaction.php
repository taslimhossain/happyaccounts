<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTransaction extends Model
{
    use HasFactory;

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

    /**
     * Get the Global Transaction .
    */
    public function globalTransaction()
    {
        return $this->belongsTo(GlobalTransaction::class, 'global_transaction_id', 'id');
    }

    public function scopeWithDebitAndCreditTotals($query)
    {
        return $query->select('*')
        ->selectRaw('SUM(debit_amount) OVER (ORDER BY id) AS total_debit')
        ->selectRaw('SUM(credit_amount) OVER (ORDER BY id) AS total_credit');
    }

}
