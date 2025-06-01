<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' => 'admin', 
        ]); 
        DB::table('users')->insert([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('staff@123'),
            'role' => 'staff', 
        ]);
    }
}
