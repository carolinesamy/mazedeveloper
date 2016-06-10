<?php
/**
 * Created by PhpStorm.
 * User: kristine
 * Date: 6/4/16
 * Time: 8:39 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;

use App\Answer;
use App\Question;
use App\Course;
use App\Intake;
use App\Track;
use DateTime;
use DB;

use App\Instructor;
use App\Student;

class AdminController extends Controller
{
    public function login(Request $request){

        $email=$request->input('email');
        $password=$request->input('password');

        $admin= DB::table('admin')
            ->where('email',$email)->first();

            if ($admin->password == $password)
            {
                // echo "YOU ARE LOGIN";
                $rett=array
                (
                        'id'=>$admin->id,
                        'email'=>$admin->email,
                        'afull_name'=>$admin->afull_name

                );
//                session(['user_id'=>$student->id]);
//                session(['type'=>'student']);

                return view('adminDashboard',compact('rett'));

            }
            elseif($admin->password != $password)
            {
                return view('adminLogin');
            }



    }

    public function relogin(){
        return view('adminLogin');
//        Route::post('/login','AuthController@login');
    }

    public function index()
    {
        /*** Students Data ***/
        $students=Student::all();

        /*** instructors Data ***/
        $instructors=Instructor::all();

        /*** categories Data ***/
        $categories=DB::table('categories')->get();
        /*** courses data ***/
        $courses=DB::table('courses')->get();
//            ->join('categories','courses.category_id','=','categories.id')
//            ->get();

        /*** intakes ***/
        $intakes=DB::table('intakes')->get();

        /*** tracks ***/
        $tracks=DB::table('tracks')->get();

        /*** tags ***/
        $tags=DB::table('tags')->get();

        return view('admin/tables',compact('students','instructors','courses','categories','intakes','tracks','tags'));
    }

    public function create()
    {
        $title='Create New Student ';
        $intakes = Intake::lists('intake_number', 'id');
        $tracks = Track::lists('track_name', 'id');
        return view('students.create',compact('title','intakes','tracks'));
    }

    public function show($id)
    {
        $title='student information';
        $student=Student::findOrFail($id);
        $intake_id=$student->intake_id;
        $track_id=$student->track_id;
        $intake=Intake::findOrFail($intake_id);
        $track=Track::findOrFail($track_id);

        $courses=DB::table('student_courses')
            ->where('student_courses.student_id','=',$id)
            ->select('student_courses.course_id','student_courses.privilege')->get();
        $courses_names=[];

        foreach ($courses as $course){
            $courses_names[]=DB::table('courses')
                ->where('courses.id','=',$course->course_id)
                ->value('course_name');
        }

        return view('students.show',compact('student','title','intake','track','courses','courses_names'));
    }

    public function edit($id)
    {
        $title=" Edit student data ";
        $student=Student::find($id);
//        $intakes=Intake::all();
        $intakes = Intake::lists('intake_number', 'id');
//        $tracks=Track::all();
        $tracks = Track::lists('track_name', 'id');


        return view('students.edit',compact('student','intakes','tracks','title'));
    }

    public function store(Request $request)
    {
        $student=new Student();
        $student->sfull_name=$request->input('name');
        $student->email=$request->input('email');
        $student->password=$request->input('password');
        $student->image=$request->input('image');
        $student->intake_id=$request->input('intake');
        $student->track_id=$request->input('track');
        $student->save();
        return redirect('/admin/tables');
    }

    public function update($id,Request $request)
    {
        $student=Student::find($id);
        $student->sfull_name=$request->input('name');
        $student->email=$request->input('email');
        $student->password=$request->input('password');
        $student->image=$request->input('image');
        $student->intake_id=$request->input('intake');
        $student->track_id=$request->input('track');

        $student->save();
        return redirect('/admin/tables');
    }

    public function destroy($id)
    {
        $student=Student::find($id);
        $student->delete();
        return redirect('admin/tables');
    }

}