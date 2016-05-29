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

        DB::table('tags')->insert(array(
            array('tag_name'=>'java'),
            array('tag_name'=>'php'),
            array('tag_name'=>'angularJS'),
            array('tag_name'=>'bootstrap'),
            array('tag_name'=>'HTML')

        ));
        DB::table('branchs')->insert(array(
            array('branch_name'=>'Alex'),
            array('branch_name'=>'cairo'),


        ));
        DB::table('categories')->insert(array(
            array('category_name'=>'front end'),
            array('category_name'=>'back end'),


        ));
        DB::table('courses')->insert(array(
            array('course_name'=>'php','description'=>'test test','max_points'=>'100','chat_filename'=>'jhk','category_id'=>'1'),
            array('course_name'=>'java','description'=>'test test','max_points'=>'75','chat_filename'=>'jhk','category_id'=>'2'),
            array('course_name'=>'bootstrap','description'=>'test test','max_points'=>'75','chat_filename'=>'jhk','category_id'=>'2'),
            array('course_name'=>'python','description'=>'test test','max_points'=>'75','chat_filename'=>'jhk','category_id'=>'2'),
            array('course_name'=>'angularJS','description'=>'test test','max_points'=>'75','chat_filename'=>'jhk','category_id'=>'2'),



        ));


        DB::table('students')->insert(array(
            array('sfull_name'=>'aya','email'=>'aya@gmail.com','password'=>'123456','points'=>'0','intake_id'=>'1','track_id'=>'1','remember_token'=>'1234745','last_hit'=>'2016-05-22 07:22:22'),

            array('sfull_name'=>'john','email'=>'john@gmail.com','password'=>'123456','points'=>'0','intake_id'=>'1','track_id'=>'1','remember_token'=>'123456','last_hit'=>'2016-05-22 05:22:22'),


        ));
        DB::table('instructors')->insert(array(
            array('ifull_name'=>'noha','email'=>'noha@gmail.com','password'=>'123456','type'=>'internal','last_hit'=>'2016-05-22 05:22:22'),
            array('ifull_name'=>'peter','email'=>'peter@gmail.com','password'=>'123456','type'=>'internal','last_hit'=>'2016-05-22 05:22:22'),


        ));

        DB::table('notifications')->insert(array(
            array('content'=>'you have one question','type'=>'question','time'=>'2016-05-22 05:22:22'),
            array('content'=>'you have one answer','type'=>'answer','time'=>'2016-05-22 09:22:22'),
            array('content'=>'eng.noha liked your answer','type'=>'answer','time'=>'2016-05-23 05:22:22'),
            array('content'=>'you have one question','type'=>'answer','time'=>'2016-05-23 09:23:22'),

        ));

        DB::table('questions')->insert(array(
            array('title'=>'how to test?','content'=>'you have one question','student_id'=>'1','course_id'=>'1','solved'=>'0'),
            array('title'=>'how to debug?','content'=>'you opa alalllaaaa','student_id'=>'2','solved'=>'0','course_id'=>'1'),

        ));
        DB::table('answers')->insert(array(

            array('content'=>'you have one question','time'=>'2016-05-19 05:22:22','student_id'=>'1','likes'=>'5','dislikes'=>'1','accepted'=>'0','question_id'=>'1','instructor_id'=>'1'),
            array('content'=>'you have two answers','time'=>'2016-05-20 05:22:22','student_id'=>'1','likes'=>'9','dislikes'=>'2','accepted'=>'0','question_id'=>'1','instructor_id'=>'1'),

        ));

        DB::table('comments')->insert(array(

            array('content'=>'comment 1','time'=>'2016-05-22 05:22:22','student_id'=>'1','question_id'=>'1','instructor_id'=>'1'),
            array('content'=>'comment 2','time'=>'2016-05-25 08:22:12','student_id'=>'1','question_id'=>'1','instructor_id'=>'1'),

        ));
        DB::table('replies')->insert(array(

            array('content'=>'replay 1','time'=>'2016-05-33 05:22:22','student_id'=>'1','answer_id'=>'1','instructor_id'=>'1'),
            array('content'=>'replyt 2','time'=>'2016-05-12 08:22:12','student_id'=>'1','answer_id'=>'1','instructor_id'=>'1'),

        ));

        DB::table('track_branchs')->insert(array(
            array('branch_id'=>'1','track_id'=>'1'),
            array('branch_id'=>'1','track_id'=>'2'),

        ));
        DB::table('student_courses')->insert(array(
            array('student_id'=>'1','course_id'=>'1','privilege'=>'notify'),
            array('student_id'=>'1','course_id'=>'2','privilege'=>'dislike'),
            array('student_id'=>'1','course_id'=>'3','privilege'=>'dislike'),
            array('student_id'=>'1','course_id'=>'4','privilege'=>'dislike'),


        ));

        DB::table('instructor_courses')->insert(array(
            array('instructor_id'=>'1','course_id'=>'1','teach_years'=>'2016-05-04'),
            array('instructor_id'=>'1','course_id'=>'2','teach_years'=>'2016-09-04'),

        ));

        DB::table('track_intakes')->insert(array(
            array('track_id'=>'1','intake_id'=>'1','state'=>'0'),
            array('track_id'=>'1','intake_id'=>'2','state'=>'1'),

        ));

        DB::table('track_courses')->insert(array(
            array('track_id'=>'1','course_id'=>'1'),
            array('track_id'=>'1','course_id'=>'2'),

        ));

        DB::table('instructor_notifications')->insert(array(
            array('instructor_id'=>'1','notification_id'=>'1'),
            array('instructor_id'=>'1','notification_id'=>'2'),

        ));

        DB::table('student_notifications')->insert(array(
            array('student_id'=>'1','notification_id'=>'1'),
            array('student_id'=>'1','notification_id'=>'2'),
            array('student_id'=>'1','notification_id'=>'3'),
            array('student_id'=>'2','notification_id'=>'4'),


        ));
        DB::table('question_tags')->insert(array(
            array('question_id'=>'1','tag_id'=>'1'),
            array('question_id'=>'1','tag_id'=>'2'),

        ));

    }
}
