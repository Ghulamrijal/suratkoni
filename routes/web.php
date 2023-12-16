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

// Route::get('/', function () {
//     return view('galeri\lihat');
// });

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/postlogin', 'App\Http\Controllers\AuthController@postlogin');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->middleware('auth');

Route::get('/suratmasuk', 'App\Http\Controllers\SuratMasukController@index')->middleware('auth');
Route::post('/suratmasuk/create','App\Http\Controllers\SuratMasukController@create')->middleware('auth');
Route::post('/suratmasuk/{id}/update','App\Http\Controllers\SuratMasukController@update')->middleware('auth');
Route::post('/suratmasuk/{id}/disposisi','App\Http\Controllers\SuratMasukController@disposisi')->middleware('auth');
Route::post('/suratmasuk/{id}/tindaklanjut','App\Http\Controllers\SuratMasukController@tindaklanjut')->middleware('auth');
Route::get('/suratmasuk/{id}/delete','App\Http\Controllers\SuratMasukController@delete')->middleware('auth');

Route::get('/galeri', 'App\Http\Controllers\GaleriController@index')->middleware('auth');


Route::get('/klasifikasi', 'App\Http\Controllers\KlasifikasiController@index')->middleware('auth');
Route::post('/klasifikasi/create','App\Http\Controllers\KlasifikasiController@create')->middleware('auth');
Route::post('/klasifikasi/{id}/update','App\Http\Controllers\KlasifikasiController@update')->middleware('auth');
Route::get('/klasifikasi/{id}/delete','App\Http\Controllers\KlasifikasiController@delete')->middleware('auth');

