
use App\Http\Controllers\AdminController;

@extends('master')

@section('content')

    <div class="container">
        {!! Form::open(['route'=>['admin.course.update',$course->id],'method'=>'put']) !!}

        <fieldset class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" value="{{$course->course_name}}">
        </fieldset>

        <fieldset class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="description" name="description">{{$course->description}}</textarea>
        </fieldset>

        <fieldset class="form-group">
            <label>Maximum Points</label>
            <input class="form-control" type="number" id="max_points" name="max_points" value="{{$course->max_points}}">
        </fieldset>

        <fieldset class="form-group">
            <label>Category</label>
            {{ Form::select('category',$categories,$course->category_id,array('class'=>'form-control')) }}
        </fieldset>
        <fieldset class="form-group">
            <label>Course Instructor</label>
            <br/>

{{--            @foreach($instructors as $key=>$value)--}}
{{--                {{ Form::select('instructor',$all_instructors,null,array('multiple'=>'multiple','class'=>'form-control')) }}--}}
                {{--<br/>--}}
            {{--@endforeach--}}

            @foreach($all_instructors as $key=> $value)

                {{--*/ $flag = 0 /*--}}
                {{--*/ $count = 0 /*--}}
                @foreach($instructors as $newkey=> $newvalue)
                    {{--*/ $count ++ /*--}}
                    @if($value==$newvalue)
{{--                     {{--*/ $flag = 1 /*--}}
                    @else
{{--                      {{--*/ $flag = 0 /*--}}
                    @endif

                @endforeach
                @if($flag==1)

                    {!! Form::checkbox('instructors[]', $key,null,['class' => 'field','checked'=>'checked','id'=>'ins'.$value])!!}{!! $value !!}
                    <br/>
                @else

                    {!!  Form::checkbox('instructors[]', $key,null,['class' => 'field','id'=>'ins'.$value])  !!}{!! $value !!}
                    <br/>
                @endif
            @endforeach
        </fieldset>

        {{--<fieldset class="form-group">--}}
        {{--<label>track</label>--}}
        {{--{{ Form::select('track', $tracks,$student->track_id,array('class'=>'form-control')) }}--}}
        {{--</fieldset>--}}

        <button class="btn btn-primary" type="submit">Submit</button>

        {!! Form::close() !!}

    </div>
@stop