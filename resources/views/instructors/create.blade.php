@extends('master')

@section('content')

    <div class="container">
        {!! Form::open(['route'=>['admin.instructor.store'],'method'=>'post']) !!}

        <fieldset class="form-group">
            <label>Name</label>
            <input class="form-control" placeholder="name" name="name">
        </fieldset>

        <fieldset class="form-group">
            <label>Email</label>
            <input class="form-control" placeholder="email" type="email" id="email" name="email">
        </fieldset>

        <fieldset class="form-group">
            <label>Password</label>
            <input class="form-control" placeholder="password" type="password" id="password" name="password">
        </fieldset>
        <fieldset class="form-group">
            <label>Image</label>
            <input class="form-control" placeholder="image" type="text" id="image" name="image">
        </fieldset>
        <fieldset class="form-group">
            <label>Type</label>
            <input class="form-control" placeholder="type" type="text" id="type" name="type">
        </fieldset>

        {{--<fieldset class="form-group">--}}
        {{--<label>Intake</label>--}}
        {{--{{ Form::select('intake', $intakes,$student->intake_id,array('class'=>'form-control')) }}--}}
        {{--</fieldset>--}}

        {{--<fieldset class="form-group">--}}
        {{--<label>track</label>--}}
        {{--{{ Form::select('track', $tracks,$student->track_id,array('class'=>'form-control')) }}--}}
        {{--</fieldset>--}}

        <button type="submit" class="btn btn-primary">Submit</button>

        {!! Form::close() !!}

    </div>
@stop