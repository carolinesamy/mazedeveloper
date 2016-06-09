<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;

class AdtagsController extends Controller
{
    //
    //
    public function create()
    {
        $title='Create New Tag ';
//        var_dump($instructors);
        return view('tags.create',compact('title'));
    }

    public function show($id)
    {
        $title='Tag information';
        $tag=Tag::findOrFail($id);
//        var_dump($instructors);
        return view('tags.show',compact('tag','title'));
    }

    public function edit($id)
    {
        $title=" Edit Tag data ";
        $tag=Tag::find($id);
//        $intakes = Intake::lists('intake_number', 'id');
//        $tracks = Track::lists('track_name', 'id');

//        var_dump($instructors);
        return view('tags.edit',compact('tag','title'));
    }

    public function store(Request $request)
    {
        $tag=new Tag();
        $tag->tag_name=$request->input('name');
        $tag->save();

        return redirect('/admin/tables');
    }

    public function update($id,Request $request)
    {
        $tag=Tag::find($id);
        $tag->tag_name=$request->input('name');
        $tag->save();
        return redirect('/admin/tables');
    }

    public function destroy($id)
    {
        $tag=Tag::find($id);
        $tag->delete();
        return redirect('/admin/tables');
    }
}
