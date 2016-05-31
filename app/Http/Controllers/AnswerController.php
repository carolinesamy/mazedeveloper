<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Answer;
use App\Question;
use DateTime;
use DB;

use App\Instructor;
use App\Student;
class AnswerController extends Controller
{
    //
    public function accept_answer(Request $request)
    {

        $id = $request->input('id');
        $type = $request->input('type');

        if (session('user_id') == $id &&session('type') == $type)

        {
            $answer = Answer::find($id);
            $question = Question::find($answer->question_id);

            if ($answer->accepted == 0 && $question->solved == 0) {
                $answer->accepted = 1;
                $answer->save();
                $question->solved = 1;
                $question->save();
                return "true";
            } else {
                return "false";
            }
        }

    }

    public function unaccept_answer(Request $request)
    {

        $id = $request->input('id');
        $type = $request->input('type');
        if (session('user_id') == $id &&session('type') == $type)
        {
            $answer = Answer::find($id);
            $question = Question::find($answer->question_id);

            if ($answer->accepted == 1 && $question->solved == 1) {
                $answer->accepted = 0;
                $answer->save();
                $question->solved = 0;
                $question->save();

                return "true";
            }
            else
            {
                return "false";
            }
        }



    }

    public function add_answer(Request $request)
    {
        $answersdata = $request->input('answer');
        $user_id = $answersdata['id'];
        $user_type = $answersdata['type'];
        $content = $answersdata['content'];
        $image = $answersdata['image'];
        $question_id = $answersdata['question_id'];

        if (session('user_id') == $user_id &&session('type') == $user_type)
        {

            $now = new DateTime();
            $date = $now->format('Y-m-d H:i:s');

            if ($user_type == 'student') {
                $insert = DB::table('answers')->insertGetId(
                    [
                        'content' => $content,
                        'image' => $image,
                        'student_id' => $user_id,
                        'time' => $date,
                        'question_id' => $question_id,
                    ]
                );

                $ret_data=array(

                    'content' => $content,
                    'image' => $image,
                    'student_id' => $user_id,
                    'time' => $date,
                    'question_id' => $question_id,
                    'reply_id'=>$insert
                );

            }
            else
            {
                $insert = DB::table('answers')->insertGetId(
                    [
                        'content' => $content,
                        'image' => $image,
                        'instructor_id' => $user_id,
                        'time' => $date,
                        'question_id' => $question_id,
                    ]
                );
                $ret_data=array(

                    'content' => $content,
                    'image' => $image,
                    'instructor_id' => $user_id,
                    'time' => $date,
                    'question_id' => $question_id,
                    'reply_id'=>$insert
                );

            }

            //*********** take data from anguler reqest => laravel => to me ***************

            if ($insert > 0)
            {
                return $ret_data;

            }
            else
            {
                return "false";
            }

        }

    }

    public function edit_answer(Request $request)
    {
        $answersdata=$request->input('answer');
        $user_id = $answersdata['id'];
        $user_type = $answersdata['type'];
        $answer_id=$answersdata['id'];
        $content=$answersdata['content'];
        $image=$answersdata['image'];

//        $answer_id=1;
//        $content="opaa allaaa";
//        $image='p5';

        if (session('user_id') == $user_id &&session('type') == $user_type)
        {
            $now = new DateTime();
            $date=$now->format('Y-m-d H:i:s');


            $update= DB::table('answers')
                ->where('id', $answer_id)
                ->update(
                    [
                        'content' => $content,
                        'image'=>$image,
                        'time'=>$date,
                    ]
                );
            if ($update > 0)
            {
                return "true";

            }
            else
            {
                return "false";
            }

        }




    }

    public function like_action(Request $request)
    {
//        $answer_id=$request->input('answer_id');
//        $user_type=$request->input('type')
//        $user_id=$request->input('user_id');


        $answer_id=1;
        $user_type="student";
        $user_id=1;
//        DB::table('answers')
//            ->where('id', $answer_id)
//            ->increment('likes');

        if (session('user_id') == $user_id &&session('type') == $user_type)
        {
            //select user who write thid answer
            $user_id= Answer::select('student_id')->where('id',$answer_id)->first();
            //insert new row for new like

            $insert=DB::table('likes')->insertGetId(
                [
                    'id'=>$user_id->student_id,
                    'answer_id'=>$answer_id,
                    'type'=>$user_type,
                ]
            );
            //**increment student points in 2 case if student or instructor
            if ($user_type == 'student')
            {
                DB::table('students')
                    ->where('id', $user_id)
                    ->increment('points');



            }
            else
            {
                DB::table('students')
                    ->where('id', $user_id)
                    ->increment('points',5);

            }


            print_r($user_id->student_id) ;


        }




    }

    public function dislike_action(Request $request)
    {
//        $answer_id=$request->input('id');
//        $user_type=$request->input('type');
//        $user_id=$request->input('user_id');

        $answer_id=2;
        $user_type="instructor";
        $user_id=1;

        //select user who write thid answer

        if (session('user_id') == $user_id &&session('type') == $user_type)
        {
            DB::table('answers')
                ->where('id', $answer_id)
                ->decrement('likes');

            $user_id= Answer::select('student_id')->where('id',$answer_id)->first();


            $update= DB::table('likes')
                ->where([
                    ['answer_id','=',$answer_id ],
                    ['id','=',$user_id],
                    ['type','=',$user_type,],
                ])
                ->update(['like' => 0]);
            //**increment student points in 2 case if student or instructor

            if ($user_type == 'student')
            {
                DB::table('students')
                    ->where('id', $user_id)
                    ->decrement('points');

            }
            else
            {
                DB::table('students')
                    ->where('id', $user_id)
                    ->decrement('points',5);

            }

        }




    }
}
