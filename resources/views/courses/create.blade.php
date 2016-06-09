@extends('master')

@section('content')

    <div class="container">
        {!! Form::open(['route'=>['admin.course.store'],'method'=>'post']) !!}

        <fieldset class="form-group">
            <label>Name</label>
            <input class="form-control" placeholder="name" name="name">
        </fieldset>

        <fieldset class="form-group">
            <label>Description</label>
            <textarea class="form-control" placeholder="Enter Description" id="description" name="description"></textarea>
        </fieldset>

        <fieldset class="form-group">
            <label>Maximum Points</label>
            <input class="form-control" placeholder="password" type="number" id="max_points" name="max_points">
        </fieldset>

        <fieldset class="form-group">
        <label>Category</label>
        {{ Form::select('category', $categories,null,array('class'=>'form-control')) }}
        </fieldset>
        <fieldset class="form-group">
            <label>Course Instructor</label>
            {{ Form::select('instructor', $instructors,null,array('class'=>'form-control')) }}
        </fieldset>

        {{--<fieldset class="form-group">--}}
        {{--<label>track</label>--}}
        {{--{{ Form::select('track', $tracks,$student->track_id,array('class'=>'form-control')) }}--}}
        {{--</fieldset>--}}

        <button type="submit" class="btn btn-primary">Submit</button>

        {!! Form::close() !!}

    </div>
@stop