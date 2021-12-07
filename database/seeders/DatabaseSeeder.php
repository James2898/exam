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
        // Users
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

        // Examinee
        $examinee_id = DB::table('users')->insertGetId([
            'fname'     =>  'Pablo',
            'mname'     =>  'Mendoza',
            'lname'     =>  'Santos',
            'address'   =>  'Sample Address',
            'mobile'    =>  '12345678903',
            'email'     =>  'examinee1@example.com',
            'role'      =>  2,
            'password'  =>  Hash::make('password'),
        ]);

        DB::table('examinees')->insert([
            'lrn'       =>  '12345678901',
            'user_id'   =>  $examinee_id,
            'birthdate' =>  '2000-11-20',
            'gender'    =>  1,
            'marital'   =>  'Single',
            'prev_school' => 'Old School',
            'strand'    => 'STEM',
            'perm_address' => 'Permanent Address',
            'cur_address' => 'Current Address',
            'no_siblings' => 3,
            'order_siblings' => 3,
            'weight'    => '80kg',
            'height'    => '192cm',
            'nationality'  => 'Filipino',
            'religion'  => 'Christian',
            'f_fname'   => 'Ffname',
            'f_mname'   => 'Fmname',
            'f_lname'   => 'Flname',
            'f_occupation' => 'Web Developer',
            'f_mobile'  => '12345678902',
            'm_fname'   => 'Mfname',
            'm_mname'   => 'Mmname',
            'm_lname'   => 'Mlname',
            'm_occupation' => 'Chef',
            'm_mobile'  => '12345678902',
            'emergency_name' => 'Sample Name',
            'emergency_mobile' => '12345678902',
            'college'   =>  1,
            'course'    =>  1,
            'status'    =>  0, //Review
        ]);

        $examinee_id = DB::table('users')->insertGetId([
            'fname'     =>  'Mateo',
            'mname'     =>  'Ventura',
            'lname'     =>  'Rizal',
            'address'   =>  'Sample Address',
            'mobile'    =>  '12345678904',
            'email'     =>  'examinee2@example.com',
            'role'      =>  2,
            'password'  =>  Hash::make('password'),
        ]);

        DB::table('examinees')->insert([
            'lrn'       =>  '12345678902',
            'user_id'   =>  $examinee_id,
            'birthdate' =>  '2000-11-20',
            'gender'    =>  1,
            'marital'   =>  'Single',
            'prev_school' => 'Old School',
            'strand'    => 'STEM',
            'perm_address' => 'Permanent Address',
            'cur_address' => 'Current Address',
            'no_siblings' => 3,
            'order_siblings' => 3,
            'weight'    => '80kg',
            'height'    => '192cm',
            'nationality'  => 'Filipino',
            'religion'  => 'Christian',
            'f_fname'   => 'Ffname',
            'f_mname'   => 'Fmname',
            'f_lname'   => 'Flname',
            'f_occupation' => 'Web Developer',
            'f_mobile'  => '12345678902',
            'm_fname'   => 'Mfname',
            'm_mname'   => 'Mmname',
            'm_lname'   => 'Mlname',
            'm_occupation' => 'Chef',
            'm_mobile'  => '12345678902',
            'emergency_name' => 'Sample Name',
            'emergency_mobile' => '12345678902',
            'college'   =>  2,
            'course'    =>  2,
            'status'    =>  1, // Examinee
        ]);

        $examinee_id = DB::table('users')->insertGetId([
            'fname'     =>  'Thomas',
            'mname'     =>  'Badeo',
            'lname'     =>  'Torre',
            'address'   =>  'Sample Address',
            'mobile'    =>  '12345678905',
            'email'     =>  'examinee3@example.com',
            'role'      =>  2,
            'password'  =>  Hash::make('password'),
        ]);

        DB::table('examinees')->insert([
            'lrn'       =>  '12345678903',
            'user_id'   =>  $examinee_id,
            'birthdate' =>  '2000-11-20',
            'gender'    =>  1,
            'marital'   =>  'Single',
            'prev_school' => 'Old School',
            'strand'    => 'STEM',
            'perm_address' => 'Permanent Address',
            'cur_address' => 'Current Address',
            'no_siblings' => 3,
            'order_siblings' => 3,
            'weight'    => '80kg',
            'height'    => '192cm',
            'nationality'  => 'Filipino',
            'religion'  => 'Christian',
            'f_fname'   => 'Ffname',
            'f_mname'   => 'Fmname',
            'f_lname'   => 'Flname',
            'f_occupation' => 'Web Developer',
            'f_mobile'  => '12345678902',
            'm_fname'   => 'Mfname',
            'm_mname'   => 'Mmname',
            'm_lname'   => 'Mlname',
            'm_occupation' => 'Chef',
            'm_mobile'  => '12345678902',
            'emergency_name' => 'Sample Name',
            'emergency_mobile' => '12345678902',
            'college'   =>  2,
            'course'    =>  2,
            'status'    =>  4, // Passed
        ]);

        // Subject
        $subject_id = DB::table('subjects')->insertGetId([
            'code'      =>  'FIL2021',
            'name'      =>  'Filipino',
            'status'    =>  1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'), 
        ]);
        
        $subject = DB::select('select code from subjects where id = ?',[$subject_id]);

        DB::table('subjects')->insertGetId([
            'code'      =>  'ENG2021',
            'name'      =>  'English',
            'status'    =>  1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'), 
        ]);

        DB::table('subjects')->insertGetId([
            'code'      =>  'MATH2021',
            'name'      =>  'Math',
            'status'    =>  1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'), 
        ]);

        DB::table('subjects')->insertGetId([
            'code'      =>  'HIST2021',
            'name'      =>  'History',
            'status'    =>  1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'), 
        ]);
        
        // Subject Questions
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


        $exam_id = DB::table('exams')->insertGetId([
            'subject_id'    => $subject_id,
            'description'   => 'Exam Batch Q1',
            'duration'      => 5,
            'qty'           => 10,
            'start_datetime'    => '2020-01-01 13:00:00',
            'end_datetime'  => '2020-01-01 17:00:00',
            'status'        => 1,
        ]);

        DB::update(
            'update exams set exam_id = ? where id = ?', [Carbon::now()->format('Y').(Str::padleft($exam_id,3,'0')), $exam_id]
        );

        // FORMS
        DB::table('forms')->insert([
            [
                'exam_id'   => 1,
                'subject_id'    => 1,
                'question_id'   => 1,
            ],
            [
                'exam_id'   => 1,
                'subject_id'    => 1,
                'question_id'   => 2,
            ],
            [
                'exam_id'   => 1,
                'subject_id'    => 1,
                'question_id'   => 3,
            ],
            [
                'exam_id'   => 1,
                'subject_id'    => 1,
                'question_id'   => 4,
            ],
            [
                'exam_id'   => 1,
                'subject_id'    => 1,
                'question_id'   => 5,
            ],
        ]);
    }
}
