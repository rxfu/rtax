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
	return redirect('home');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::prefix('user')->group(function () {
	Route::name('user.list')->get('list', 'UserController@getList');
	Route::name('user.create')->get('create', 'UserController@getCreate');
	Route::name('user.save')->post('save', 'UserController@postSave');
	Route::name('user.edit')->get('{id}/edit', 'UserController@getEdit');
	Route::name('user.update')->put('{id}/update', 'UserController@putUpdate');
	Route::name('user.delete')->delete('{id}/delete', 'UserController@deleteDelete');
	Route::name('user.chgpwd')->get('change-password', 'UserController@getChangePassword');
	Route::name('user.change')->put('change', 'UserController@putChangePassword');
	Route::name('user.rstpwd')->get('{id}/reset-password', 'UserController@getResetPassword');
	Route::name('user.reset')->put('{id}/reset', 'UserController@putResetPassword');
});
