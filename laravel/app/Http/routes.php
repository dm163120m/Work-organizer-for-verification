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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/login', 'Auth\LoginController@index');
Route::post('/login', 'Auth\LoginController@loginPost');
Route::get('/register', 'Auth\RegisterController@index');
Route::post('/register', 'Auth\RegisterController@registerPost');
Route::get('/junior', 'JuniorController@home');
Route::get('/senior/tasks', 'SeniorController@tasks');
Route::get('/senior/tasks/{id}', 'SeniorController@getTask');
Route::get('/senior/tests', 'SeniorController@tests');
Route::post('/senior/create_task_post', 'SeniorController@createTaskPost');
Route::get('/senior/create_task', 'SeniorController@createTask');
Route::post('/senior/create_test_post', 'SeniorController@createTestPost');
Route::get('/senior/create_test', 'SeniorController@createTest');

Route::get('/senior/editprofile', 'UserController@editProfile');
