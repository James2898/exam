<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            'mobile' => '12345678901',
            'email' =>  'admin@example.com',
            'role'  =>  0,
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'fname' =>  'Pedro',
            'mname' =>  'Santos',
            'lname' =>  'Rizal',
            'address' => 'Sample Address',
            'mobile' => '12345678902',
            'email' =>  'staff@example.com',
            'role'  =>  1,
            'password' => Hash::make('password'),
        ]);

        $examinee_id = DB::table('users')->insertGetId([
            'fname'     =>  'Pablo',
            'mname'     =>  'Mendoza',
            'lname'     =>  'Santos',
            'address'   =>  'Sample Address',
            'mobile'    =>  '12345678903',
            'email'     =>  'examinee@example.com',
            'role'      =>  2,
            'password'  =>  Hash::make('password'),
        ]);

        DB::table('examinees')->insert([
            'lrn'       =>  '198765210721',
            'user_id'   =>  $examinee_id,
            'birthdate' =>  '2000-11-20',
            'gender'    =>  1,
            'college'   =>  1,
            'course'    =>  1,
            'status'    =>  0,
        ]);

        $subject_id = DB::table('subjects')->insertGetId([
            'code'      =>  'FIL2021',
            'name'      =>  'Filipino',
            'status'    =>  1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'), 
        ]);
        
        $subject = DB::select('select code from subjects where id = ?',[$subject_id]);
        
        $question_id = DB::table('questions')->insertGetId([
            'subject_id'    =>  $subject_id,
            'type'          =>  1,
            'description'   =>  'What is the capital of the Philippines?',
            'answer' => 'Manila',
        ]);
        
        DB::update(
            'update questions set question_id = ? where id = ?', [$subject[0]->code."-".(Str::padleft($question_id,3,'0')), $question_id]
        );
        
        $question_id = DB::table('questions')->insertGetId([
            'subject_id'    =>  $subject_id,
            'type'          =>  2,
            'description'   => 'What is the capital of the Philippines?',
            'option_1'      => 'Manila',
            'option_2'      => 'Cavite',
            'option_3'      => 'Cebu',
            'option_4'      => 'Laguna',
            'answer'        => 1,
        ]);

        DB::update(
            'update questions set question_id = ? where id = ?', [$subject[0]->code."-".(Str::padleft($question_id,3,'0')), $question_id]
        );

    }
}
