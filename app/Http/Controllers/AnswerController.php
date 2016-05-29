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

    public function unaccept_answer(Request $request)
    {

        $id = $request->input('id');
        $answer = Answer::find($id);
        $question = Question::find($answer->question_id);

        if ($answer->accepted == 1 && $question->solved == 1) {
            $answer->accepted = 0;
            $answer->save();
            $question->solved = 0;
            $question->save();

            return "true";
        } else {
            return "false";
        }

    }

    public function add_answer(Request $request)
    {
        $answersdata = $request->input('answer');
        $content = $answersdata['content'];
        $image = $answersdata['image'];
        $question_id = $answersdata['question_id'];
        $user_id = $answersdata['id'];
        $user_type = $answersdata['type'];

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

        } else {
            $insert = DB::table('answers')->insertGetId(
                [
                    'content' => $content,
                    'image' => $image,
                    'instructor_id' => $user_id,
                    'time' => $date,
                    'question_id' => $question_id,
                ]
            );

        }

        //*********** take data from anguler reqest => laravel => to me ***************

        if ($insert > 0) {
            return "true";

        } else {
            return "false";
        }


    }

    public function edit_answer(Request $request)
    {
        $answersdata=$request->input('answer');
        $answer_id=$answersdata['id'];
        $content=$answersdata['content'];
        $image=$answersdata['image'];

        $now = new DateTime();
        $date=$now->format('Y-m-d H:i:s');


            $insert= DB::table('answers')
                ->where('id', $answer_id)
                ->update(
                [
                    'content' => $content,
                    'image'=>$image,
                    'time'=>$date,
                ]
            );

        }
}
