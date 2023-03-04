<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;


    // public function save(array $options = [])
    // {
    //     if (!$this->exists) {
    //         $this->created_at = $this->freshTimestamp();
    //     }
    //     $previous_debit = $this->previousDebitAmount();
    //     $previous_credit = $this->previousCreditAmount();
    //     $current_debit = $this->debit_amount ?? 0;
    //     $current_credit = $this->credit_amount ?? 0;
    //     $this->balance = $previous_credit + $current_credit - $previous_debit - $current_debit;
    //     return parent::save($options);
    // }

    // public function previousDebitAmount()
    // {
    //     return self::where('banking_id', $this->account)
    //         ->where('created_at', '<', $this->created_at)
    //         ->sum('debit_amount');
    // }

    // public function previousCreditAmount()
    // {
    //     return self::where('banking_id', $this->account)
    //         ->where('created_at', '<', $this->created_at)
    //         ->sum('credit_amount');
    // }

    
    public function getTransDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['trans_date'])->format('d/m/Y');
    }

    public function setTransDateAttribute($value)
    {
        $this->attributes['trans_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

}
