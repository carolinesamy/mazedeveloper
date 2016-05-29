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

    public function edit_question(Request $request)
    {
/**take from angular side :
    question id && question updated data*/

        $question_id=$request->input('id');
        $title=$request->input('title');
        $content=$request->input('content');
        $image=$request->input('image');

        $tag_id=$request->input('tag_id');

        $now = new DateTime();
        $date=$now->format('Y-m-d H:i:s');

        //start update data in question table*****
        $update=DB::table('questions')
            ->where('id', $question_id)
            ->update([
                'title' => $title,
                'content' => $content,
                'image'=>$image,
                'time'=>$date,
            ]);
        // delete old tags to insert new tags**
        DB::table('question_tags')->where('question_id', '=', $question_id)->delete();

        foreach($tag_id as $tag)
        {
            DB::table('question_tags')->insertGetID(
                [
                    'question_id'=>$question_id,
                    'tag_id'=>$tag,
                ]
            );

        }



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
