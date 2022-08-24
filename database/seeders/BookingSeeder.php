<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'user_id' => '2',
            'frame_no' => 'MH3SGJK787',
            'service' => 'Service Mesin',
            'package' => 'Service Berkala A',
            'plate_no' => 'DK 1234 AB',
            'complaint' => 'Mesin rusak',
            'brand' => 'Toyoya',
            'type' => 'Avanza',
            'color' => 'Hitam',
            'year' => '2012',
            'facility' => 'datang',
            'transmition' => 'Manual',
            'date' => '2022-01-02',
            'time' => '09:00',
            'estimation' => '450000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-01-02 09:01:29',
        ]);

        Booking::insert([
            'user_id' => '3',
            'frame_no' => 'MH3SGJK788',
            'service' => 'Service Mesin',
            'package' => 'Service Berkala B',
            'plate_no' => 'DK 1235 AB',
            'complaint' => 'Mesin rusak ini',
            'brand' => 'Toyoya',
            'type' => 'Alphard',
            'color' => 'Hitam',
            'year' => '2015',
            'facility' => 'datang',
            'transmition' => 'Manual',
            'date' => '2022-01-02',
            'time' => '09:00',
            'estimation' => '650000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-01-02 09:01:29',
        ]);

        Booking::insert([
            'user_id' => '3',
            'frame_no' => 'MH3SGJK789',
            'service' => 'Service Mesin',
            'package' => 'Service Berkala C',
            'plate_no' => 'DK 1236 BB',
            'complaint' => 'Mesin rusak itu',
            'brand' => 'Honda',
            'type' => 'Jazz',
            'color' => 'Silver',
            'year' => '2015',
            'facility' => 'datang',
            'transmition' => 'Automatic',
            'date' => '2022-02-04',
            'time' => '09:00',
            'estimation' => '850000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-02-04 09:01:29',
        ]);

        Booking::insert([
            'user_id' => '2',
            'frame_no' => 'MH3SGJK790',
            'service' => 'Service Mesin',
            'package' => 'Service Berkala D',
            'plate_no' => 'DK 1237 CB',
            'complaint' => 'Mesin rusak sepertinya',
            'brand' => 'Honda',
            'type' => 'BRV',
            'color' => 'Hitam',
            'year' => '2018',
            'facility' => 'datang',
            'transmition' => 'Automatic',
            'date' => '2022-03-04',
            'time' => '09:00',
            'estimation' => '1150000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-03-04 09:01:29',
        ]);

        Booking::insert([
            'user_id' => '2',
            'frame_no' => 'MH3SGJK792',
            'service' => 'Body Repair',
            'package' => 'Full Body Painting',
            'plate_no' => 'DK 1237 CB',
            'complaint' => 'bodynya lecet',
            'brand' => 'Daihatsu',
            'type' => 'Xenia',
            'color' => 'Hitam',
            'year' => '2010',
            'facility' => 'datang',
            'transmition' => 'Manual',
            'date' => '2022-03-04',
            'time' => '10:00',
            'estimation' => '7500000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-03-04 10:01:29',
        ]);

        Booking::insert([
            'user_id' => '3',
            'frame_no' => 'MH3SGJK793',
            'service' => 'Body Repair',
            'package' => 'Cat 1 Panel',
            'plate_no' => 'DK 123 CK',
            'complaint' => 'Panelnya lecet 1 aja',
            'brand' => 'Daihatsu',
            'type' => 'Xenia',
            'color' => 'Hitam',
            'year' => '2010',
            'facility' => 'datang',
            'transmition' => 'Manual',
            'date' => '2022-04-11',
            'time' => '10:00',
            'estimation' => '700000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-04-11 10:01:29',
        ]);

        Booking::insert([
            'user_id' => '3',
            'frame_no' => 'MH3SGJK794',
            'service' => 'Body Repair',
            'package' => 'Cat 2 Panel',
            'plate_no' => 'DK 952 JK',
            'complaint' => 'Panelnya lecet 2 aja',
            'brand' => 'Toyota',
            'type' => 'Raize',
            'color' => 'Biru',
            'year' => '2021',
            'facility' => 'datang',
            'transmition' => 'Automatic',
            'date' => '2022-05-11',
            'time' => '10:00',
            'estimation' => '1400000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-05-11 10:01:29',
        ]);

        Booking::insert([
            'user_id' => '2',
            'frame_no' => 'MH3SGJK795',
            'service' => 'Body Repair',
            'package' => 'Cat 3 Panel',
            'plate_no' => 'DK 856 HE',
            'complaint' => 'Panelnya lecet 3 aja',
            'brand' => 'Daihatsu',
            'type' => 'Rocky',
            'color' => 'Hitam',
            'year' => '2021',
            'facility' => 'datang',
            'transmition' => 'Automatic',
            'date' => '2022-06-25',
            'time' => '15:00',
            'estimation' => '2100000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-06-25 15:01:29',
        ]);

        Booking::insert([
            'user_id' => '3',
            'frame_no' => 'MH3SGJK796',
            'service' => 'Body Repair',
            'package' => 'Cat 3 Panel',
            'plate_no' => 'DK 1585 HE',
            'complaint' => 'Panelnya lecet 3 aja',
            'brand' => 'Toyota',
            'type' => 'Avanza',
            'color' => 'Putih',
            'year' => '2008',
            'facility' => 'datang',
            'transmition' => 'Manual',
            'date' => '2022-07-25',
            'time' => '14:00',
            'estimation' => '2100000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-07-25 14:01:29',
        ]);

        Booking::insert([
            'user_id' => '2',
            'frame_no' => 'MH3SGJK797',
            'service' => 'Body Repair',
            'package' => 'Cat 2 Panel',
            'plate_no' => 'DK 1585 HE',
            'complaint' => 'Panelnya lecet 3 aja',
            'brand' => 'Toyota',
            'type' => 'Avanza',
            'color' => 'Hitam',
            'year' => '2008',
            'facility' => 'datang',
            'transmition' => 'Manual',
            'date' => '2022-07-25',
            'time' => '14:00',
            'estimation' => '1400000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-07-25 14:01:29',
        ]);

        Booking::insert([
            'user_id' => '2',
            'frame_no' => 'MH3SGJK798',
            'service' => 'Service Mesin',
            'package' => 'Service Berkala B',
            'plate_no' => 'DK 1658 GH',
            'complaint' => 'Service mesin mobilnua',
            'brand' => 'Mitsubishi',
            'type' => 'Pajero',
            'color' => 'Putih',
            'year' => '2018',
            'facility' => 'datang',
            'transmition' => 'Manual',
            'date' => '2022-07-28',
            'time' => '13:00',
            'estimation' => '1400000',
            'status' => 'selesai',
            'reschedule' => '0',
            'created_at' => '2022-07-28 13:01:29',
        ]);
    }
}
