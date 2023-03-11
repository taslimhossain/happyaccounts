<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses_categories extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function scopeActive($query)
    {
        return $query->where('status', \App\Helpers\Constant::ROW_STATUS['active']);
    }

    public function scopeOfficeActive($query)
    {
        return $query->where('status', \App\Helpers\Constant::ROW_STATUS['active'])
                     ->where('expenses_for', 'office');
    }

    public function scopeProjectActive($query)
    {
        return $query->where('status', \App\Helpers\Constant::ROW_STATUS['active'])
                     ->where('expenses_for', 'project');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', \App\Helpers\Constant::ROW_STATUS['in_active']);
    }

}
