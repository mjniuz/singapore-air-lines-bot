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
    // auth
    Route::get('/', ['as' => 'admin.login', 'uses' => 'AuthController@index']);
    Route::post('/', ['as' => 'admin.login.submit', 'uses' => 'AuthController@login']);
    Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'AuthController@logout']);

    Route::group(['middleware' => 'auth.admin'], function ()
    {
        Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'SiteController@dashboard']);

        // users
        Route::get('/users', ['as' => 'admin.users', 'uses' => 'UserController@index']);

        // promotions
        Route::get('/promotions', ['as' => 'admin.promotions', 'uses' => 'PromotionController@index']);
        Route::get('/promotion/form/{id?}', ['as' => 'admin.promotion.form', 'uses' => 'PromotionController@form']);
        Route::post('/promotion/form/{id?}', ['as' => 'admin.promotion.store', 'uses' => 'PromotionController@store']);
        Route::delete('promotion/delete/{id?}', ['as' => 'admin.promotion.delete', 'uses' => 'PromotionController@delete']);
    });
});
