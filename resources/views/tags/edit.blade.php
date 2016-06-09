
use App\Http\Controllers\AdminController;

@extends('master')

@section('content')

    <div class="container">
        {!! Form::open(['route'=>['admin.tag.update',$tag->id],'method'=>'put']) !!}

        <fieldset class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" value="{{$tag->tag_name}}">
        </fieldset>

        <button class="btn btn-primary" type="submit">Submit</button>

        {!! Form::close() !!}

    </div>
@stop