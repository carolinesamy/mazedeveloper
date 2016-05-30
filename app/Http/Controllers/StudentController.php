<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\StudentNotification;
use App\Answer;
use App\Question;
use App\Instructor;
use App\Student;
use DB;

class StudentController extends Controller
{
    //


        public function login(Request $request)
        {
            $user=$request->input('user');
            //Request::all();

            $password=$user['password'];
            $email=$user['email'];
            $student= Student::where('email',$email)->first();

            if (count($student))
            {
                if ($student->password == $password)
                {
                    // echo "YOU ARE LOGIN";
                    $rett=array
                    (
                        'user'=> array
                        (
                            'id'=>$student->id,
                            'email'=>$student->email,
                            'sfull_name'=>$student->sfull_name,
                            'image'=>$student->image,
                            'track_id'=>$student->track_id,
                            'points'=>$student->points,
                            'intake_id'=>$student->intake_id,
                        ),
                        'message'=>'login',
                        'type'=>'student',
                    );
                    session(['user_id'=>$student->id]);
                    session(['type'=>'student']);





                }
                elseif($student->password != $password)
                {
                    $rett=array('message'=>'password');
                }
//                else{
//                    $rett=array('message'=>'email');
//                }
            }

            else
            {
                $instructor= Instructor::where('email',$email)->first();

                if (count($instructor)){
                    if ($instructor->password == $password)
                    {
                        // echo "YOU ARE LOGIN";
                        $rett=array
                        (
                            'user'=> array
                            (
                                'id'=>$instructor->id,
                                'email'=>$instructor->email,
                                'ifull_name'=>$instructor->ifull_name,
                                'image'=>$instructor->image,
                            ),
                            'message'=>'login',
                            'type'=>'instructor'
                        );
                        session(['user_id'=>$instructor->id]);
                        session(['type'=>'instructor']);



                    }

                    elseif($instructor->password != $password)
                    {
                        $rett=array('message'=>'password');
                    }
                }

                else{
                    $rett=array('message'=>'email');
                }

            }


            return $rett;
        }


    public function gethomeuserdata(Request $request)
    {
        //return to anqular request user data to show
        $user_id=$request->input('user');
        //$user_id=2;
        $user_type=$request->input('type');
        if (session('user_id') == $user_id &&session('type') == $user_type)
        {
            //->select(DB::raw('count(*) as user_count, status'))

            if($user_type == 'student')
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

                $courses=DB::table('courses')
                    ->join('student_courses','courses.id','=','student_courses.course_id')
                    ->where('student_courses.student_id','=',$user_id)
                    ->select('courses.id','courses.course_name')
                    ->get();
                $i=0;
                $arr=[];
                foreach($courses as $course)
                {


                    $arr[$i]['id']=$course->id;
                    $arr[$i]['course_name']=$course->course_name;
                    $i++;
                }
                $user_courses=json_encode($arr);



                $latest_follow_question=DB::table('questions')
                    // ->join('answers','questions.id','=','answers.question_id')
                    ->join('courses','courses.id','=','questions.course_id')
                    ->join('student_courses','questions.course_id','=','student_courses.course_id')
                    ->where('student_courses.student_id','=',$user_id)
                    ->select('questions.id','courses.course_name','questions.content','questions.title','questions.time','questions.solved','student_courses.privilege')
                    ->orderBy('questions.time','desc')->take(10)
                    ->get();

                $i=0;
                $arr=[];
                foreach($latest_follow_question as $question)
                {


                    $arr[$i]['id']=$question->id;
                    $answers=DB::table('answers')
                        ->where('question_id','=',$question->id)
                        ->select(DB::raw('count(*) as count'))->get();
                    $arr[$i]['answer_number']=$answers[0]->count;
                    $arr[$i]['course_name']=$question->course_name;
                    $arr[$i]['content']=$question->content;
                    $arr[$i]['title']=$question->title;
                    $arr[$i]['solved']=$question->solved;
                    $arr[$i]['privilege']=$question->privilege;

                    $i++;
                }
                $user_latest_follow_question=json_encode($arr);

                $latest_all_question=DB::table('questions')
                    // ->join('answers','questions.id','=','answers.question_id')
                    // ->join('answers','questions.id','=','answers.question_id')
                    ->join('courses','courses.id','=','questions.course_id')
                    ->select('questions.id','courses.course_name','questions.content','questions.title','questions.time','questions.solved'/*,DB::raw('count(answers.question_id) as answers_num')*/)
                    ->orderBy('questions.time','desc')->take(10)
                    ->get();
                $i=0;
                $arr=[];
                foreach($latest_all_question as $question)
                {


                    $arr[$i]['id']=$question->id;
                    $answers=DB::table('answers')
                        ->where('question_id','=',$question->id)
                        ->select(DB::raw('count(*) as count'))->get();
                    $arr[$i]['answer_number']=$answers[0]->count;

                    $arr[$i]['course_name']=$question->course_name;
                    $arr[$i]['content']=$question->content;
                    $arr[$i]['title']=$question->title;
                    $arr[$i]['solved']=$question->solved;
                    $i++;
                }
                $user_latest_all_question=json_encode($arr);

            }
            else
            {

                $last_hit= Instructor::select('last_hit')->where('id',$user_id)->first();



                $notification = DB::table('notifications')
                    ->join('instructor_notifications', 'notifications.id', '=', 'instructor_notifications.notification_id')
                    ->where([
                        ['instructor_notifications.instructor_id','=',$user_id ],
                        ['notifications.time','>',$last_hit->last_hit],
                    ])
                    ->select(DB::raw('count(*) as count'))
                    ->get();
                $courses=DB::table('courses')
                    ->join('instructor_courses','courses.id','=','instructor_courses.course_id')
                    ->where('instructor_courses.instructor_id','=',$user_id)
                    ->select('courses.id','courses.course_name')
                    ->get();

                $i=0;
                $arr=[];
                foreach($courses as $course)
                {


                    $arr[$i]['id']=$course->id;
                    $arr[$i]['course_name']=$course->course_name;
                    $i++;
                }
                $user_courses=json_encode($arr);

                $latest_follow_question=DB::table('questions')
                    // ->join('answers','questions.id','=','answers.question_id')
                    ->join('courses','courses.id','=','questions.course_id')
                    ->join('instructor_courses','questions.course_id','=','instructor_courses.course_id')
                    ->where('instructor_courses.instructor_id','=',$user_id)
                    ->select('questions.id','courses.course_name','questions.content','questions.title','questions.time','questions.solved')
                    ->orderBy('questions.time','desc')->take(10)
                    ->get();

                $i=0;
                $arr=[];
                foreach($latest_follow_question as $question)
                {


                    $arr[$i]['id']=$question->id;
                    $answers=DB::table('answers')
                        ->where('question_id','=',$question->id)
                        ->select(DB::raw('count(*) as count'))->get();;
                    $arr[$i]['answer_number']=$answers[0]->count;
                    $arr[$i]['course_name']=$question->course_name;
                    $arr[$i]['content']=$question->content;
                    $arr[$i]['title']=$question->title;
                    $arr[$i]['solved']=$question->solved;
                    $i++;
                }
                $user_latest_follow_question=json_encode($arr);

                $latest_all_question=DB::table('questions')
                    // ->join('answers','questions.id','=','answers.question_id')
                    // ->join('answers','questions.id','=','answers.question_id')
                    ->join('courses','courses.id','=','questions.course_id')
                    ->select('questions.id','courses.course_name','questions.content','questions.title','questions.time','questions.solved'/*,DB::raw('count(answers.question_id) as answers_num')*/)
                    ->orderBy('questions.time','desc')->take(10)
                    ->get();

                $i=0;
                $arr=[];
                foreach($latest_all_question as $question)
                {


                    $arr[$i]['id']=$question->id;
                    $answers=DB::table('answers')
                        ->where('question_id','=',$question->id)
                        ->select(DB::raw('count(*) as count'));

                    $arr[$i]['answer_number']=$answers[0]->count;
                    $arr[$i]['course_name']=$question->course_name;
                    $arr[$i]['content']=$question->content;
                    $arr[$i]['title']=$question->title;
                    $arr[$i]['solved']=$question->solved;
                    $i++;
                }
                $user_latest_all_question=json_encode($arr);

            }

            $rett=array
            (
                'user'=> array
                (
                    'notification_num'=>$notification[0]->count,
                    'course_data'=>$user_courses,
                    'latest_follow_question'=>$user_latest_follow_question,
                    'latest_all_question'=>$user_latest_all_question,

                ),

            );

            return $rett;

        }





    }


   }
