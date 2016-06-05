@extends('master')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    Full Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    Points
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{$student->sfull_name }}</td>
                    <td>{{$student->email }}</td>
                    <td>{{$student->points }}</td>
                    <td>
                        <a class="btn btn-primary" href="/students/{{$student->id}}">Show</a>
                        <a class="btn btn-warning" href="/students/{{$student->id}}/edit">Edit</a>
                        <a class="btn btn-danger" href="/students/destroy/{{$student->id}}">Delete</a>

                    </td>
                </tr>
            @endforeach
            <tr>
                <td>

                </td>
            </tr>
        </tbody>
    </table>
@stop