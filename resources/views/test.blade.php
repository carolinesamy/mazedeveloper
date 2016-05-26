{{--<form method="post">--}}
    {{--<label>Name</label>--}}
    {{--<input type="text" name="email">--}}
    {{--<label>password</label>--}}
    {{--<input type="password" name="password">--}}
    {{--<button type="submit" >login </button>--}}
{{--</form>--}}

{!! Form::open(array('url' => '/test', 'method' => 'post')) !!}

<label>Name</label>
<input type="text" name="email">
<label>password</label>
<input type="password" name="password">
<button type="submit" >login </button>

{!! Form::close() !!}