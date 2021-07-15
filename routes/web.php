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
Route::post('/admin/login', 'AdminController@login')->name('admin/login');
Route::get('/admin/login', 'AdminController@login');
Route::get('admin','AdminController@index')->name('admin'); // Định danh route