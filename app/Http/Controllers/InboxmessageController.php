<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Inboxmessage;
use App\Instructor;
use App\Student;
use DB;
use DateTime;

class InboxmessageController extends Controller
{
    //
    public function send_message(Request $request)
    {
        $senduser_id = $request->input('user_id');
        $senduser_type = $request->input('type');
        $reciveruser = $request->input('reciveruser');
        $message=$request->input('message');

        if (session('user_id') == $senduser_id &&session('type') ==  $senduser_type)
        {

            $now = new DateTime();
            $date = $now->format('Y-m-d H:i:s');

            if ($senduser_type == 'student') {
                $insert = DB::table('inbox_messages')->insertGetId(
                    [
                        'student_id'=>$senduser_id,
                        'instructor_id'=>$reciveruser,
                        'message'=>$message,
                        'time'=>$date,
                        'sender_student'=>1,
                    ]
                );

            }
            // if instructor is he who send the msg
            else
            {
                $insert = DB::table('inbox_messages')->insertGetId(
                    [
                        'student_id'=>$reciveruser,
                        'instructor_id'=>$senduser_id,
                        'message'=>$message,
                        'time'=>$date,
                        'sender_student'=>0,
                    ]
                );

            }

        }

    }

}
