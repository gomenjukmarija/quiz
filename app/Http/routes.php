<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('home/question', 'QuestionController@index');
Route::post('home/question','QuestionController@data');
Route::post('home', 'QuestionController@store');

Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Routes for clients...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Routes for admin...
Route::get('admin/register', 'Auth\AuthController@getRegisterAdmin');
Route::post('admin/register', 'Auth\AuthController@postRegisterAdmin');

Route::get('admin', 'AdminController@questions')->middleware('admin');
Route::post('admin/result', 'ResultController@data')->middleware('admin');

Route::get('admin/create', 'AdminController@create')->middleware('admin');
Route::delete('admin/{id}', 'AdminController@destroy')->middleware('admin');
Route::post('admin', 'AdminController@store')->middleware('admin');
Route::get('user', 'UserController@users')->middleware('admin');