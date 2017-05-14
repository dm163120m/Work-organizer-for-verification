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
Route::get('/junior', 'JuniorController@home');

