@extends('master')

@section('content')

    <div class="container">
        {!! Form::open(['route'=>['admin.category.store'],'method'=>'post']) !!}

        <fieldset class="form-group">
            <label>Category Name</label>
            <input class="form-control" placeholder="name" name="name">
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