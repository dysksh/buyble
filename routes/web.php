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
    Route::get('register_history', 'HomeController@register_history')->name('register_history');
    Route::put('purchase/{id}', 'HomeController@purchase')->name('purchase');
    Route::get('purchase_history', 'HomeController@purchase_history')->name('purchase_history');
    Route::get('users', 'Admin\UserController@index')->name('users.index');
    Route::put('user/edit', 'Admin\UserController@update')->name('users.update');
    Route::get('user/edit', 'Admin\UserController@edit')->name('users.edit');
    Route::resource('textbooks', 'TextbookController');
    Route::get('user/delete', 'Admin\UserController@delete')->name('users.delete');
    Route::delete('user/delete', 'Admin\UserController@destroy')->name('users.destroy');
    Route::get('user/{id}', 'Admin\UserController@show')->name('users.show');
    Route::delete('user/{id}', 'Admin\UserController@admindestroy')->name('users.admindestroy');
    Route::put('user/edit/{id}', 'Admin\UserController@adupdate')->name('users.adupdate');
    Route::get('user/edit/{id}', 'Admin\UserController@adedit')->name('users.adedit');
    Route::post('/pay', 'PaymentController@pay');
});
