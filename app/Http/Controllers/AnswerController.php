<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Answer;

class AnswerController extends Controller
{
    //
    public function accept_answer(Request $request){

            $id=$request->input('id');
//            echo "id = ".$id;
        $answer=Answer::find($id);
        $answer->accepted=!($answer->accepted);
        $answer->save();

    }
}
