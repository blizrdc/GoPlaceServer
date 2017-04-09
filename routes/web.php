<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('user/login','UserController@Login');
Route::post('task/show','TaskController@Show');
Route::post('task/start','TaskController@Start');
Route::get('task/demonstrate','TaskController@Demonstrate');
Route::get('task/test','TaskController@Test');
Route::get('task/prompt/lat/{lat?}/lng/{lng?}/tokenpasswd/{_tokenpasswd?}','TaskController@Prompt');
Auth::routes();

Route::get('/home', 'HomeController@index');
