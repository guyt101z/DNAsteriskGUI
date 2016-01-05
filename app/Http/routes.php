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

Route::get('/',['middleware' => 'auth','uses' => 'PagesController@getHome']);

Route::get('/auth/login',['uses' => 'Auth\AuthController@getLogin']);
Route::post('/auth/login',['uses' => 'Auth\AuthController@postLogin']);
Route::get('/auth/logout',['uses' => 'Auth\AuthController@getLogout']);

Route::get('/password/change',['middleware' => 'auth', 'uses' => 'PasswordController@getChangePassword']);
Route::post('/password/change',['middleware' => 'auth', 'uses' => 'PasswordController@postChangePassword']);

Route::resource('did','DIDController');
Route::post('did/{id}/edit','DIDController@update');

Route::resource('user','UserController');
Route::post('/user/create','UserController@store');
Route::post('/user/{id}/edit','UserController@update');

Route::resource('sounds','SoundController');
Route::post('/sounds/create','SoundController@store');
Route::post('/sounds/{id}/edit','SoundController@update');

Route::resource('conf','ConferenceBridgeController');
Route::post('/conf/create','ConferenceBridgeController@store');
Route::post('/conf/{id}/edit','ConferenceBridgeController@update');

Route::resource('ringgroups','RingGroupController');
Route::post('/ringgroups/create','RingGroupController@store');
Route::post('/ringgroups/{id}/edit','RingGroupController@update');

Route::get('/queue','QueueController@index');
Route::get('/queue/create','QueueController@create');
Route::get('/queue/{id}/edit','QueueController@edit');
Route::post('/queue/create','QueueController@store');
Route::post('/queue/{id}/edit','QueueController@update');

Route::get('/speeddials','SpeedDialController@index');
Route::get('/speeddials/create','SpeedDialController@create');
Route::get('/speeddials/{id}/edit','SpeedDialController@edit');
Route::post('/speeddials/create','SpeedDialController@store');
Route::post('/speeddials/{id}/edit','SpeedDialController@update');

Route::get('/voicemail','VoicemailController@index');
Route::get('/voicemail/create','VoicemailController@create');
Route::get('/voicemail/{id}/edit','VoicemailController@edit');
Route::post('/voicemail/create','VoicemailController@store');
Route::post('/voicemail/{id}/edit','VoicemailController@update');