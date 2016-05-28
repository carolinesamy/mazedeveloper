<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\StudentNotification;
use App\Answer;
use App\Question;

class StudentController extends Controller
{
    //


        public function login(Request $request)
        {
            $user=$request->input('user');

            $password=$user['password'];
            $email=$user['email'];

            $student= Student::where('email',$email)->first();
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
                   'message'=>'login'
               );


           }
            elseif($student->password != $password)
            {
                $rett=array('message'=>'password');
            }
            else
            {
                $rett=array('message'=>'email');
            }

            return $rett;
        }

    public function gethomeuserdata(Request $request)
    {
        //return to anqular request user data to show

    }

   }
