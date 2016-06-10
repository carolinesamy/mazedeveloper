
use App\Http\Controllers\AdminController;

@extends('master')

@section('content')

    <div>
        {!! Form::open(['route'=>['admin.student.update',$student->id],'method'=>'put']) !!}

        <fieldset class="form-group">
            <label>Name</label>
            <input class="form-control" placeholder="name" name="name" value="{{ $student->sfull_name }}">
        </fieldset>

        <fieldset class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" id="email" name="email" value="{{ $student->email }}">
        </fieldset>

        <fieldset class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" id="password" name="password" value="{{ $student->password }}">
        </fieldset>
        <fieldset class="form-group">
            <label>Image</label>
            <input class="form-control" type="text" id="image" name="image" value="{{ $student->image }}">
        </fieldset>

        <fieldset class="form-group">
            <label>Intake</label>
            {{ Form::select('intake', $intakes,$student->intake_id,array('class'=>'form-control')) }}
        </fieldset>

        <fieldset class="form-group">
            <label>track</label>
            {{ Form::select('track', $tracks,$student->track_id,array('class'=>'form-control')) }}
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>

        {!! Form::close() !!}

    </div>
@stop