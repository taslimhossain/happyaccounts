<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
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

    public function scopeInactive($query)
    {
        return $query->where('status', \App\Helpers\Constant::ROW_STATUS['in_active']);
    }

}
