<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/countries', 'CountryController@index');
Route::post('/countries', 'CountryController@store');
Route::delete('/countries/{id}', 'CountryController@delete');
Route::patch('/countries/{id}', 'CountryController@update');


Route::get('/cities/', 'CityController@show');
Route::get('/cities/{id}', 'CityController@show');
Route::post('/cities', 'CityController@store');
Route::delete('/cities/{id}', 'CityController@delete');
Route::patch('/cities/{id}', 'CityController@update');
