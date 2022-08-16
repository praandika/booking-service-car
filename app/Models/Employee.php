<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkOrder;

class Employee extends Model
{
    use HasFactory;

    protected $guard = [
        'id'
    ];

    public function workOrderEmployee(){
        return $this->hasMany(WorkOrder::class);
    }
}
