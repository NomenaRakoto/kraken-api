<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('kraken/login', 'API\AuthController@login');

Route::middleware('auth:api')->group( function () {
	Route::post('kraken/create', 'API\Kraken\KrakenController@create');
    Route::post('kraken/tentacle', 'API\Kraken\TentacleController@add');
    Route::delete('kraken/tentacle/{id}', 'API\Kraken\TentacleController@delete');
    Route::post('kraken/power', 'API\Kraken\PowerController@add');
    Route::get('kraken/summary', 'API\Kraken\KrakenController@summary');
});
