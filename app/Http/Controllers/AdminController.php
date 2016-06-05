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

use App\Answer;
use App\Question;
use DateTime;
use DB;

use App\Instructor;
use App\Student;

class AdminController extends Controller
{
    public function login(){
        return view('adminLogin');
    }

    public function index()
    {
        $title="students";
        $students=Student::all();
        return view('students.index',compact('students','title'));

    }

    public function create()
    {
        return view('students.create');
    }

    public function show($id)
    {
        $student=Student::findOrFail($id);
        return view('students.show',compact('student'));
    }

    public function edit($id)
    {
        $student=Student::find($id);

        return view('students.edit',compact('student'));
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
        $student->title=Request::get('title');
        $student->body=Request::get('body');
        $student->save();
        return redirect('/students');
    }

    public function destroy($id)
    {
        $student=Student::find($id);
        $student->delete();
        return redirect('/students');
    }

}