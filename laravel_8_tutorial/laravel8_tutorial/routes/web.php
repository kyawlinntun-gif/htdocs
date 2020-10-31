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

// Components
Route::get('/user/component', function(){
    return view('home');
});

// Laravel 8 change
Route::get('/user/{user}', [\App\Http\Controllers\UserController::class, 'index']);



