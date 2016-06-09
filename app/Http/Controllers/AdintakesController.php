<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Intake;

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
        $intake=new Intake();
        $intake->intake_number=$request->input('number');
        $intake->save();

        return redirect('/admin/tables');
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
