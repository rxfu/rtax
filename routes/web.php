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

Route::prefix('rate')->group(function () {
	Route::name('rate.list')->get('list', 'RateController@getList');
	Route::name('rate.create')->get('create', 'RateController@getCreate');
	Route::name('rate.save')->post('save', 'RateController@postSave');
	Route::name('rate.edit')->get('{id}/edit', 'RateController@getEdit');
	Route::name('rate.update')->put('{id}/update', 'RateController@putUpdate');
	Route::name('rate.delete')->delete('{id}/delete', 'RateController@deleteDelete');
});

Route::prefix('project')->group(function () {
	Route::name('project.list')->get('list', 'ProjectController@getList');
	Route::name('project.create')->get('create', 'ProjectController@getCreate');
	Route::name('project.save')->post('save', 'ProjectController@postSave');
	Route::name('project.edit')->get('{id}/edit', 'ProjectController@getEdit');
	Route::name('project.update')->put('{id}/update', 'ProjectController@putUpdate');
	Route::name('project.delete')->delete('{id}/delete', 'ProjectController@deleteDelete');
});

Route::prefix('tax')->group(function () {
	Route::name('tax.list')->get('list', 'TaxController@getList');
	Route::name('tax.create')->get('create', 'TaxController@getCreate');
	Route::name('tax.save')->post('save', 'TaxController@postSave');
	Route::name('tax.edit')->get('{id}/edit', 'TaxController@getEdit');
	Route::name('tax.update')->put('{id}/update', 'TaxController@putUpdate');
	Route::name('tax.delete')->delete('{id}/delete', 'TaxController@deleteDelete');
});
