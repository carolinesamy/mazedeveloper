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

//*** by merna *******/
Route::post('/accept','AnswerController@accept_answer');

Route::post('/unaccept','AnswerController@unaccept_answer');

Route::post('/ask','QuestionController@add_question');


//**by caroline *** after login go to home to show couses && questions
Route::post('/getuserdata','StudentController@gethomeuserdata');



Route::post('/gettags','TagController@get_tag');

/***** by christina *****/
Route::post('/addanswer','AnswerController@add_answer');

Route::post('/questiondata','QuestionController@get_question');
Route::post('/complete','QuestionController@complete');


/*******by merna ********/
Route::post('/questioncomment','CommentController@comment');
Route::post('/answerreply','ReplyController@reply');
Route::post('/getnotifications','NotificationController@get_notification_num');
Route::post('/goldenmark','AnswerController@golden_mark');
Route::post('/ungoldenmark','AnswerController@ungolden_mark');
Route::post('/commentnotification','NotificationController@comment_notification');
Route::post('/replynotification','NotificationController@reply_notification');
Route::post('/getallinstructors','InboxmessageController@all_instructors');
Route::post('/getinboxmsg','InboxmessageController@inbox_msg');
Route::post('/sentinboxmsg','InboxmessageController@send_message');
//Route::post('/tocomplete','InboxmessageController@to_auto_compete');

//**by caroline *** routes for edit question && edit answer

Route::post('/editquestion','QuestionController@edit_question');

Route::post('/editanswer','AnswerController@edit_answer');

Route::post('/likeaction','AnswerController@like_action');
Route::post('/removelike','AnswerController@like_remove');

Route::post('/dislikeaction','AnswerController@dislike_action');
Route::post('/removedislike','AnswerController@dislike_remove');
Route::post('/getnotificationsdata','NotificationController@get_notification_data');
Route::post('/questionnotification','NotificationController@question_notification');
Route::post('/answernotification','NotificationController@answer_notification');
Route::post('/likenotification','NotificationController@like_notification');
Route::post('/dislikenotification','NotificationController@dislike_notification');
Route::post('/acceptnotification','NotificationController@accept_notification');
Route::post('/goldentnotification','NotificationController@golden_notification');
Route::post('/getmsgnum','InboxmessageController@get_msg_notification_num');
Route::post('/getmsgdata','InboxmessageController@get_msg_data');

/** by christina **  ***** routes for admin */
//Route::get('/admin/login','AuthController@login');
Route::get('/admin','AdminController@relogin');
Route::post('/admin/login','AdminController@login');
//Route::get('/admin/students','AdminController@index');
//Route::get('/admin/students/{id}','AdminController@show');
//Route::resource('/admin','AdminController');


//Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/admin/charts',function(){
    return view('admin/charts');
});
//Route::get('/admin/tables',function(){
//    return view('admin/tables');
//});
Route::get('/admin/tables','AdminController@index');
Route::get('/admin/forms',function(){
    return view('admin/forms');
});
Route::get('/admin/bootstrapElements',function(){
    return view('admin/bootstrap-elements');
});
Route::get('/admin/bootstrapGrid',function(){
    return view('admin/bootstrap-grid');
});
Route::get('/admin/aindex',function(){
    return view('adminDashboard');
});
Route::get('/admin/blankPage',function(){
    return view('admin/blank-page');
});
Route::get('/admin/rindex',function(){
    return view('admin/index-rtl');
});


Route::get('/admin/students/{id}','AdminController@show');
Route::get('/admin/students/{id}/edit','AdminController@edit');
Route::get('/admin/students/destroy/{id}','AdminController@destroy');
//
//// Authentication Routes...
//$this->get('login', 'Auth\AuthController@showLoginForm');
//$this->post('login', 'Auth\AuthController@login');
//$this->get('logout', 'Auth\AuthController@logout');
//
//// Registration Routes...
//$this->get('register', 'Auth\AuthController@showRegistrationForm');
//$this->post('register', 'Auth\AuthController@register');
//
//// Password Reset Routes...
//$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
//$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
//$this->post('password/reset', 'Auth\PasswordController@reset');
