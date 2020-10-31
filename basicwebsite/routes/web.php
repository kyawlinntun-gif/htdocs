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

Route::get('/', 'PagesController@getHome')->name('pages.home');
Route::get('/about', 'PagesController@getAbout')->name('pages.about');
Route::get('/contact', 'PagesController@getContact')->name('pages.contact');

Route::post('/contact/submit', 'MessagesController@submit')->name('messages.submit');
Route::get('/getMessage', 'MessagesController@getMessage')->name('messages.getMessage');
