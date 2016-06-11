<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Intake;
use Session;
use DB;

class AdintakesController extends Controller
{
    //

    public function index()
    {

        if (Session::has('admin_id'))
        {


            /*** intakes ***/
            $intakes=DB::table('intakes')->get();


            return view('intakes/index',compact('intakes'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function create()
    {
        if (Session::has('admin_id'))
        {
        $title='Create New Intake ';
//        var_dump($instructors);
        return view('intakes.create',compact('title'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function show($id)
    {
        if (Session::has('admin_id'))
        {
        $title='Intake information';
        $intake=Intake::findOrFail($id);
//        var_dump($instructors);
        return view('intakes.show',compact('intake','title'));
        }
        else{
            return redirect('/admin');
        }

    }

    public function edit($id)
    {
        if (Session::has('admin_id'))
        {
        $title=" Edit Intake data ";
        $intake=Intake::find($id);

        return view('intakes.edit',compact('intake','title'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function store(Request $request)
    {
        if (Session::has('admin_id'))
        {

                $intake=new Intake();
                $intake->intake_number=$request->input('number');
                $intake->save();

                return redirect('/admin/intake');

        }
        else{
            return redirect('/admin');
        }

    }

    public function update($id,Request $request)
    {
        if (Session::has('admin_id')) {
            $intake = Intake::find($id);
            $intake->intake_number = $request->input('number');
            $intake->save();
            return redirect('/admin/intake');
        }
        else{
            return redirect('/admin');
        }
    }

    public function destroy($id)
    {
        if (Session::has('admin_id')) {

            $intake=Intake::find($id);
        $intake->delete();
        return redirect('/admin/intake');
        }
        else{
            return redirect('/admin');
        }
    }
}
