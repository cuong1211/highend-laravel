<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'birthday' => '1999-01-01',
            'address' => 'Ha Noi',
            'phone' => '0123456789',
            'isAdmin' => 1,
            'is_confirmed' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user1234'),
            'birthday' => '1999-01-01',
            'address' => 'Ha Noi',
            'phone' => '0123456789',
            'isAdmin' => 0,
            'is_confirmed' => false,  
        ]);
    }
}
