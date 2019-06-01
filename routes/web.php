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

Route::get('/register','RegistratorController@registrationCandidate')->name('registration.register');
Route::post('/register', 'RegistratorController@register')->name('registration.registration');
Route::get('candidate/auth', 'RegistratorController@auth')->name('registration.auth');
Route::post('candidate/auth', 'RegistratorController@authorization')->name('registration.authorization');
Route::get('candidate/logout', 'RegistratorController@logout')->name('registration.logout');

Route::get('candidate/', 'RegistratorController@lk_candidate')->name('registration.lk')
    ->middleware(\App\Http\Middleware\CandidateAuth::class);
Route::get('/candidate/add', 'RegistratorController@create')->name('registration.create')
    ->middleware(\App\Http\Middleware\CandidateAuth::class);
Route::post('/candidate/add','RegistratorController@store')->name('registration.store');

Route::get('/cp', 'HeadController@index')->name('head.index');
Route::get('/cp/candidate', 'CandidateController@index' )->name('candidate.index');

Route::get('/cp/candidate/create', 'InviteController@create')->name('invites.create')
    ->middleware(\App\Http\Middleware\Authenticate::class);
Route::post('/cp/candidate/invite', 'InviteController@store')->name('invites.store')
    ->middleware(\App\Http\Middleware\Authenticate::class);
Route::get('/cp/candidate/invite-list', 'InviteController@index')->name('invites.index')
    ->middleware(\App\Http\Middleware\Authenticate::class);
Route::post('/cp/candidate/invite/retry', 'InviteController@retry')->name('invites.retry')
    ->middleware(\App\Http\Middleware\Authenticate::class);

