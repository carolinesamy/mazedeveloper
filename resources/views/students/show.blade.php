@extends('master')

@section('content')
    <h1>
        name :
        {{ $student->sfull_name }}
    </h1>
    <h3>email:</h3>
    <p>
        {{ $student->email }}
    </p>
    <p>
        {{ $student->image }}
    </p>
    <h3>intake number:</h3>
    <p>
        {{ $intake->intake_number }}
    </p>
    <h3>track:</h3>
    <p>
        {{ $track->track_name }}
    </p>
    <h3>points:</h3>
    <p>
        {{ $student->points }}
    </p>
@stop