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
            $email=$request->input('email');
            $password=$request->input('password');
            $student= Student::where('email',$email)->first();
            //echo $student;
           if ($student->password == $password)
           {
                echo "YOU ARE LOGIN";
               echo $student;
           }
            else
            {
                echo "Mesh 3alya da e7na AMC2";

            }


        }
   }
