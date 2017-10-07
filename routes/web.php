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

// set frontend routing
Route::group(['namespace' => 'Frontend'], function ()
{
    Route::group(['prefix' => 'frontend'], function ()
    {
        Route::get('/', ['as' => 'frontend.home', 'uses' => 'SiteController@index']);
        Route::get('/format/chat', ['as' => 'frontend.formatchat', 'uses' => 'SiteController@formatChat']);
        Route::get('/promo/{slug?}', ['as' => 'frontend.promotion', 'uses' => 'SiteController@promotion']);
        Route::get('/flights', ['as' => 'frontend.flights', 'uses' => 'FlightController@searchFlights']);

        // auth
        Route::get('/login', ['as' => 'frontend.login', 'uses' => 'AuthController@login']);
        Route::post('/login', ['as' => 'frontend.login.submit', 'uses' => 'AuthController@loginSubmit']);
        Route::get('/register', ['as' => 'frontend.register', 'uses' => 'AuthController@register']);
        Route::post('/register', ['as' => 'frontend.register.submit', 'uses' => 'AuthController@registerSubmit']);
        Route::get('/logout', ['as' => 'frontend.logout', 'uses' => 'AuthController@logout']);
    });

    Route::group(['prefix' => 'check-in'], function ()
    {
        Route::get('/{token?}', ['uses' => 'SiteController@checkInIndex']);
        Route::post('/{token?}', ['uses' => 'SiteController@checkInSave']);
    });
});

// set admin routing
Route::group(['namespace' => 'Admin', 'prefix' => 'admin-manager'], function ()
{
    // auth
    Route::get('/', ['as' => 'admin.login', 'uses' => 'AuthController@index']);
    Route::post('/', ['as' => 'admin.login.submit', 'uses' => 'AuthController@login']);
    Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'AuthController@logout']);

    Route::group(['middleware' => 'auth.admin'], function ()
    {
        // set dashboard
        Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'SiteController@dashboard']);

        // users
        Route::get('/users', ['as' => 'admin.users', 'uses' => 'UserController@index']);

        // promotions
        Route::get('/promotions', ['as' => 'admin.promotions', 'uses' => 'PromotionController@index']);
        Route::get('/promotion/form/{id?}', ['as' => 'admin.promotion.form', 'uses' => 'PromotionController@form']);
        Route::post('/promotion/form/{id?}', ['as' => 'admin.promotion.store', 'uses' => 'PromotionController@store']);
        Route::delete('promotion/delete/{id?}', ['as' => 'admin.promotion.delete', 'uses' => 'PromotionController@delete']);

        // check flights
        Route::get('/checkflights', ['as' => 'admin.checkflights', 'uses' => 'CheckFlightController@index']);

        /**
         * // chats
         * Route::get('/chats', ['as' => 'admin.chats', 'uses' => 'ChatController@index']);
         * Route::get('/chat/form/{id?}', ['as' => 'admin.chat.form', 'uses' => 'ChatController@form']);
         * Route::post('/chat/form/{id?}', ['as' => 'admin.chat.store', 'uses' => 'ChatController@store']);
         * Route::delete('chat/delete/{id?}', ['as' => 'admin.chat.delete', 'uses' => 'ChatController@delete']);
         */

        // flights reminder
        Route::get('/flightreminders', ['as' => 'admin.flightreminders', 'uses' => 'FlightReminderController@index']);
    });
});
