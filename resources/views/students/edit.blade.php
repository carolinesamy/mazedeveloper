@extends('master')

@section('content')

    <div class="container">
        {!! Form::open(['route'=>['students.update',$student->id],'method'=>'put']) !!}

        <fieldset class="form-group">
            <label for="exampleInputEmail1">email</label>
            <input class="form-control" placeholder="Email" name="email" value="{{ $student->email }}">
            <small class="text-muted">We'll never share your email with anyone else.</small>
        </fieldset>

        <fieldset class="form-group">
            <label for="exampleTextarea">Password</label>
            <input class="form-control" id="password" name="password">{{ $student->password }}
        </fieldset>

        <button type="submit" class="btn btn-primary">Login</button>

        {!! Form::close() !!}

    </div>
@stop