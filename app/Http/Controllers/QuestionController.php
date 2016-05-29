<?php
//* not Done

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Question;
use DateTime;
class QuestionController extends Controller
{
    //

    public function add_question(Request $request)
    {


        $title=$request->input('title');
        $content=$request->input('content');
        $image=$request->input('image');
        $student_id=$request->input('student_id');
        //**** join by names****//
        $tag_id=$request->input('tag_id');
        $course_id=$request->input('course_id');

        echo $title;
        //*********** take data from anguler reqest => laravel => to me ***************
        $now = new DateTime();
//        $date = $now->getTimezone();
        $date=$now->format('Y-m-d H:i:s');
       $insert= DB::table('questions')->insertGetId(
            [
                'title' => $title,
                'content' => $content,
                'image'=>$image,
                'student_id'=>$student_id,
                'time'=>$date,
                'course_id'=>$course_id,
            ]
        );
        
        foreach($tag_id as $tag)
        {
            DB::table('question_tags')->insertGetID(
                [
                    'question_id'=>$insert,
                    'tag_id'=>$tag,
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
        //********** insert data into questions table

    }


    public function get_question(Request $request){
        return $request->input('id');
    }

    public function complete(Request $request){
        $text=$request->input('sentance');

        $question_titles= Question::select('title')->where('title','like',$text."%")->get();

        return $question_titles;
    }
}
