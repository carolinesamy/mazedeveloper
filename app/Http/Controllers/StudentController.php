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
                        'type'=>'student'
                    );


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
                                'points'=>$instructor->points,
                            ),
                            'message'=>'login',
                            'type'=>'instructor'
                        );


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


//                ->join('StudentNotification', function ($join) {
//                    $join->on('notifications.id', '=', 'student_notifications.student_id')
//                        ->where([
//                            ['notifications.id',$user_id],
//                            ['notifications.time','>',$last_hit],
//                        ]);
//                })

    public function gethomeuserdata(Request $request)
    {
        //return to anqular request user data to show
        $user_id=$request->input('user');
        $user_type=$request->input('type');

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
            
        }


        $notification_num=$notification[0]->count;

        return $notification_num;



    }

   }
