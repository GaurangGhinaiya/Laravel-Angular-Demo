<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

//Route::get('/', function () {
//    return view('admin');
//});


/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'Common\LoginController@index');
//Authentication Module
    Route::post('/auth/login', 'Common\LoginController@doLogin');
    Route::post('/auth/facebook', 'Common\LoginController@facebook');
    Route::post('/auth/forgot-password', 'Common\LoginController@forgotPassword');
    Route::post('/auth/reset-password', 'Common\LoginController@resetPassword');
    Route::get('/loggedinuser', 'Common\LoginController@logginuser');
    Route::get('/logout', 'Common\LoginController@logout');
    Route::get('/db-setup', 'Common\CommonController@dbSetup');

    //User Ctrl
    Route::resource('/user', 'UserController');
    Route::post('/user/paginate', 'UserController@paginateUser');
    Route::post('/user/activate/{user_id}', 'UserController@updateActive');
});
