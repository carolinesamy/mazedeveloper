@extends('master')

@section('content')

    <div>
        {!! Form::open(['route'=>['admin.student.store'],'method'=>'post']) !!}

        <fieldset class="form-group">
            <label>Name</label>
            <input class="form-control" placeholder="name" name="name">
        </fieldset>

        <fieldset class="form-group">
            <label>Email</label>
            <div class="form-group input-group">
                <span class="input-group-addon">@</span>
            <input class="form-control" placeholder="email" type="email" id="email" name="email">
            </div>
        </fieldset>

        <fieldset class="form-group">
            <label>Password</label>
            <input class="form-control" placeholder="password" type="password" id="password" name="password">
        </fieldset>
        <fieldset class="form-group">
            <label>Image</label>
            <input class="form-control" placeholder="image path" type="text" id="image" name="image">
        </fieldset>

        <fieldset class="form-group">
            <label>Intake</label>
            {{ Form::select('intake', $intakes,null,array('class'=>'form-control')) }}
        </fieldset>

        <fieldset class="form-group">
            <label>track</label>
            {{ Form::select('track', $tracks,null,array('class'=>'form-control')) }}
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>

        {!! Form::close() !!}

    </div>
@stop