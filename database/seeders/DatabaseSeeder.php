<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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
            'fname' =>  'Juan',
            'mname' =>  'Reyes',
            'lname' =>  'Cruz',
            'address' => 'Sample Address',
            'mobile' => '1234567890',
            'email' =>  'admin@example.com',
            'role'  =>  0,
            'password' => Hash::make('password'),
        ]);
    }
}
