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
    return view('intro');
});

Route::get('/map', function () {
    return view('map');
});
Route::get('/map', 'HomeController@map')->name('map');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@adminlte')->name('adminlte'); //yet to be worked on!! Bleon...
Route::get('/heat', 'HomeController@heat')->name('heat');
//Route::get('/corona', 'HomeController@corona')->name('corona');
Route::get('/corona', 'HomeController@try')->name('try');