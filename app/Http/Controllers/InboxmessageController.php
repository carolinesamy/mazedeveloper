<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

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
        $reciveruser = $request->input('reciver_user');
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

    public function all_instructors(Request $request)
    {
        $user_id=$request->input('user_id');
        $type=$request->input('type');

        if (session('user_id') == $user_id &&session('type') == $type) {
            if($type == 'instructor')
            {
                $names = DB::table('students')
                    ->select('id','sfull_name as name')
                    ->get();

            }
            else
            {
                $names = DB::table('instructors')
                    ->select('id','ifull_name as name')
                    ->get();

            }


            return $names;
        }
    }
    public function inbox_msg(Request $request)
    {
        $user_id=$request->input('user_id');
        $type=$request->input('type');

        if (session('user_id') == $user_id &&session('type') == $type) {


            if($type == 'instructor')
            {

                $inboxmsg = DB::table('inbox_messages')
                    ->where([
                        ['inbox_messages.instructor_id','=',$user_id ],
                        ['inbox_messages.sender_student','=',1],
                    ])
                    ->select('inbox_messages.message','inbox_messages.time','inbox_messages.student_id')
                    ->get();

            }
            else
            {
                $inboxmsg = DB::table('inbox_messages')
                    ->where([
                        ['inbox_messages.student_id','=',$user_id ],
                        ['inbox_messages.sender_student','=',0],
                    ])
                    ->select('inbox_messages.message','inbox_messages.time','inbox_messages.instructor_id')
                    ->get();
            }

            return $inboxmsg;


        }
    }



}
