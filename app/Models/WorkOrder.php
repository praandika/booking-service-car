<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\Employee;

class WorkOrder extends Model
{
    use HasFactory;

    protected $guard = [
        'id'
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
