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


// disable registration:

Auth::routes(['register' => false, 'reset' => false]);


Route::get('/', 'RegistratorController@index')->name('registration.index');
Route::post('/','RegistratorController@store')->name('registration.store');
