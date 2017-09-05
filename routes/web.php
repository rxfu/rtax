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

Route::prefix('type')->group(function () {
	Route::name('type.list')->get('list', 'TypeController@getList');
	Route::name('type.create')->get('create', 'TypeController@getCreate');
	Route::name('type.save')->post('save', 'TypeController@postSave');
	Route::name('type.edit')->get('{id}/edit', 'TypeController@getEdit');
	Route::name('type.update')->put('{id}/update', 'TypeController@putUpdate');
	Route::name('type.delete')->delete('{id}/delete', 'TypeController@deleteDelete');
});

Route::prefix('section')->group(function () {
	Route::name('section.list')->get('list', 'SectionController@getList');
	Route::name('section.create')->get('create', 'SectionController@getCreate');
	Route::name('section.save')->post('save', 'SectionController@postSave');
	Route::name('section.edit')->get('{id}/edit', 'SectionController@getEdit');
	Route::name('section.update')->put('{id}/update', 'SectionController@putUpdate');
	Route::name('section.delete')->delete('{id}/delete', 'SectionController@deleteDelete');
});

Route::prefix('tax')->group(function () {
	Route::name('tax.list')->get('list', 'TaxController@getList');
	Route::name('tax.create')->get('create', 'TaxController@getCreate');
	Route::name('tax.save')->post('save', 'TaxController@postSave');
	Route::name('tax.edit')->get('{id}/edit', 'TaxController@getEdit');
	Route::name('tax.update')->put('{id}/update', 'TaxController@putUpdate');
	Route::name('tax.delete')->delete('{id}/delete', 'TaxController@deleteDelete');
	Route::name('tax.search')->get('search', 'TaxController@getSearch');
	Route::name('tax.excel')->get('import', 'TaxController@getImport');
	Route::name('tax.import')->post('import', 'TaxController@postImport');
	Route::name('tax.batchDelete')->delete('batchDelete', 'TaxController@deleteBatchDelete');
	Route::name('tax.chart')->get('chart', 'TaxController@getChart');
});

Route::prefix('paid')->group(function () {
	Route::name('paid.list')->get('list', 'PaidController@getList');
	Route::name('paid.create')->get('create', 'PaidController@getCreate');
	Route::name('paid.save')->post('save', 'PaidController@postSave');
	Route::name('paid.edit')->get('{id}/edit', 'PaidController@getEdit');
	Route::name('paid.update')->put('{id}/update', 'PaidController@putUpdate');
	Route::name('paid.delete')->delete('{id}/delete', 'PaidController@deleteDelete');
});

Route::prefix('declaration')->group(function () {
	Route::name('declaration.list')->get('list', 'DeclarationController@getList');
	Route::name('declaration.create')->get('create', 'DeclarationController@getCreate');
	Route::name('declaration.save')->post('save', 'DeclarationController@postSave');
	Route::name('declaration.edit')->get('{id}/edit', 'DeclarationController@getEdit');
	Route::name('declaration.update')->put('{id}/update', 'DeclarationController@putUpdate');
	Route::name('declaration.delete')->delete('{id}/delete', 'DeclarationController@deleteDelete');
});

Route::prefix('policy')->group(function () {
	Route::name('policy.list')->get('list', 'PolicyController@getList');
	Route::name('policy.create')->get('create', 'PolicyController@getCreate');
	Route::name('policy.save')->post('save', 'PolicyController@postSave');
	Route::name('policy.edit')->get('{id}/edit', 'PolicyController@getEdit');
	Route::name('policy.update')->put('{id}/update', 'PolicyController@putUpdate');
	Route::name('policy.delete')->delete('{id}/delete', 'PolicyController@deleteDelete');
});

Route::prefix('completion')->group(function () {
	Route::name('completion.list')->get('list', 'CompletionController@getList');
	Route::name('completion.create')->get('create', 'CompletionController@getCreate');
	Route::name('completion.save')->post('save', 'CompletionController@postSave');
	Route::name('completion.edit')->get('{id}/edit', 'CompletionController@getEdit');
	Route::name('completion.update')->put('{id}/update', 'CompletionController@putUpdate');
	Route::name('completion.delete')->delete('{id}/delete', 'CompletionController@deleteDelete');
});

Route::prefix('department')->group(function () {
	Route::name('department.list')->get('list', 'DepartmentController@getList');
	Route::name('department.create')->get('create', 'DepartmentController@getCreate');
	Route::name('department.save')->post('save', 'DepartmentController@postSave');
	Route::name('department.edit')->get('{id}/edit', 'DepartmentController@getEdit');
	Route::name('department.update')->put('{id}/update', 'DepartmentController@putUpdate');
	Route::name('department.delete')->delete('{id}/delete', 'DepartmentController@deleteDelete');
});