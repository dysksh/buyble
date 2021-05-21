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

Route::get('/', 'Auth\LoginController@showLoginForm');
Auth::routes([
    'reset' => false,
    'confirm' => false,
]);
Route::group(['middleware' => ['auth']], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('admin', 'HomeController@admin')->name('admin');
  
    Route::get('users', 'Admin\UserController@index')->name('users.index');
    Route::put('user/edit', 'Admin\UserController@update')->name('users.update');
    Route::get('user/edit', 'Admin\UserController@edit')->name('users.edit');
    Route::resource('textbooks', 'TextbookController');
});
