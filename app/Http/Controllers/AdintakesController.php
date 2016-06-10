<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Intake;
use Session;

class AdintakesController extends Controller
{
    //
    //
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

            $v = Validator::make($request->all(), [
                'intake_number' => 'required|unique|max:255',
            ]);

            if ($v->fails())
            {
                return redirect()->back()->withErrors('msg','error');
            }
            else{
                $intake=new Intake();
                $intake->intake_number=$request->input('number');
                $intake->save();

                return redirect('/admin/tables');
            }
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
            return redirect('/admin/tables');
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
        return redirect('/admin/tables');
        }
        else{
            return redirect('/admin');
        }
    }
}
