@extends('master')

@section('content')

    <div class="container">
        {!! Form::open(['route'=>'articles.store','method'=>'post']) !!}

        <fieldset class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input class="form-control" placeholder="Title" name="title">
            <small class="text-muted">We'll never share your email with anyone else.</small>
        </fieldset>

        <fieldset class="form-group">
            <label for="exampleTextarea">Body</label>
            <textarea class="form-control" id="exampleTextarea" rows="3" name="body"></textarea>
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>

        {!! Form::close() !!}

    </div>
@stop