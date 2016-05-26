<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Student;
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
               return $student;

           }
            else
            {
                return "Mesh 3alya da e7na AMC2";

            }


        }
   }
