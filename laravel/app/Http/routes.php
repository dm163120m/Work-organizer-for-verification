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
Route::get('/senior/tests/{id}', 'SeniorController@getTest');
Route::get('/junior/tests/{id}', 'JuniorController@getTest');
Route::get('/senior/tests', 'SeniorController@tests');
Route::post('/senior/create_task_post', 'SeniorController@createTaskPost');
Route::get('/senior/create_task', 'SeniorController@createTask');
Route::post('/senior/create_test_post', 'SeniorController@createTestPost');
Route::get('/senior/create_test', 'SeniorController@createTest');
Route::post('/junior/create_test_post', 'JuniorController@createTestPost');
Route::get('/junior/create_test', 'JuniorController@createTest');
Route::get('/admin/requests', 'AdminController@requests');
Route::get('/admin/users', 'AdminController@users');
Route::get('/editprofile', 'UserController@editProfile');
Route::post('/editprofile', 'UserController@editProfilePost');
Route::post('/senior/update_task', 'SeniorController@updateTask');
Route::post('/junior/update_task', 'JuniorController@updateTaskJunior');
Route::post('/senior/update_test', 'SeniorController@updateTest');
Route::post('/junior/update_test', 'JuniorController@updateTestJunior');
Route::post('/register', 'Auth\RegisterController@registerPost');
Route::get('/senior/home', 'SeniorController@notifications');
Route::post('/get_tests', 'SeniorController@getTests');
Route::get('/senior/search_tasks', 'SeniorController@searchTasks');
Route::get('/senior/search_tests', 'SeniorController@searchTests');
Route::get('/junior/search_tasks', 'JuniorController@searchTasks');
Route::get('/junior/search_tests', 'JuniorController@searchTests');
Route::get('/junior/home', 'JuniorController@notifications');
Route::get('/junior/tasks', 'JuniorController@tasks');
Route::get('/junior/tasks/{id}', 'JuniorController@getTask');
Route::get('/junior/tests', 'JuniorController@tests');
Route::get('/senior/home', 'SeniorController@notifications');
Route::get('/logout', 'UserController@logout');
Route::post('/junior/add_reports', 'JuniorController@addReports');
Route::get('/admin/approve_user{id}', 'AdminController@approveUser');
Route::get('/admin/approve_user/{username}', 'AdminController@approveUser');
Route::get('/admin/reject_user/{username}', 'AdminController@rejectUser');

