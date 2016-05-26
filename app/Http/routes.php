<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

Route::get('/', function () {
    return view('index');
});
Route::get('/test', function () {
    return view('test');
});
Route::post('/login','StudentController@login' );
//Route::auth();

// Route::get('/home', 'HomeController@index');

//Route::post('/login',function(Request $request){
//    $user=$request->input('user');
//    // dd(Request::all()['name'])
//    // echo $user['email'];
//    return $user;
//    // echo "you entered ".$user;
//});

// Route::post('/post_to_me','AuthController@login');