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

Auth::routes();

Route::get('/', 'RegistratorController@index')->name('registration.index');
Route::post('/','RegistratorController@store')->name('registration.store');

Route::post('/ajax','AjaxController@postsList')->name('ajax.getPostsByDepartament');

Route::post('/addiction', 'AddictionController@store')->name('addiction.store');
Route::delete('/addiction', 'AddictionController@destroy')->name('addiction.destroy');

Route::post('/application/export/', 'ApplicationController@export')->name('application.export');
Route::get('/application/unchecked', 'ApplicationController@unchecked')->name('application.unchecked');
Route::post('/application/submit', 'ApplicationController@submit')->name('application.submit.status');
Route::resource('/application', 'ApplicationController')->names('application');

Route::resource('/departament', 'DepartamentController')->names('departament');
Route::resource('/post', 'PostController')->names('post');