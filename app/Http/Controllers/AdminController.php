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
        $courses=DB::table('courses')
            ->join('categories','courses.category_id','=','categories.id')
            ->get();

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
        return view('students.create');
    }

    public function show($id)
    {
        $title='student information';
        $student=Student::findOrFail($id);
        $intake_id=$student->intake_id;
        $track_id=$student->track_id;
        $intake=Intake::findOrFail($intake_id);
        $track=Track::findOrFail($track_id);

        return view('students.show',compact('student','title','intake','track'));
    }

    public function edit($id)
    {
        $student=Student::find($id);
        $intakes=Intake::all();
        $tracks=Track::all();

        return view('students.edit',compact('student','intakes','tracks'));
    }

    public function store()
    {
        $student=new Student();
        $student->title=Request::get('title');
        $student->body=Request::get('body');
        $student->save();
        return redirect('/students');
    }

    public function update($id)
    {
        $student=Student::find($id);
        $student->sfull_name=Request::get('name');
        $student->email=Request::get('email');
        $student->save();
        return redirect('/tables');
    }

    public function destroy($id)
    {
        $student=Student::find($id);
        $student->delete();
        return redirect('admin/tables');
    }

}