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

Auth::routes();

Route::get('/', 'TestController@index')->name('home');

Route::post('/test/save', 'TestController@save')->name('test.save');
Route::get('/test/inform', 'TestController@inform')->name('test.inform');
