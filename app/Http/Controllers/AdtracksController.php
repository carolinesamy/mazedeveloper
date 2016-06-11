<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use App\Http\Requests;
use Session;
use DB;


class AdtracksController extends Controller
{
    //
    public function index()
    {

        if (Session::has('admin_id'))
        {

            /*** tracks ***/
            $tracks=DB::table('tracks')->get();


            return view('tracks/index',compact('tracks'));
        }
        else{
            return redirect('/admin');
        }
    }
    public function create()
    {
        if (Session::has('admin_id')) {

            $title='Create New Track ';

        return view('tracks.create',compact('title'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function show($id)
    {
        if (Session::has('admin_id')) {

            $title='Track information';
        $track=Track::findOrFail($id);

        return view('tracks.show',compact('track','title'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function edit($id)
    {
        if (Session::has('admin_id')) {

            $title=" Edit Track data ";
        $track=Track::find($id);
        return view('tracks.edit',compact('track','title'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function store(Request $request)
    {
        if (Session::has('admin_id')) {

            $track=new Track();
        $track->track_name=$request->input('name');
        $track->save();

        return redirect('/admin/track');
        }
        else{
            return redirect('/admin');
        }
    }

    public function update($id,Request $request)
    {
        if (Session::has('admin_id')) {

            $track=Track::find($id);
        $track->track_name=$request->input('name');
        $track->save();

        return redirect('/admin/track');
        }
        else{
            return redirect('/admin');
        }
    }

    public function destroy($id)
    {
        if (Session::has('admin_id')) {

            $track=Track::find($id);
        $track->delete();
        return redirect('/admin/track');
        }
        else{
            return redirect('/admin');
        }
    }
}
