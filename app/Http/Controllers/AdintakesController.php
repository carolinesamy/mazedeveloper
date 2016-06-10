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
        $title='Create New Intake ';
//        var_dump($instructors);
        return view('intakes.create',compact('title'));
    }

    public function show($id)
    {
        $title='Intake information';
        $intake=Intake::findOrFail($id);
//        var_dump($instructors);
        return view('intakes.show',compact('intake','title'));
    }

    public function edit($id)
    {
        $title=" Edit Intake data ";
        $intake=Intake::find($id);

        return view('intakes.edit',compact('intake','title'));
    }

    public function store(Request $request)
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

    public function update($id,Request $request)
    {
        $intake=Intake::find($id);
        $intake->intake_number=$request->input('number');
        $intake->save();
        return redirect('/admin/tables');
    }

    public function destroy($id)
    {
        $intake=Intake::find($id);
        $intake->delete();
        return redirect('/admin/tables');
    }
}
