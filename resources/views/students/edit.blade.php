
use App\Http\Controllers\AdminController;

@extends('master')

@section('content')

    <div class="container">
{{--        {!! Form::open(['action'=>'AdminController@update','method'=>'get']) !!}--}}
<form action="" method="post">
        <fieldset class="form-group">
            <label>name</label>
            <input class="form-control" placeholder="name" name="name" value="{{ $student->sfull_name }}">
        </fieldset>

        <fieldset class="form-group">
            <label for="exampleInputEmail1">email</label>
            <input class="form-control" placeholder="Email" name="email" value="{{ $student->email }}">
            <small class="text-muted">We'll never share your email with anyone else.</small>
        </fieldset>

        <fieldset class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="password">{{ $student->password }}
        </fieldset>

        <fieldset class="form-group">
            <label for="exampleInputEmail1">image</label>
            <input class="form-control" placeholder="image" name="image" value="{{ $student->image }}">
        </fieldset>

        {!! Form::select('intake',
        (['0' => 'Select an intake'] + $intakes),
            null,
            ['class' => 'form-control']) !!}

        <button type="submit" class="btn btn-primary">Login</button>

        {!! Form::close() !!}

    </div>
@stop