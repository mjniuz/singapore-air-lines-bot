<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request)
// {
//     return $request->user();
// });

Route::group(['namespace' => 'Api', 'middleware' => 'api.auth'], function ()
{
    // messenger
    Route::get('bot/messenger', ['uses' => 'MessengerController@verifyToken']);
    Route::post('/bot/messenger', ['uses' => 'MessengerController@messengerBot']);

    // telegram
    Route::get('bot/telegram', ['uses' => 'TelegramController@verifyToken']);
    Route::post('/bot/telegram', ['uses' => 'TelegramController@telegramBot']);
});

Route::group(['namespace' => 'Api'], function ()
{
    Route::get('cron-price-reminder', ['uses' => 'CronController@priceReminder']);
});
