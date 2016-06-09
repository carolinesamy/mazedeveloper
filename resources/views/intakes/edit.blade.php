
use App\Http\Controllers\AdminController;

@extends('master')

@section('content')

    <div class="container">
        {!! Form::open(['route'=>['admin.intake.update',$intake->id],'method'=>'put']) !!}

        <fieldset class="form-group">
            <label>Number</label>
            <input class="form-control" name="number" value="{{$intake->intake_number}}">
        </fieldset>

        <button class="btn btn-primary" type="submit">Submit</button>

        {!! Form::close() !!}

    </div>
@stop