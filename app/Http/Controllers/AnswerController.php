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

        $user_id=$request->input('user_id');
        $type = $request->input('type');

        if (session('user_id') == $user_id &&session('type') == $type)

        {
            $answer = Answer::find($id);
            $question = Question::find($answer->question_id);

            if ($answer->accepted == 0 && $question->solved == 0)
            {
                $answer->accepted = 1;
                $answer->save();
                $question->solved=1;
                $question->save();

                if($answer->instructor_id==null)
                {
                    DB::table('students')
                        ->where('id',$answer->student_id)
                        ->increment('points',5);
                    return "true";

                }
                else
                {
                    DB::table('instructors')
                        ->where('id',$answer->instructor_id)
                        ->increment('points',5);
                    return "true";

                }
            }
            else
            {
                return "false";
            }
        }

    }

    public function unaccept_answer(Request $request)
    {

        $id = $request->input('id');
        $user_id=$request->input('user_id');
        $type =$request->input('type');
        if (session('user_id') == $user_id &&session('type') == $type)
        {
            $answer = Answer::find($id);
            $question = Question::find($answer->question_id);

            if ($answer->accepted == 1 && $question->solved ==1 ) {
                $answer->accepted = 0;
                $answer->save();
                $question->solved =0;
                $question->save();

                if($answer->instructor_id==null)
                {
                    DB::table('students')
                        ->where('id',$answer->student_id)
                        ->decrement('points',5);
                    return "true";

                }
                else
                {
                    DB::table('instructors')
                        ->where('id',$answer->instructor_id)
                        ->decrement('points',5);
                    return "true";

                }

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
        //$content="opa alalla";
        $image = $answersdata['image'];
        $question_id = $answersdata['question_id'];
        //echo $content;

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
       $answer_id=$request->input('answer_id');
       $user_type=$request->input('type');
       $user_id=$request->input('user_id');
        //echo $user_id;

//         $answer_id=1;
//         $user_type="instructor";
//         $user_id=1;

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
            $user_id= Answer::select('instructor_id','student_id')->where('id',$answer_id)->first();

            if ($user_id->instructor_id == null)
            {
                $answered_user_id=$user_id->student_id;

                if ($user_type == 'student')
                {
                    DB::table('students')
                        ->where('id', $answered_user_id)
                        ->increment('points');
                }
                //if like from instructor
                else
                {
                    DB::table('students')
                        ->where('id', $answered_user_id)
                        ->increment('points',5);
                }
            }
            else
            {
                $answered_user_id=$user_id->instructor_id;
                if ($user_type == 'instructor')
                {
                    DB::table('instructors')
                        ->where('id', $answered_user_id)
                        ->increment('points');
                }
                //if like from instructor
                else
                {
                    DB::table('instructors')
                        ->where('id', $answered_user_id)
                        ->increment('points',5);
                }
            }
                //**increment student points in 2 case if student or instructor



        }
    }

    public function like_remove(Request $request)
    {

        $answer_id=$request->input('answer_id');
        $user_type=$request->input('type');
        $user_id=$request->input('user_id');
        if (session('user_id') == $user_id &&session('type') == $user_type)
        {

            DB::table('likes')
                ->where([
                    ['answer_id','=',$answer_id ],
                    ['id','=',$user_id],
                    ['type','=',$user_type,],
                ])->delete();
            $user_id= Answer::select('instructor_id','student_id')->where('id',$answer_id)->first();

            if ($user_id->instructor_id == null)
            {
                $answered_user_id=$user_id->student_id;

                if ($user_type == 'student')
                {
                    DB::table('students')
                        ->where('id', $answered_user_id)
                        ->decrement('points');
                }
                //if like from instructor
                else
                {
                    DB::table('students')
                        ->where('id', $answered_user_id)
                        ->decrement('points',5);
                }
            }
            else
            {
                $answered_user_id=$user_id->instructor_id;
                if ($user_type == 'instructor')
                {
                    DB::table('instructors')
                        ->where('id', $answered_user_id)
                        ->decrement('points');
                }
                //if like from instructor
                else
                {
                    DB::table('instructors')
                        ->where('id', $answered_user_id)
                        ->decrement('points',5);
                }
            }

        }
    }

    public function dislike_action(Request $request)
    {
       $answer_id=$request->input('answer_id');
       $user_type=$request->input('type');
       $user_id=$request->input('user_id');
//        $answer_id=1;
//        $user_type="instructor";
//        $user_id=1;
        //select user who write thid answer
        if (session('user_id') == $user_id &&session('type') == $user_type)
        {
//            $update= DB::table('likes')
//                ->where([
//                    ['answer_id','=',$answer_id ],
//                    ['id','=',$user_id],
//                    ['type','=',$user_type,],
//                ])
//                ->update(['like' => 0]);

            $insert=DB::table('likes')->insertGetId(
                [
                    'id'=>$user_id,
                    'answer_id'=>$answer_id,
                    'type'=>$user_type,
                    'like'=>0,
                ]
            );
            //**increment student points in 2 case if student or instructor
            $user_id= Answer::select('instructor_id','student_id')->where('id',$answer_id)->first();

            if ($user_id->instructor_id == null)
            {
                $answered_user_id=$user_id->student_id;

                if ($user_type == 'student')
                {
                    DB::table('students')
                        ->where('id', $answered_user_id)
                        ->decrement('points');
                }
                //if like from instructor
                else
                {
                    DB::table('students')
                        ->where('id', $answered_user_id)
                        ->decrement('points',5);
                }
            }
            else
            {
                $answered_user_id=$user_id->instructor_id;
                if ($user_type == 'instructor')
                {
                    DB::table('instructors')
                        ->where('id', $answered_user_id)
                        ->decrement('points');
                }
                //if like from instructor
                else
                {
                    DB::table('instructors')
                        ->where('id', $answered_user_id)
                        ->decrement('points',5);
                }
            }
        }
    }


    //******** Golden Mark ******************/

    public function golden_mark(Request $request)
    {
        $answer_id = $request->input('answer_id');
        $user_id=$request->input('user_id');
        $type = $request->input('type');
        echo $answer_id;

        if(session('user_id')==$user_id && session('type')== 'instructor'){


            $answer= DB::table('answers')
                        ->where('id',$answer_id)
                        ->first();
            if($answer->golden == 0  && $answer->instructor_id == null)
            {
                $update_answer= DB:: table('answers')
                    ->where('id',$answer_id)
                    ->update(['golden' => 1]);

                DB::table('students')
                    ->where('id',$answer->student_id)
                    ->increment('points',10);

                echo "true"."<br>";

            }
            else
            {
                echo "false golden value"."<br>";
            }
        }
        else
        {
            return "false session";
        }
    }



    public function ungolden_mark(Request $request)
    {
        $answer_id = $request->input('id');
        $user_id=$request->input('user_id');
        $type = $request->input('type');

        if(session('user_id')==$user_id && session('type')== 'instructor'){


            $answer= DB::table('answers')
                ->where('id',$answer_id)
                ->first();
            if($answer->golden == 1  && $answer->instructor_id == '')
            {
                $update_answer= DB:: table('answers')
                    ->where('id',$answer_id)
                    ->update(['golden' => 0]);

                DB::table('students')
                    ->where('id',$answer->student_id)
                    ->decrement('points',10);

                echo "true"."<br>";

            }
            else
            {
                echo "false golden value"."<br>";
            }
        }
        else
        {
            return "false session";
        }
    }


    public function dislike_remove(Request $request)
    {
        $answer_id=$request->input('answer_id');
        $user_type=$request->input('type');
        $user_id=$request->input('user_id');
//        $answer_id=1;
//        $user_type="instructor";
//        $user_id=1;
        if (session('user_id') == $user_id &&session('type') == $user_type) {
            //select user who write thid answer
            //insert new row for new like
            DB::table('likes')
                ->where([
                    ['answer_id','=',$answer_id ],
                    ['id','=',$user_id],
                    ['type','=',$user_type,],
                ])->delete();
            $user_id= Answer::select('instructor_id','student_id')->where('id',$answer_id)->first();

            if ($user_id->instructor_id == null)
            {
                $answered_user_id=$user_id->student_id;

                if ($user_type == 'student')
                {
                    DB::table('students')
                        ->where('id', $answered_user_id)
                        ->increment('points');
                }
                //if like from instructor
                else
                {
                    DB::table('students')
                        ->where('id', $answered_user_id)
                        ->increment('points',5);
                }
            }
            else
            {
                $answered_user_id=$user_id->instructor_id;
                if ($user_type == 'instructor')
                {
                    DB::table('instructors')
                        ->where('id', $answered_user_id)
                        ->increment('points');
                }
                //if like from instructor
                else
                {
                    DB::table('instructors')
                        ->where('id', $answered_user_id)
                        ->increment('points',5);
                }
            }
            //**increment student points in 2 case if student or instructor
        }
    }


}
