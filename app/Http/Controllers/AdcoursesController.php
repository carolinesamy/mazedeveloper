<?php

namespace App\Http\Controllers;

use App\Category;
use App\Instructor_courses;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;

use DB;
use App\Instructor;

class AdcoursesController extends Controller
{
    //
    public function create()
    {
        $title='Create New Course ';
        $categories=Category::lists('category_name','id');
        $instructors=Instructor::lists('ifull_name','id');
//        $instructors=Instructor::all();
//        var_dump($instructors);
        return view('courses.create',compact('title','categories','instructors'));
    }

    public function show($id)
    {
        $title='Course information';
        $course=Course::findOrFail($id);

        $category=Category::findOrFail($course->category_id);

        $instructors=DB::table('instructor_courses')
            ->join('instructors','instructor_courses.instructor_id','=','instructors.id')
            ->where('instructor_courses.course_id','=',$id)
            ->select('instructors.ifull_name','instructor_courses.teach_years')->get();
//        var_dump($instructors);
        return view('courses.show',compact('course','title','category','instructors'));
    }

    public function edit($id)
    {
        $title=" Edit Course data ";
        $course=Course::find($id);
        $categories=Category::lists('category_name','id');
        $all_instructors=Instructor::lists('ifull_name','id');
        $instructors=DB::table('instructor_courses')
            ->join('instructors','instructor_courses.instructor_id','=','instructors.id')
            ->where('instructor_courses.course_id','=',$id)
            ->lists('instructors.ifull_name','instructor_courses.instructor_id');
//        $intakes = Intake::lists('intake_number', 'id');
//        $tracks = Track::lists('track_name', 'id');

//        var_dump($instructors);
        return view('courses.edit',compact('course','title','categories','instructors','all_instructors'));
    }

    public function store(Request $request)
    {

        $course=new Course();
        $course->course_name=$request->input('name');
        $course->description=$request->input('description');
        $course->max_points=$request->input('max_points');
        $course->category_id=$request->input('category');
        $course->save();
        $instructors=$request->input('instructors');
//        dd($course->id);
        foreach($instructors as $instructor)
        {
            $instructor_course=new Instructor_courses();
            $instructor_course->instructor_id=$instructor;
            $instructor_course->course_id=$course->id;
            $instructor_course->save();
        }

        return redirect('/admin/tables');
    }

    public function update($id,Request $request)
    {
        $course=Course::find($id);
        $course->course_name=$request->input('name');
        $course->description=$request->input('description');
        $course->max_points=$request->input('max_points');
        $course->category_id=$request->input('category');
        $course->save();
        $instructors=$request->input('instructors');

        $course_exist=DB::table('instructor_courses')
            ->where('course_id','=',$id)
            ->first();
        if($course_exist==null)
        {
            foreach($instructors as $instructor)
            {
                $instructor_course=new Instructor_courses();
                $instructor_course->instructor_id=$instructor;
                $instructor_course->course_id=$id;
                $instructor_course->save();
            }
        }
        else
        {
            foreach($instructors as $instructor) {
                $instructor_exist = DB::table('instructor_courses')
                    ->where('instructor_id', '=',$instructor)
                    ->first();

                if($instructor_exist==null){
                    $instructor_course=new Instructor_courses();
                    $instructor_course->instructor_id=$instructor;
                    $instructor_course->course_id=$id;
                    $instructor_course->save();
                }

            }
        }

        return redirect('/admin/tables');
    }

    public function destroy($id)
    {
        $course=Course::find($id);
        $course->delete();
        return redirect('/admin/tables');
    }
}
