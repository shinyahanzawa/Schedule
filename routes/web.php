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

Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/monthly', 'App\Http\Controllers\CalendarController@monthly');
Route::get('/weekly', 'App\Http\Controllers\CalendarController@weekly');
Route::get('/day', 'App\Http\Controllers\CalendarController@day');

Route::post('/create', 'App\Http\Controllers\CalendarController@create');
Route::get('/create', 'App\Http\Controllers\CalendarController@create');

Route::post('/store', 'App\Http\Controllers\CalendarController@store');

Route::post('/delete', 'App\Http\Controllers\CalendarController@delete');
