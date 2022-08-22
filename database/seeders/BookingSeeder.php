<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use Illuminate\Support\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Booking::insert([
            'user_id' => 'Administrator',
            'service' => 'admin@gmail.com',
            'package' => 'admin',
            'plate_no' => bcrypt('admin'),
            'complaint' => 'admin',
            'brand' => '',
            'type' => '',
            'color' => '',
            'year' => '',
            'facility' => '',
            'transmition' => '',
            'date' => '',
            'time' => '',
            'estimation' => '',
            'status' => '',
            'reschedule' => '',
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);
    }
}
