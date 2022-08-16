<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\WorkOrder;

class Booking extends Model
{
    use HasFactory;

    protected $guard = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function workOrder(){
        return $this->hasMany(WorkOrder::class);
    }
}
