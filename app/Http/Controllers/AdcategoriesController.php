<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Session;

use DB;

class AdcategoriesController extends Controller
{
    //
    public function create()
    {
        if (Session::has('admin_id'))
        {
        $title='Create New Category ';
        $courses = Course::lists('course_name', 'id');
        return view('categories.create',compact('title','courses'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function show($id)
    {
        if (Session::has('admin_id'))
        {
        $title='Category information';
        $category=Category::findOrFail($id);

//        $courses = Course::lists('course_name', 'id');
        $courses=DB::table('courses')
            ->where('courses.category_id','=',$id)
            ->select('courses.course_name','courses.id')->get();
//        var_dump($courses);

        return view('categories.show',compact('category','title','courses'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function edit($id)
    {
        if (Session::has('admin_id'))
        {
        $title=" Edit Category data ";
        $category=Category::find($id);
//        $intakes = Intake::lists('intake_number', 'id');
//        $tracks = Track::lists('track_name', 'id');
        $courses=DB::table('courses')
            ->where('courses.category_id','=',$id)
            ->select('courses.course_name','courses.id')->get();
        $all_courses=Course::all();

        return view('categories.edit',compact('category','title','courses','all_courses'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function store(Request $request)
    {
        if (Session::has('admin_id'))
        {
        $category=new Category();
        $category->category_name=$request->input('name');
        $category->save();
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
        $category=Category::find($id);
        $category->category_name=$request->input('name');
        $category->save();
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
        $category=Category::find($id);
        $category->delete();
        return redirect('/admin/tables');
        }
        else{
            return redirect('/admin');
        }
    }
}
