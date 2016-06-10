<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use App\Http\Requests;

class AdtracksController extends Controller
{
    //
    public function create()
    {
        $title='Create New Track ';

        return view('tracks.create',compact('title'));
    }

    public function show($id)
    {
        $title='Track information';
        $track=Track::findOrFail($id);

        return view('tracks.show',compact('track','title'));
    }

    public function edit($id)
    {
        $title=" Edit Track data ";
        $track=Track::find($id);
        return view('tracks.edit',compact('track','title'));
    }

    public function store(Request $request)
    {
        $track=new Track();
        $track->track_name=$request->input('name');
        $track->save();

        return redirect('/admin/tables');
    }

    public function update($id,Request $request)
    {
        $track=Track::find($id);
        $track->track_name=$request->input('name');
        $track->save();

        return redirect('/admin/tables');
    }

    public function destroy($id)
    {
        $track=Track::find($id);
        $track->delete();
        return redirect('/admin/tables');
    }
}
