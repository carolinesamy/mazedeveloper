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
        $user_type=$request->input('type');
        $tag_id=$request->input('tag_id');
        $course_id=$request->input('course_id');


        if (session('user_id') == $student_id &&session('type') == $user_type)
        {
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

        //*********** take data from anguler reqest => laravel => to me ***************

    }

    public function edit_question(Request $request)
    {
/**take from angular side :
    question id && question updated data*/

        $student_id=$request->input('student_id');
        $user_type=$request->input('type');
        $question_id=$request->input('id');
        $title=$request->input('title');
        $content=$request->input('content');
        $image=$request->input('image');
//
//        $tag_id=$request->input('tag_id');
        if (session('user_id') == $student_id &&session('type') == $user_type)
        {
            $tag_id=[2,1];

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
//            $question_id=1;
//        $title="ana el title";
//        $content="ana el content";
//        $image="ana el image";




    }
/**************** by christina *****************/

    public function get_question(Request $request){
        $question_id=$request->input('id');
        $user_id=$request->input('user_id');
        $type=$request->input('type');
        $questions = DB::table('questions')->get();

        /** question with user data ***/
        $questiondata = DB::table('questions')
                ->join('students','questions.student_id', '=', 'students.id')
                ->where('questions.id', '=', $question_id)
                ->select('questions.student_id as question_student_id','questions.title as question_title', 'questions.content as question_content','questions.image as question_image','questions.time as question_time','questions.solved','questions.course_id as question_course','students.sfull_name as student_name', 'students.image as student_image','students.points as student_points')
                ->get();
        /** answers with the data of the person who asks **/


        $instructoranswerdata =DB::table('questions')
                ->join('answers','questions.id', '=', 'answers.question_id')
                ->join('instructors', 'answers.instructor_id', '=', 'instructors.id')
                ->where('answers.question_id', '=', $question_id)
                ->select('answers.id as answer_id','answers.content as answer_content','answers.image as answer_image','answers.time as answer_time','answers.accepted','instructors.ifull_name as instructor_name', 'instructors.image as instructor_image')
                ->get();
        $studentanswerdata =DB::table('questions')
                ->join('answers','questions.id', '=', 'answers.question_id')
                ->join('students','answers.student_id', '=', 'students.id')
                ->where('answers.question_id', '=', $question_id)
                ->select('answers.student_id as answer_student_id','answers.id as answer_id','answers.content as answer_content','answers.image as answer_image','answers.time as answer_time','answers.accepted','students.sfull_name as student_name', 'students.image as student_image','students.points as student_points')
                ->get();
        $instids=[];
        $stids=[];
        $instlikes=[];
        $stlikes=[];
        $instreplies=[];
        $streplies=[];


        foreach($instructoranswerdata as $data)
        {
            $instids[]=$data->answer_id;

        }
        foreach($studentanswerdata as $data)
        {
            $stids[]=$data->answer_id;

        }

        foreach($instids as $ans_id)
        {// get users ids who like an answer
            $instlikes[]=DB::table('answers')
                ->join('likes','answers.id','=','likes.answer_id')
                ->where('likes.answer_id', '=', $ans_id)
                ->select('likes.id as user_id','likes.type as user_type','likes.answer_id','likes.like')
                ->get();
        }
        foreach($stids as $ans_id)
        {// get users ids who like an answer
            $stlikes[]=DB::table('answers')
                ->join('likes','answers.id','=','likes.answer_id')
                ->where('likes.answer_id', '=', $ans_id)
                ->select('likes.id as user_id','likes.type as user_type','likes.answer_id','likes.like')
                ->get();
        };

        $likes = array_merge($instlikes,$stlikes);
//        foreach($stlikes as $mystlike) {
//            $instlikes->add($mystlike);
//        }


        $comments=DB::table('comments')
            ->where('comments.question_id','=',$question_id)
            ->select('comments.id as comment_id','comments.content','comments.time','comments.student_id','comments.instructor_id')
            ->get();

        foreach($instids as $ans_id)
        {
            $instreplies[]=DB::table('replies')
                ->join('instructors','instructors.id','=','replies.instructor_id')
                ->where('replies.answer_id', '=', $ans_id)
                ->select('replies.id as reply_id','replies.content','replies.time','replies.student_id','replies.instructor_id')
                ->get();
        }
        foreach($stids as $ans_id)
        {
            $streplies[]=DB::table('replies')
                ->join('students','students.id','=','replies.student_id')
                ->where('replies.answer_id', '=', $ans_id)
                ->select('replies.id as reply_id','replies.content','replies.time','replies.student_id','replies.instructor_id')
                ->get();
        }

        $replies=array_merge($instreplies,$streplies);
        $answers=array_merge($instructoranswerdata,$studentanswerdata);
        $response =array(
            'question'=>$questiondata,
            'answers'=>$answers,
//            'answers'=>array(
//                'instructor'=>$instructoranswerdata,
//                'student'=>$studentanswerdata
//            ),
//            'likes'=>array(
//                    'instructor'=>$instlikes,
//                    'student'=>$stlikes
//            ),
            'likes'=>$likes,
            'comments'=>$comments,
            'replies'=>$replies
//            'replies'=>array(
//                'instructor'=>$instreplies,
//                'student'=>$streplies
//            )
        );
        return $response;
    }

    public function complete(Request $request){
        $text=$request->input('sentance');

        $question_titles= Question::select('title')->where('title','like',$text."%")->get();

        return $question_titles;
    }

}
