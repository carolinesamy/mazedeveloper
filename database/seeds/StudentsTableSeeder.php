<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tracks')->insert(array(
            array('track_name'=>'OS'),
            array('track_name'=>'SA'),


        ));

        DB::table('intakes')->insert(array(
            array('intake_number'=>'35'),
            array('intake_number'=>'36'),


        ));
        DB::table('branches')->insert(array(
            array('branch_name'=>'Alex'),
            array('branch_name'=>'cairo'),


        ));
        DB::table('categories')->insert(array(
            array('category_name'=>'front end'),


        ));
        DB::table('courses')->insert(array(
            array('course_name'=>'Alex','description'=>'test test','max_points'=>'100','chat_filename'=>'jhk','category_id'=>'1'),


        ));


        DB::table('students')->insert(array(
            array('sfull_name'=>'john','email'=>'john@clivern.com','password'=>bcrypt('123456'),'points'=>'0','intake_id'=>'1','track_id'=>'1','remember_token'=>'123456'),
            array('sfull_name'=>'aya','email'=>'aya@gmail.com','password'=>bcrypt('123456'),'points'=>'0','intake_id'=>'1','track_id'=>'1','remember_token'=>'1234745'),


        ));


    }
}
