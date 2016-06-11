<?php
/**
 * Created by PhpStorm.
 * User: kristine
 * Date: 6/4/16
 * Time: 8:39 PM
 */

namespace App\Http\Controllers;

use App\Student_courses;
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
use Session;
use App\Instructor;
use App\Student;

class AdminController extends Controller
{
    public function login(Request $request){

        if (!Session::has('admin_id'))
        {
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
                session(['admin_id'=>$admin->id]);
                session(['name'=>$admin->afull_name]);
//                Session::put('key', 'value');
                return view('adminDashboard',compact('rett'));

            }
            elseif($admin->password != $password)
            {

                return view('adminLogin');
            }

        }
        else{
            $rett=array
            (
                'afull_name'=>session('name')

            );
            return view('adminDashboard',compact('rett'));

        }

    }

    public function relogin(){

        if (!Session::has('admin_id'))
        {
            return view('adminLogin');

        }
        else{
//            redirect('/admin/tables');
            return redirect('/admin/login');
        }



//        Route::post('/login','AuthController@login');
    }

    public function index()
    {

        if (Session::has('admin_id'))
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
        else{
            return redirect('/admin');
        }
    }

    public function create()
    {
        if (Session::has('admin_id'))
        {
            //
            $title='Create New Student ';
            $intakes = Intake::lists('intake_number', 'id');
            $tracks = Track::lists('track_name', 'id');
            return view('students.create',compact('title','intakes','tracks'));
        }
        else{
            return redirect('/admin');
        }



    }

    public function show($id)
    {
        if (Session::has('admin_id'))
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
        else{
            return redirect('/admin');
        }
    }

    public function edit($id)
    {
        if (Session::has('admin_id'))
        {
            $title=" Edit student data ";
        $student=Student::find($id);
//        $intakes=Intake::all();
        $intakes = Intake::lists('intake_number', 'id');
//        $tracks=Track::all();
        $tracks = Track::lists('track_name', 'id');


        return view('students.edit',compact('student','intakes','tracks','title'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function store(Request $request)
    {

        if (Session::has('admin_id'))
        {
        $student=new Student();
        $student->sfull_name=$request->input('name');
        $student->email=$request->input('email');
        $student->password=$request->input('password');
        $student->image=$request->input('image');
        $student->intake_id=$request->input('intake');
        $student->track_id=$request->input('track');
        $student->save();
        $track_courses=DB::table('track_courses')
            ->where('track_id','=',$request->input('track'))
            ->select('course_id')->get(); // array of two objects

        foreach($track_courses as $course){
            $student_courses=new Student_courses();
            $student_courses->student_id=$student->id;
            $student_courses->course_id=$course->course_id;
            $student_courses->save();
        }

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
        $student=Student::find($id);
        $last_id = $student->track_id;
        $student->sfull_name=$request->input('name');
        $student->email=$request->input('email');
        $student->password=$request->input('password');
        $student->image=$request->input('image');
        $student->intake_id=$request->input('intake');
        $student->track_id=$request->input('track');

        $student->save();

        $track_courses = DB::table('track_courses')
            ->where('track_id', '=', $request->input('track'))
            ->select('course_id')->get(); // array of two objects

        if ($last_id != $request->input('track')) {

            $last_track_courses = DB::table('track_courses')
                ->where('track_id', '=', $last_id)
                ->select('course_id')->get();

            foreach ($last_track_courses as $course) {
                $last_student_courses = DB::table('student_courses')
                                ->where('course_id','=',$course->course_id)
                                ->where('student_id','=',$id)
                                ->delete();
            }

            foreach ($track_courses as $course) {
                $student_courses = new Student_courses();
                $student_courses->student_id = $student->id;
                $student_courses->course_id = $course->course_id;
                $student_courses->save();
            }
        }
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
            $student=Student::find($id);
            $student->delete();
            return redirect('admin/tables');
        }
        else{
            return redirect('/admin');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/admin');

    }



}