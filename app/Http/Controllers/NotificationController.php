<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Queue\RedisQueue;
use App\Instructor;
use App\Student;
use App\Answer;
use App\Question;
use DB;
use DateTime;

class NotificationController extends Controller
{
    //
    public function get_notification_num(Request $request)
    {

        $notification =0;
        $user_id = $request->input('id');
        $user_type = $request->input('type');

        if (session('user_id') == $user_id && session('type') == $user_type && $user_id!=null )
        {

            //->select(DB::raw('count(*) as user_count, status'))
            //return $user_id;

            if ($user_type == 'student')
            {

                $last_hit= Student::select('last_hit')->where('id',$user_id)->first();



                $notification = DB::table('notifications')
                    ->join('student_notifications', 'notifications.id', '=', 'student_notifications.notification_id')
                    ->where([
                        ['student_notifications.student_id','=',$user_id ],
                        ['notifications.time','>',$last_hit->last_hit],
                    ])
                    ->select(DB::raw('count(*) as count'))
                    ->get();
            }
            else
            {
                //return "opa alaalaa";


                $last_hit = Instructor::select('last_hit')->where('id', $user_id)->first();


                $notification = DB::table('notifications')
                    ->join('instructor_notifications', 'notifications.id', '=', 'instructor_notifications.notification_id')
                    ->where([
                        ['instructor_notifications.instructor_id', '=', $user_id],
                        ['notifications.time', '>', $last_hit->last_hit]
                    ])
                    ->select(DB::raw('count(*) as count'))
                    ->get();
            }

        }
        return $notification;


    }

    public function get_notification_data(Request $request)
    {

        $notification =0;
        $user_id = $request->input('id');
        $user_type = $request->input('type');
//        $user_id=1;
//        $user_type="student";

        if (session('user_id') == $user_id && session('type') == $user_type && $user_id!=null )
        {

            if ($user_type == 'student')
            {
                $last_hit= Student::select('last_hit')->where('id',$user_id)->first();
                $notification = DB::table('notifications')
                    ->join('student_notifications', 'notifications.id', '=', 'student_notifications.notification_id')
                    ->where([
                        ['student_notifications.student_id','=',$user_id ],
                        ['notifications.time','>',$last_hit->last_hit],
                    ])
                    ->select('notifications.type','notifications.content','notifications.time')
                    ->get();

                $now = new DateTime();
                $date=$now->format('Y-m-d H:i:s');

                $update_lasthit= DB:: table('students')
                    ->where('id',$user_id)
                    ->update(['last_hit' => $date]);
            }
            else
            {
                //return "opa alaalaa";


                $last_hit = Instructor::select('last_hit')->where('id', $user_id)->first();


                $notification = DB::table('notifications')
                    ->join('instructor_notifications', 'notifications.id', '=', 'instructor_notifications.notification_id')
                    ->where([
                        ['instructor_notifications.instructor_id', '=', $user_id],
                        ['notifications.time', '>', $last_hit->last_hit]
                    ])
                    ->select('notifications.type','notifications.content','notifications.time')
                    ->get();
                $now = new DateTime();
                $date=$now->format('Y-m-d H:i:s');

                $update_lasthit= DB:: table('instructors')
                    ->where('id',$user_id)
                    ->update(['last_hit' => $date]);
            }

        }
        return $notification;


    }


    public function question_notification(Request $request)
    {
        $user_id = $request->input('student_id');
        $user_type = $request->input('user_type');
        $notification_type = $request->input('notification_type');
        $course_id = $request->input('course_id');


        //echo $course_id;
        if (session('user_id') == $user_id && session('type') == $user_type) {

            $now = new DateTime();
            $date = $now->format('Y-m-d H:i:s');
            //** type question */

            $insert = DB::table('notifications')->insertGetId(
                [
                    'content' => 'There is new question',
                    'type' => $notification_type,
                    'time' => $date,
                ]
            );
            $instructors_id = DB::table('instructors')
                ->join('instructor_courses', 'instructor_courses.instructor_id', '=', 'instructors.id')
                ->where('instructor_courses.course_id', $course_id)
                ->select('instructors.id')->get();

            foreach ($instructors_id as $id) {

                $instructor_notification = DB::table('instructor_notifications')->insertGetId(
                    [
                        'instructor_id' => $id->id,
                        'notification_id' => $insert
                    ]
                );
            }


        }
    }
    public function answer_notification(Request $request)
    {
        $user_id = $request->input('student_id');
        $user_type = $request->input('user_type');
        $notification_type = $request->input('notification_type');
        $question_id = $request->input('question_id');
        if (session('user_id') == $user_id && session('type') == $user_type)
        {

            $now = new DateTime();
            $date = $now->format('Y-m-d H:i:s');

            $insert = DB::table('notifications')->insertGetId(
                [
                    'content' => 'you have one more answer',
                    'type' => $notification_type,
                    'time' => $date,
                ]
            );
            $quest_by_student_id = DB::table('students')
                ->join('questions', 'questions.student_id', '=', 'students.id')
                ->where('questions.id', $question_id)
                ->select('students.id')->get();

            foreach ($quest_by_student_id as $id) {

                $quest_by_student_notification = DB::table('student_notifications')->insertGetId(
                    [
                        'student_id' => $id->id,
                        'notification_id' => $insert
                    ]
                );
            }
        }
    }

    /************comment notification *********/
    public function comment_notification(Request $request)
    {
        $user_id = $request->input('student_id');
        $user_type = $request->input('user_type');
        $notification_type = $request->input('notification_type');
        $question_id = $request->input('question_id');
        if (session('user_id') == $user_id && session('type') == $user_type) {

            $now = new DateTime();
            $date = $now->format('Y-m-d H:i:s');


            $insert = DB::table('notifications')->insertGetId(
                [
                    'content' => 'there is a comment on your question',
                    'type' => $notification_type,
                    'time' => $date,
                ]
            );
            $quest_by_student_id = DB::table('students')
                ->join('questions', 'questions.student_id', '=', 'students.id')
                ->where('questions.id', $question_id)
                ->select('students.id')->get();

            foreach ($quest_by_student_id as $id) {

                $quest_by_student_notification = DB::table('student_notifications')->insertGetId(
                    [
                        'student_id' => $id->id,
                        'notification_id' => $insert
                    ]
                );
            }
        }
    }

    //********* reply notification

    public function reply_notification(Request $request)
    {
        $user_id = $request->input('student_id');
        $user_type = $request->input('user_type');
        $notification_type = $request->input('notification_type');
        $question_id = $request->input('question_id');
        $answer_id = $request->input('answer_id');
        if (session('user_id') == $user_id && session('type') == $user_type)
        {

            $now = new DateTime();
            $date = $now->format('Y-m-d H:i:s');


            $insert = DB::table('notifications')->insertGetId(
                [
                    'content' => 'There is a reply on answer',
                    'type' => $notification_type,
                    'time' => $date,
                ]
            );

            $question = Question::where('id', $question_id)->first();

            $quest_by_student_notification = DB::table('student_notifications')->insertGetId(
                [
                    'student_id' => $question->student_id,
                    'notification_id' => $insert
                ]
            );
            $answer = Answer::where('id', $answer_id)->first();

            if ($answer->instructor_id == null) {

                $answer_by_student_notification = DB::table('student_notifications')->insertGetId(
                    [
                        'student_id' => $answer->student_id,
                        'notification_id' => $insert
                    ]
                );
            } else {

                $answer_by_student_notification = DB::table('instructor_notifications')->insertGetId(
                    [
                        'instructor_id' => $answer->instructor_id,
                        'notification_id' => $insert
                    ]
                );
            }
        }


    }

    public function like_notification(Request $request)
    {
        $user_id = $request->input('student_id');
        $user_type = $request->input('user_type');
        $notification_type = $request->input('notification_type');
        $answer_id = $request->input('answer_id');
        if (session('user_id') == $user_id && session('type') == $user_type)
        {


            $now = new DateTime();
            $date = $now->format('Y-m-d H:i:s');


            $insert = DB::table('notifications')->insertGetId(
                [
                    'content' => 'There is one like for your answer',
                    'type' => $notification_type,
                    'time' => $date,
                ]
            );

            $answer = Answer::where('id', $answer_id)->first();

            if ($answer->instructor_id == null) {

                $answer_by_student_notification = DB::table('student_notifications')->insertGetId(
                    [
                        'student_id' => $answer->student_id,
                        'notification_id' => $insert
                    ]
                );
            } else {

                $answer_by_student_notification = DB::table('instructor_notifications')->insertGetId(
                    [
                        'instructor_id' => $answer->instructor_id,
                        'notification_id' => $insert
                    ]
                );
            }


        }

    }

    public function dislike_notification(Request $request)
    {
        $user_id = $request->input('student_id');
        $user_type = $request->input('user_type');
        $notification_type = $request->input('notification_type');
        $answer_id = $request->input('answer_id');
        if (session('user_id') == $user_id && session('type') == $user_type)
        {


            $now = new DateTime();
            $date = $now->format('Y-m-d H:i:s');


            $insert = DB::table('notifications')->insertGetId(
                [
                    'content' => 'There is one dislike for your answer',
                    'type' => $notification_type,
                    'time' => $date,
                ]
            );

            $answer = Answer::where('id', $answer_id)->first();

            if ($answer->instructor_id == null) {

                $answer_by_student_notification = DB::table('student_notifications')->insertGetId(
                    [
                        'student_id' => $answer->student_id,
                        'notification_id' => $insert
                    ]
                );
            } else {

                $answer_by_student_notification = DB::table('instructor_notifications')->insertGetId(
                    [
                        'instructor_id' => $answer->instructor_id,
                        'notification_id' => $insert
                    ]
                );
            }


        }

    }


}
