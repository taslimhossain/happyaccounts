<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
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

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getStartDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['start_date'])->format('d/m/Y');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getEndDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['end_date'])->format('d/m/Y');
    }

}
