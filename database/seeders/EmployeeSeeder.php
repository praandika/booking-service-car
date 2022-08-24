<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::insert([
            'name' => 'Andika',
            'phone' => '081246571421',
            'position' => 'Teknisi',
            'created_at' => '2022-01-1 13:01:29',
        ]);
    }
}
