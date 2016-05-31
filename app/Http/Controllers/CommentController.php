<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DateTime;
use DB;

class CommentController extends Controller
{
    //
    public function comment(Request $request)
    {
        $comment=$request->input('comment');
        $user_id=$comment['user_id'];
        $user_type=$comment['type'];
        $question_id=$comment['question_id'];
        $content=$comment['content'];


        $now = new DateTime();
        $date=$now->format('Y-m-d H:i:s');

        if ($user_type == 'student')
        {
            $insert= DB::table('comments')->insertGetId(
                [
                    'content' => $content,
                    'time'=>$date,
                    'question_id'=>$question_id,
                    'student_id'=>$user_id,
                ]
            );

            $ret=array(

                'content' => $content,
                'time'=>$date,
                'question_id'=>$question_id,
                'student_id'=>$user_id,
                'comment_id'=>$insert
            );

        }
        else
        {
            $insert= DB::table('comments')->insertGetId(
                [
                    'content' => $content,
                    'time'=>$date,
                    'question_id'=>$question_id,
                    'instructor_id'=>$user_id,
                ]
            );
            $ret=array(

                'content' => $content,
                'time'=>$date,
                'question_id'=>$question_id,
                'instructor_id'=>$user_id,
                'comment_id'=>$insert

            );

        }
        if ($insert > 0 )
        {
            return $ret;

        }
        else
        {
            return "false";
        }
    }
}
