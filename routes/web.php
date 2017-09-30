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

Route::get('/', function ()
{
    return view('welcome');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin-manager'], function ()
{
    Route::get('/', ['as' => 'admin.login', 'uses' => 'AuthController@index']);
    Route::post('/', ['as' => 'admin.login.submit', 'uses' => 'AuthController@login']);
    Route::post('/logout', ['as' => 'admin.login.submit', 'uses' => 'AuthController@logout']);
});
