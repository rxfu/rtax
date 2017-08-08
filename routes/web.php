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
	Route::get('list', 'UserController@getList')->name('user.list');
	Route::get('create', 'UserController@getCreate')->name('user.create');
	Route::post('create', 'UserController@postCreate');
	Route::get('edit', 'UserController@getEdit')->name('user.edit');
	Route::post('{id}/edit', 'UserController@postEdit');
	Route::post('{id}/delete', 'UserController@postDelete');
});
