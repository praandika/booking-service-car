<?php

namespace Database\Seeders;

use App\Models\WorkOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkOrder::insert([
            'booking_id' => 1,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        WorkOrder::insert([
            'booking_id' => 2,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        WorkOrder::insert([
            'booking_id' => 3,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        WorkOrder::insert([
            'booking_id' => 4,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        WorkOrder::insert([
            'booking_id' => 5,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        WorkOrder::insert([
            'booking_id' => 6,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        WorkOrder::insert([
            'booking_id' => 7,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        WorkOrder::insert([
            'booking_id' => 8,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        WorkOrder::insert([
            'booking_id' => 9,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        WorkOrder::insert([
            'booking_id' => 10,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        WorkOrder::insert([
            'booking_id' => 11,
            'employee_id' => 1,
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);
    }
}
