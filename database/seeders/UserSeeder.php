<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'access' => 'admin',
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        User::insert([
            'name' => 'Vira',
            'email' => 'vira@gmail.com',
            'phone' => '6281898982763',
            'username' => 'vira',
            'password' => bcrypt('vira123456'),
            'access' => 'customer',
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        User::insert([
            'name' => 'Dika',
            'email' => 'dika@gmail.com',
            'phone' => '6281246571421',
            'username' => 'dika',
            'password' => bcrypt('dika123456'),
            'access' => 'customer',
            'created_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);
    }
}
