<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use App\Http\Controllers\Controller;
use DB;
class TagController extends Controller
{
    //
    public function get_tag(Request $request)
    {
        $user_id=$request->input('id');
        $user_type=$request->input('type');

        if (session('user_id') == $user_id && session('type') == $user_type && $user_id!=null)
        {
            $tags = DB::table('tags')->get();

            $courses=DB::table('courses')
                ->join('student_courses','courses.id','=','student_courses.course_id')
                ->where('student_courses.student_id','=',$user_id)
                ->select('courses.id','courses.course_name')
                ->get();
            $i=0;
            $arr=[];
            foreach($courses as $course)
            {


                $arr[$i]['id']=$course->id;
                $arr[$i]['course_name']=$course->course_name;
                $i++;
            }
            $user_courses=json_encode($arr);

            $ask_data=array
            (
                'tags_id'=>$tags,
                'course_data'=>$user_courses,


            );

            return  $ask_data;
        }


    }
}
