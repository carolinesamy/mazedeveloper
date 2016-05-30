<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DateTime;
use DB;

class ReplyController extends Controller
{
    //
    public function reply(Request $request)
    {
        $reply=$request->input('reply');
        $user_id=$reply['user_id'];
        $user_type=$reply['type'];
        $answer_id=$reply['answer_id'];
        $content=$reply['content'];

//        $user_id=1;
//        $user_type='student';
//        $answer_id=1;
//        $content='reply3';

        $now = new DateTime();
        $date=$now->format('Y-m-d H:i:s');

        if ($user_type == 'student')
        {
            $insert= DB::table('replies')->insertGetId(
                [
                    'content' => $content,
                    'time'=>$date,
                    'answer_id'=>$answer_id,
                    'student_id'=>$user_id,
                ]
            );

        }
        else
        {
            $insert= DB::table('replies')->insertGetId(
                [
                    'content' => $content,
                    'time'=>$date,
                    'answer_id'=>$answer_id,
                    'instructor_id'=>$user_id,
                ]
            );

        }
        if ($insert > 0 )
        {
            return "true";

        }
        else
        {
            return "false";
        }

    }
}
