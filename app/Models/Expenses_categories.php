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
}
