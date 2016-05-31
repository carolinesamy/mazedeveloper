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

            $return_data=array(

                'answer_content' => $content,
                'answer_image' => $image,
                'answer_student_id' => $user_id,
                'answer_time' => $date,
                'answer_id'=>$insert,
                'accepted'=>0
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

                $return_data=array(

                    'answer_content' => $content,
                    'answer_image' => $image,
                    'answer_instructor_id' => $user_id,
                    'answer_time' => $date,
                    'answer_id'=>$insert,
                    'accepted'=>0
                );



            }

            //*********** take data from anguler reqest => laravel => to me ***************

            if ($insert > 0)
            {
                return $return_data;

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
        $answer_id=$answersdata['answer_id'];
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

       if (session('user_id') == $user_id &&session('type') == $user_type)
        {
            //insert new row for new like
            $insert=DB::table('likes')->insertGetId(
                [
                    'id'=>$user_id,
                    'answer_id'=>$answer_id,
                    'type'=>$user_type,
                ]
            );
            //select instructor to know writer type
            $instructor_id= Answer::select('instructor_id')->where('id',$answer_id)->first();

            if ($instructor_id->instructor_id == null)
            {

                $answered_user_id= Answer::select('student_id')->where('id',$answer_id)->first();
                //**increment student points in 2 case if student or instructor

                if ($user_type == 'student')
                {
                    DB::table('students')
                        ->where('id', $answered_user_id->student_id)
                        ->increment('points');
                }
                //if like from instructor
                else
                {
                    DB::table('students')
                        ->where('id', $answered_user_id->student_id)
                        ->increment('points',5);
                }
           }
        }
    }
    public function dislike_remove(Request $request)
    {
//        $answer_id=$request->input('id');
//        $user_type=$request->input('type');
//        $user_id=$request->input('user_id');
        $answer_id=1;
        $user_type="student";
        $user_id=1;
        if (session('user_id') == $user_id &&session('type') == $user_type) {
            //select user who write thid answer
            //insert new row for new like
            DB::table('likes')
                ->where([
                    ['answer_id','=',$answer_id ],
                    ['id','=',$user_id],
                    ['type','=',$user_type,],
                ])->delete();
            $instructor_id= Answer::select('instructor_id')->where('id',$answer_id)->first();

            if ($instructor_id->instructor_id == null)
            {
                $answered_user_id = Answer::select('student_id')->where('id', $answer_id)->first();

                if ($user_type == 'student') {
                    DB::table('students')
                        ->where('id', $answered_user_id->student_id)
                        ->increment('points');
                } //if like from instructor
                else {
                    DB::table('students')
                        ->where('id', $answered_user_id->student_id)
                        ->increment('points', 5);
                }
            }
            //**increment student points in 2 case if student or instructor
        }
    }
    public function like_remove(Request $request)
    {
        $answer_id=1;
        $user_type="student";
        $user_id=1;

//        $answer_id=$request->input('id');
//        $user_type=$request->input('type');
//        $user_id=$request->input('user_id');
        if (session('user_id') == $user_id &&session('type') == $user_type) {

            DB::table('likes')
                ->where([
                    ['answer_id','=',$answer_id ],
                    ['id','=',$user_id],
                    ['type','=',$user_type,],
                ])->delete();
            $instructor_id= Answer::select('instructor_id')->where('id',$answer_id)->first();
            if ($instructor_id->instructor_id == null)
            {
                $answered_user_id = Answer::select('student_id')->where('id', $answer_id)->first();

                if ($user_type == 'student') {
                    DB::table('students')
                        ->where('id', $answered_user_id->student_id)
                        ->decrement('points');
                } //if like from instructor
                else {
                    DB::table('students')
                        ->where('id', $answered_user_id->student_id)
                        ->decrement('points', 5);
                }
            }
        }
    }

    public function dislike_action(Request $request)
    {
//        $answer_id=$request->input('id');
//        $user_type=$request->input('type');
//        $user_id=$request->input('user_id');
        $answer_id=1;
        $user_type="student";
        $user_id=1;
        //select user who write thid answer
        if (session('user_id') == $user_id &&session('type') == $user_type)
        {
            $update= DB::table('likes')
                ->where([
                    ['answer_id','=',$answer_id ],
                    ['id','=',$user_id],
                    ['type','=',$user_type,],
                ])
                ->update(['like' => 0]);
            //**increment student points in 2 case if student or instructor
            $instructor_id= Answer::select('instructor_id')->where('id',$answer_id)->first();

            if ($instructor_id->instructor_id == null)
            {
                $answered_user_id = Answer::select('student_id')->where('id',$answer_id)->first();
                if ($user_type == 'student')
                {
                    DB::table('students')
                        ->where('id', $answered_user_id->student_id)
                        ->decrement('points');
                }
                else
                {
                    DB::table('students')
                        ->where('id',  $answered_user_id->student_id)
                        ->decrement('points',5);
                }
            }
        }
    }
}
