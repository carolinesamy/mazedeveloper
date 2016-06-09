@extends('master')

@section('content')
    <h1>
        name :
        {{ $instructor->ifull_name }}
    </h1>
    <h3>email:</h3>
    <p>
        {{ $instructor->email }}
    </p>
    <p>
        {{ $instructor->image }}
    </p>
    <h3>points:</h3>
    <p>
        {{ $instructor->points }}
    </p>
    <h3>type:</h3>
    <p>
        {{ $instructor->type }}
    </p>
    <h3>courses</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>course_name</th>
                <th>teaching starting date</th>
                </tr>
        </thead>
        <tbody>

        @foreach($courses as $key=>$value)
            <tr>
                <td>
                    {{$courses_names[$key]}}
                </td>
                <td>
                    {{$value->teach_years}}
                </td>

            </tr>
        @endforeach

        </tbody>
    </table>
@stop