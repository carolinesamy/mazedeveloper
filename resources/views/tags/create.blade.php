@extends('master')

@section('content')

    <div class="container">

        {!! Form::open(['route'=>['admin.tag.store'],'method'=>'post']) !!}

        <fieldset class="form-group">
            <label>Name</label>
            <input class="form-control" placeholder="name" name="name">
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        {!! Form::close() !!}

    </div>
@stop