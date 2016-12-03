<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('jobs', 'JobController');
    Route::get('/{receiver_id}/{job_id}/messages', 'MessageController@index');
    Route::post('/messages/store', 'MessageController@store');

    Route::get('/{job_id}/inbox', 'MessageController@inbox');
});