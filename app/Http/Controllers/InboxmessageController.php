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
                    ->join('students','students.id', '=','inbox_messages.student_id')
                    ->where([
                        ['inbox_messages.instructor_id','=',$user_id ],
                        ['inbox_messages.sender_student','=',1],
                    ])
                    ->select('inbox_messages.message','inbox_messages.time','inbox_messages.id','students.sfull_name as name')
                    ->get();
                $now = new DateTime();
                $date=$now->format('Y-m-d H:i:s');

                $update_lasthit= DB:: table('instructors')
                    ->where('id',$user_id)
                    ->update(['last_hit_msg' => $date]);

            }
            else
            {
                $inboxmsg = DB::table('inbox_messages')
                    ->join('instructors','instructors.id', '=','inbox_messages.instructor_id')

                    ->where([
                        ['inbox_messages.student_id','=',$user_id ],
                        ['inbox_messages.sender_student','=',0],
                    ])
                    ->select('inbox_messages.message','inbox_messages.time','inbox_messages.id','instructors.ifull_name as name')
                    ->get();

                $now = new DateTime();
                $date=$now->format('Y-m-d H:i:s');

                $update_lasthit= DB:: table('students')
                    ->where('id',$user_id)
                    ->update(['last_hit_msg' => $date]);


            }

            return $inboxmsg;


        }
    }
    public function get_msg_notification_num(Request $request)
    {

        $msg =0;
        $user_id = $request->input('id');
        $user_type = $request->input('type');

        if (session('user_id') == $user_id && session('type') == $user_type && $user_id!=null )
        {
            if ($user_type == 'student')
            {
                $last_hit= Student::select('last_hit_msg')->where('id',$user_id)->first();

                $msg = DB::table('inbox_messages')
                    ->where([
                        ['student_id','=',$user_id ],
                        ['time','>',$last_hit->last_hit_msg],
                        ['sender_student','=',0],
                    ])
                    ->select(DB::raw('count(*) as count'))
                    ->get();
            }
            else
            {

                $last_hit = Instructor::select('last_hit_msg')->where('id', $user_id)->first();
                $msg = DB::table('inbox_messages')
                    ->where([
                        ['instructor_id','=',$user_id ],
                        ['time','>',$last_hit->last_hit_msg],
                        ['sender_student','=',1],
                    ])
                    ->select(DB::raw('count(*) as count'))
                    ->get();

            }

        }
        return $msg;


    }

    public function get_msg_data(Request $request)
    {

        $msg=0;
        $user_id = $request->input('id');
        $user_type = $request->input('type');


        if (session('user_id') == $user_id && session('type') == $user_type && $user_id!=null )
        {

            if ($user_type == 'student')
            {
                $msg = DB::table('inbox_messages')
                    ->where([
                        ['student_id','=',$user_id ],
                        ['sender_student','=',0],
                    ])
                    ->select('id','message','instructor_id','time')
                    ->orderBy('time', 'desc')
                    ->take(7)
                    ->get();

                $now = new DateTime();
                $date=$now->format('Y-m-d H:i:s');

                $update_lasthit= DB:: table('students')
                    ->where('id',$user_id)
                    ->update(['last_hit_msg' => $date]);
            }
            else
            {

                $msg = DB::table('inbox_messages')
                    ->where([
                        ['instructor_id','=',$user_id ],
                        ['sender_student','=',1],
                    ])
                    ->select('id','message','student_id','time')
                    ->orderBy('time', 'desc')
                    ->take(7)
                    ->get();

                $now = new DateTime();
                $date=$now->format('Y-m-d H:i:s');

                $update_lasthit= DB:: table('instructors')
                    ->where('id',$user_id)
                    ->update(['last_hit_msg' => $date]);
            }

        }
        return $msg;


    }




}
