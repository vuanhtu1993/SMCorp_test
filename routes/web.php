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
    return view('layout.index');
});
Route::get('users/check','UsersController@check');
Route::post('users/get_check','UsersController@get_check');
Route::resource('users','UsersController');
Route::resource('roles','RolesController');
Route::resource('permissions','PermissionsController');
