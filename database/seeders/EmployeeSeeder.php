<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'haris',
            'address' => 'katapang',
            'gender' => 'male',
            'role_id' => '1',
            'birth_date' => "2000-03-01",
            'birth_place' => 'katapang',
            'phone' => '0812343222',
            'email' => 'haris@meko.com',
            'password' => bcrypt('haris123'),
            'image' => null
        ]);
    }
}
