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
	Route::name('user.edit')->get('edit', 'UserController@getEdit');
	Route::name('user.update')->post('{id}/update', 'UserController@postUpdate');
	Route::post('{id}/delete', 'UserController@postDelete');
});
