
use App\Http\Controllers\AdminController;

@extends('master')

@section('content')

    <div class="container">
        {!! Form::open(['route'=>['admin.track.update',$track->id],'method'=>'put']) !!}

        <fieldset class="form-group">
            <label>Name</label>
            <input class="form-control" placeholder="name" name="name" value="{{ $track->track_name }}">
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>

        {!! Form::close() !!}

    </div>
@stop