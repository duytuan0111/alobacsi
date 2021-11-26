<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware(['adminLogin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('home', 'AdminController@index')->name('admin/home');
        Route::prefix('category')->group(function() {
            Route::get('list', 'CategoryController@index')->name('admin/category/list');
            Route::get('create', 'CategoryController@create')->name('admin/category/create');
            Route::post('store', 'CategoryController@store')->name('admin/category/store');
            Route::get('edit/{id}', 'CategoryController@edit')->name('admin/category/edit');
            Route::post('edit/{id}', 'CategoryController@edit')->name('admin/category/edit');
            Route::post('update/{id}', 'CategoryController@update')->name('admin/category/update');
            Route::get('delete/{id}', 'CategoryController@delete')->name('admin/category/delete');
        });
        Route::prefix('product')->group(function() {
            Route::get('index', 'ProductController@index')->name('admin/product/list');
            Route::get('create','ProductController@create')->name('admin/product/create');
            Route::get('edit/{id}', 'ProductController@edit')->name('admin/product/edit');
            Route::get('destroy/{id}', 'ProductController@destroy')->name('admin/product/destroy');
            Route::post('store', 'ProductController@store')->name('admin/product/store');
            Route::post('update/{id}', 'ProductController@update')->name('admin/product/update');
        });
        Route::prefix('slider')->group(function() {
            Route::get('index', 'SliderController@index')->name('admin/slider/list');
            Route::get('create', 'SliderController@create')->name('admin/slider/create');
            Route::post('store', 'SliderController@store')->name('admin/slider/store');
            Route::get('edit/{id}', 'SliderController@edit')->name('admin/slider/edit');
            Route::post('update/{id}', 'SliderController@update')->name('admin/slider/update');
            Route::get('delete/{id}', 'SliderController@delete')->name('admin/slider/delete');
        });
        Route::prefix('settings')->group(function() {
            Route::get('index', 'SettingController@index')->name('admin/settings/list');
            Route::get('create', 'SettingController@create')->name('admin/settings/create');
            Route::post('store', 'SettingController@store')->name('admin/settings/store');
            Route::get('edit/{id}', 'SettingController@edit')->name('admin/settings/edit');
        });
    });
});
Route::prefix('admin')->group(function () {
    Route::post('/login', 'AdminController@login')->name('admin/login');
    Route::get('/login', 'AdminController@login');
});
Route::get('admin/logout', 'AdminController@logout')->name('admin/logout');
