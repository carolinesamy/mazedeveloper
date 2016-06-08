{{--<!DOCTYPE html>--}}
{{--<html >--}}
{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<title>Elegant Login Form</title>--}}
    {{--<script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>--}}

    {{--<link rel="stylesheet" href="css/reset.css">--}}

    {{--<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>--}}

    {{--<link rel="stylesheet" href="css/style.css">--}}


{{--</head>--}}

{{--<body>--}}


{{--<form class="login" method="POST">--}}
{{--    {!! Form::open(['route'=>'admin.index','method'=>'post']) !!}--}}
    {{--<fieldset>--}}

        {{--<legend class="legend">Login</legend>--}}

        {{--<div class="input">--}}
            {{--<input type="email" placeholder="Email" name="email" required />--}}
            {{--<span><i class="fa fa-envelope-o"></i></span>--}}
        {{--</div>--}}

        {{--<div class="input">--}}
            {{--<input type="password" placeholder="Password" name="password" required />--}}
            {{--<span><i class="fa fa-lock"></i></span>--}}
        {{--</div>--}}

        {{--<button type="submit" class="submit" onclick="window.location='{{ url("admin/login") }}'"><i class="fa fa-long-arrow-right"></i></button>--}}
        {{--onclick="window.location='{{ url("admin/login") }}'"--}}
    {{--</fieldset>--}}
{{--    {!! Form::close() !!}--}}
    {{--<div class="feedback">--}}
        {{--login successful <br />--}}
        {{--redirecting...--}}
    {{--</div>--}}

{{--</form>--}}
{{--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>--}}

{{--<script src="js/index.js"></script>--}}




{{--</body>--}}
{{--</html>--}}



{{--@extends('layouts.app')--}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> Login
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

