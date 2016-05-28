<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Student;
use App\StudentNotification;
use App\Answer;
use App\Question;
use App\Instructor;


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

    public function gethomeuserdata(Request $request)
    {
        //return to anqular request user data to show

    }

   }
