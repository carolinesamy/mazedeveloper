<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

use DB;

class AdcategoriesController extends Controller
{
    //
    public function create()
    {
        $title='Create New Category ';
        $courses = Course::lists('course_name', 'id');
        return view('categories.create',compact('title','courses'));
    }

    public function show($id)
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

    public function edit($id)
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

    public function store(Request $request)
    {
        $category=new Category();
        $category->category_name=$request->input('name');
        $category->save();
        return redirect('/admin/tables');
    }

    public function update($id,Request $request)
    {
        $category=Category::find($id);
        $category->category_name=$request->input('name');
        $category->save();
        return redirect('/admin/tables');
    }

    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return redirect('/admin/tables');
    }
}
