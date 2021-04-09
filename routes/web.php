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

Route::get('doctor_specialities/search', 'DoctorsSpecialitiesController@search')->name('doctor_specialities.search');

Route::resource('users', 'UsersController');
Route::resource('specialities', 'SpecialitiesController');
Route::resource('appointments', 'AppointmentsController');
Route::resource('users.appointments', 'UserAppointmentsController');
Route::resource('details', 'DetailsController');

// ----------------------------------- \/
Route::get('settings/profile', 'SettingsController@edit_profile')->name('settings.edit_profile');
Route::put('settings/profile', 'SettingsController@update_profile')->name('settings.update_profile');
Route::get('settings/password', 'SettingsController@edit_password')->name('settings.edit_password');
Route::put('settings/password', 'SettingsController@update_password')->name('settings.update_password');
Route::get('settings/switch_panel', 'SettingsController@switch_panel')->name('settings.switch_panel');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('appointments/{appointment}/enroll', 'AppointmentsController@prepare_enroll')->name('appointments.enroll');
Route::post('appointments/{appointment}/enroll', 'AppointmentsController@enroll')->name('appointments.prepare_enroll');
Route::get('select_speciality', 'AppointmentsController@prepareSelectSpeciality')->name('appointments.prepare_select_speciality');
Route::post('select_speciality', 'AppointmentsController@selectSpeciality')->name('appointments.select_speciality');

Route::get('users/{user}/appointments/{appointment}/cancel', 'UserAppointmentsController@prepare_cancel');
Route::post('users/{user}/appointments/{appointment}/cancel', 'UserAppointmentsController@cancel');

Route::get('users/search', 'UsersController@search')->name('users.search');
Route::get('users/{user}/edit_doctor', 'UsersController@edit_doctor')->name('users.edit_doctor');
Route::post('users/{user}/update_doctor', 'UsersController@update_doctor')->name('users.update_doctor');

Route::get('logs', 'LogController@index')->name('logs.index');

Route::get('doctors/{doctor}/appointments', 'DoctorsAppointmentsController@index')->name('doctor.appointments');
Route::put('doctors/{doctor}/appointments/{appointment}/start', 'DoctorsAppointmentsController@start')->name('doctor.appointments.start');
Route::put('doctors/{doctor}/appointments/{appointment}/cancel', 'DoctorsAppointmentsController@cancel')->name('doctor.appointments.cancel');
Route::put('doctors/{doctor}/appointments/{appointment}/update', 'DoctorsAppointmentsController@update')->name('doctor.appointments.update');
Route::get('doctors/{doctor}/appointments/{appointment}', 'DoctorsAppointmentsController@show')->name('doctor.appointments.show');
