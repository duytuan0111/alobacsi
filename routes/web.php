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
Route::middleware(['adminLogin'])->group(function() {
    Route::get('admin/home', 'AdminController@index')->name('admin/home');
});
Route::prefix('admin')->group(function () {
    Route::post('/login', 'AdminController@login')->name('admin/login');
    Route::get('/login', 'AdminController@login');
});
Route::get('admin/logout', 'AdminController@logout')->name('admin/logout');
