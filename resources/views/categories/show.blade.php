@extends('master')

@section('content')
    <h1>
        category name :
        {{ $category->category_name }}
    </h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>courses_list</th>
            </tr>
        </thead>
        <tbody>

        @foreach($courses as $key=>$value)
            <tr>
                <td>
                    {{$value->course_name}}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@stop