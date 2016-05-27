<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Question;
use DateTime;
class QuestionController extends Controller
{
    //

    public function add_question(Request $request)
    {

        $title=$request->input('title');
        $content=$request->input('content');
        $image=$request->input('image');
        $student_id=$request->input('student_id');
        //*********** take data from anguler reqest => laravel => to me ***************
        $now = new DateTime();
        $date = $now->getTimestamp();

       $insert= DB::table('questions')->insertGetId(
            [
                'title' => $title,
                'content' => $content,
                'image'=>$image,
                'student_id'=>$student_id,
                'date'=>$date,
            ]
        );
        if ($insert==1)
        {

        }
        //********** insert data into questions table


    }
}
