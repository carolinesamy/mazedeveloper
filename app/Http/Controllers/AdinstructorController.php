<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instructor;
use App\Http\Requests;
use DB;

class AdinstructorController extends Controller
{
    //
    public function create()
    {
        $title='Create New Instructor ';
        return view('instructors.create',compact('title'));
    }

    public function show($id)
    {
        $title='Instructor information';
        $instructor=Instructor::findOrFail($id);

        $courses=DB::table('instructor_courses')
            ->where('instructor_courses.instructor_id','=',$id)
            ->select('instructor_courses.course_id','instructor_courses.teach_years')->get();
        $courses_names=[];

        foreach ($courses as $course){
            $courses_names[]=DB::table('courses')
                ->where('courses.id','=',$course->course_id)
                ->value('course_name');
        }
//        var_dump($courses_names);
        return view('instructors.show',compact('instructor','title','courses','courses_names'));
    }

    public function edit($id)
    {
        $title=" Edit Instructor data ";
        $instructor=Instructor::find($id);
//        $intakes = Intake::lists('intake_number', 'id');
//        $tracks = Track::lists('track_name', 'id');
        $courses=DB::table('instructor_courses')
            ->where('instructor_courses.instructor_id','=',$id)
            ->select('instructor_courses.course_id','instructor_courses.teach_years')->get();
        $courses_names=[];

        foreach ($courses as $course){
            $courses_names[]=DB::table('courses')
                ->where('courses.id','=',$course->course_id)
                ->value('course_name');
        }
        return view('instructors.edit',compact('instructor','title','courses','courses_names'));
    }

    public function store(Request $request)
    {
        $instructor=new Instructor();
        $instructor->ifull_name=$request->input('name');
        $instructor->email=$request->input('email');
        $instructor->password=$request->input('password');
        $instructor->image=$request->input('image');
        $instructor->type=$request->input('type');
        $instructor->save();
        return redirect('/admin/tables');
    }

    public function update($id,Request $request)
    {
        $instructor=Instructor::find($id);
        $instructor->ifull_name=$request->input('name');
        $instructor->email=$request->input('email');
        $instructor->password=$request->input('password');
        $instructor->image=$request->input('image');
        $instructor->type=$request->input('type');
        $instructor->save();
        return redirect('/admin/tables');
    }

    public function destroy($id)
    {
        $instructor=Instructor::find($id);
        $instructor->delete();
        return redirect('/admin/tables');
    }
}
