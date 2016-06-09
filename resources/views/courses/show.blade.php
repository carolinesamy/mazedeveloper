@extends('master')

@section('content')
    <h1>
        name :
        {{ $course->course_name }}
    </h1>
    <h3>description:</h3>
    <p>
        {{ $course->description }}
    </p>
    <h3>Maximim Points:</h3>
    <p>
        {{ $course->max_points }}
    </p>
    <h3>category:</h3>
    <p>
        {{ $category->category_name }}
    </p>

    <h3>Course Instructors:</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>instructor_name</th>
            <th>teaching starting date</th>
        </tr>
        </thead>
        <tbody>

        @foreach($instructors as $key=>$value)
            <tr>
                <td>
                    {{$value->ifull_name}}
                </td>
                <td>
                    {{$value->teach_years}}
                </td>

            </tr>
        @endforeach

        </tbody>
    </table>
@stop