<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instructor;
use App\Http\Requests;
use DB;
use Session;

class AdinstructorController extends Controller
{
  public function create()
    {
        if (Session::has('admin_id'))
        {
        $title='Create New Instructor ';
        return view('instructors.create',compact('title'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function show($id)
    {
        if (Session::has('admin_id'))
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
        else{
            return redirect('/admin');
        }
    }

    public function edit($id)
    {
        if (Session::has('admin_id'))
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
        else{
            return redirect('/admin');
        }
    }

    public function store(Request $request)
    {
        if (Session::has('admin_id'))
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
        else{
            return redirect('/admin');
        }
    }

    public function update($id,Request $request)
    {
        if (Session::has('admin_id'))
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
        else{
            return redirect('/admin');
        }
    }

    public function destroy($id)
    {
        if (Session::has('admin_id'))
        {
        $instructor=Instructor::find($id);
        $instructor->delete();
        return redirect('/admin/tables');
        }
        else{
            return redirect('/admin');
        }
    }
}
