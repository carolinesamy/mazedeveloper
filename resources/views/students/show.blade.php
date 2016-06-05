@extends('master')

@section('content')
    <h1>
        {{ $student->sfull_name }}
    </h1>
    <p>
        {{ $student->email }}
    </p>
    <p>
        {{ $student->points }}
    </p>
@stop