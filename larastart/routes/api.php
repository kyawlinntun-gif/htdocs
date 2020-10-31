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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Vue route
Route::get('/user', 'Api\UserController@index');
Route::post('/user', 'Api\UserController@store');
Route::delete('/user/{id}', 'Api\UserController@destroy');
Route::match(['put', 'patch'], '/user/{id}', 'Api\UserController@update');
Route::get('/profile', 'Api\UserController@profile');
Route::match(['put', 'patch'],'/profile', 'Api\UserController@profileUpdate');

