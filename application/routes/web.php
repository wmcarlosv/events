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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
	Route::resource('users','UsersController');
	Route::get('profile','UsersController@profile')->name('profile');
	Route::put('edit-profile','UsersController@edit_profile')->name('edit_profile');
	Route::put('change-password','UsersController@change_password')->name('change_password');
	Route::resource('events','EventsController');
	Route::get('list-events/{type}','EventsController@list_events')->name('list_events');
});
