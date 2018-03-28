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

Route::get('book/{id}', function ($id) {
    return 'Hello World ' . $id;
});

Route::get('violation', function () {
    return [
    	"Melanggar Hukum",
    	"Tidak Pakai Helm"
    ];
});

Route::resource('violations', 'ViolationController@index');

Route::post('hello/test', function () {
    return 'Hello World 2';
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
