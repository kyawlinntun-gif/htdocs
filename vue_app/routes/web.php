<?php

use Illuminate\Http\Request;
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

Route::get('/language', function() {
    $language = ['html', 'css', 'jquery', 'php', 'laravel'];
    return response(
        $language
    );
});

Route::get('/vue_form', function() {
    return view('vue_form/form');
});

Route::post('/store_data', [\App\Http\Controllers\VueForm\StoreDataController::class, 'store']);

// Form
Route::get('/form2', function() {
   return view('vue_form/form2');
});
Route::post('/form2/add', function(\Illuminate\Http\Request $request){
    $request->validate([
       'name' => 'required',
       'age' => 'required',
       'profession' => 'required'
    ]);
    return response(['success' => 'Store the data successfully!']);
});

// Form3
Route::get('/form3', function(){
    return view('vue_form.form3');
});

Route::post('/form3/store', function(Request $request){
    $request->validate([
        'name' => 'required',
        'profession' => 'required'
    ]);

    return response(['success' => 'Store the data successfully!']);
});

// Panel
Route::get('/panel', function(){
    return view('panel/panel');
});

// Panel 2
Route::get('/panel2', function(){
    return view('panel/panel2');
});
