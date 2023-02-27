<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getStartDateAttribute()
    {
  
        return $this->attributes['start_date'] = Carbon::createFromFormat('Y-m-d', $this->attributes['start_date'])->format('d/m/Y');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getEndDateAttribute()
    {
        return $this->attributes['end_date'] = Carbon::createFromFormat('Y-m-d', $this->attributes['end_date'])->format('d/m/Y');
    }

}
