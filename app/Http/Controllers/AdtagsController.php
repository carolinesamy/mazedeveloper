<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use Session;
use DB;


class AdtagsController extends Controller
{
    //

    public function index()
    {

        if (Session::has('admin_id'))
        {

            /*** tags ***/
            $tags=DB::table('tags')->get();

            return view('tags/index',compact('tags'));
        }
        else{
            return redirect('/admin');
        }
    }
    public function create()
    {
        if (Session::has('admin_id')) {

            $title='Create New Tag ';
//        var_dump($instructors);
        return view('tags.create',compact('title'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function show($id)
    {
        if (Session::has('admin_id')) {

            $title='Tag information';
        $tag=Tag::findOrFail($id);
//        var_dump($instructors);
        return view('tags.show',compact('tag','title'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function edit($id)
    {
        if (Session::has('admin_id')) {

            $title=" Edit Tag data ";
        $tag=Tag::find($id);
//        $intakes = Intake::lists('intake_number', 'id');
//        $tracks = Track::lists('track_name', 'id');

//        var_dump($instructors);
        return view('tags.edit',compact('tag','title'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function store(Request $request)
    {

        if (Session::has('admin_id')) {

            $tag=new Tag();
            $tag->tag_name=$request->input('name');
            $tag->save();

            return redirect('/admin/tag');
        }
        else{
            return redirect('/admin');
        }
        //

    }

    public function update($id,Request $request)
    {
        if (Session::has('admin_id')) {

            $tag=Tag::find($id);
        $tag->tag_name=$request->input('name');
        $tag->save();
        return redirect('/admin/tag');
        }
        else{
            return redirect('/admin');
        }
    }

    public function destroy($id)
    {
        if (Session::has('admin_id')) {

            $tag=Tag::find($id);
        $tag->delete();
        return redirect('/admin/tag');
        }
        else{
            return redirect('/admin');
        }
    }
}
