<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeTransaction extends Model
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

    public function scopeSalary($query)
    {
        return $query->where('is_salary', 'yes');
    }

    public function scopeOffice($query)
    {
        return $query->where('is_salary', 'no');
    }

    /**
     * Get the Global Transaction .
    */
    public function globalTransaction()
    {
        return $this->belongsTo(GlobalTransaction::class, 'global_transaction_id', 'id');
    }

    /**
     * Get the Staff .
    */
    public function getStaff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    /**
     * Get the Staff .
    */
    public function getCategory()
    {
        return $this->belongsTo(Expenses_categories::class, 'expenses_id', 'id');
    }

    // public function scopeWithDebitAndCreditTotals($query)
    // {
    //     return $query->select(
    //             'office_transactions.*',
    //             DB::raw('(SELECT SUM(debit_amount) FROM office_transactions) AS total_debit'),
    //             DB::raw('(SELECT SUM(credit_amount) FROM office_transactions) AS total_credit')
    //         );
    // }

    public function scopeWithDebitAndCreditTotals($query)
    {
        return $query->select('*')
        ->selectRaw('SUM(debit_amount) OVER (ORDER BY id) AS total_debit')
        ->selectRaw('SUM(credit_amount) OVER (ORDER BY id) AS total_credit');
    }

}
