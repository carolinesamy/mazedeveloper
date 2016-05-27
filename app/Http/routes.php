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

Route::post('/accept','AnswerController@accept_answer');

Route::post('/unaccept','AnswerController@unaccept_answer');

Route::post('/ask','QuestionController@add_question');


//**by caroline *** after login go to home to show couses && questions
Route::get('/getuserdata','StudentController@gethomeuserdata');



Route::get('/gettags','TagController@get_tag');


