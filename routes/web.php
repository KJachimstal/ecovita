<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('logout', 'Auth\LoginController@logout');
Route::get('users/search', 'UsersController@search')->name('users.search');
Route::get('doctor_specialities/search', 'DoctorsSpecialitiesController@search')->name('doctor_specialities.search');

Route::resource('users', 'UsersController');
Route::resource('specialities', 'SpecialitiesController');
Route::resource('appointments', 'AppointmentsController');
Route::resource('users.appointments', 'UserAppointmentsController');

// ----------------------------------- \/
Route::get('settings/profile', 'SettingsController@edit_profile')->name('settings.edit_profile');
Route::put('settings/profile', 'SettingsController@update_profile')->name('settings.update_profile');
Route::get('settings/password', 'SettingsController@edit_password')->name('settings.edit_password');
Route::put('settings/password', 'SettingsController@update_password')->name('settings.update_password');
Route::get('settings/switch_panel', 'SettingsController@switch_panel')->name('settings.switch_panel');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('appointments/{appointment}/enroll', 'AppointmentsController@prepare_enroll');
Route::post('appointments/{appointment}/enroll', 'AppointmentsController@enroll');

Route::get('users/{user}/appointments/{appointment}/cancel', 'UserAppointmentsController@prepare_cancel');
Route::post('users/{user}/appointments/{appointment}/cancel', 'UserAppointmentsController@cancel');

Route::get('users/{user}/edit_doctor', 'UsersController@edit_doctor')->name('users.edit_doctor');
Route::post('users/{user}/update_doctor', 'UsersController@update_doctor')->name('users.update_doctor');
Route::get('logs', 'LogController@index')->name('logs.index');
