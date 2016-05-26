<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Answer;
use App\Question;

class AnswerController extends Controller
{
    //
    public function accept_answer(Request $request){

        $id=$request->input('id');
//            echo "id = ".$id;
        $answer=Answer::find($id);
        $question=Question::find($answer->question_id);

        if($answer->accepted == 0 && $question->solved ==0)
        {
            $answer->accepted=1;
            $answer->save();
            $question->solved=1;
            $question->save();
//            echo "the accepted".$answer->accepted;
//            echo "the solved".$question->solved;
            return "true";
        }
        else{
//            echo "error";
            return "false";
        }

    }
    public function unaccept_answer(Request $request){

        $id=$request->input('id');
//            echo "id = ".$id;
        $answer=Answer::find($id);
        $question=Question::find($answer->question_id);

        if($answer->accepted == 1 && $question->solved == 1)
        {
            $answer->accepted=0;
            $answer->save();
            $question->solved=0;
            $question->save();
//            echo "the accepted".$answer->accepted;
//            echo "the solved".$question->solved;

            return "true";
        }
        else{
//            echo "error";

            return "false";
        }

    }
}
