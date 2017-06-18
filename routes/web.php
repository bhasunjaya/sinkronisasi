<?php

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
    return 'goto djpk';
});

/**
 * DJPK ROUTE
 */
Route::group(['prefix' => 'djpk', 'namespace' => 'Djpk'], function () {
    Route::resource('user', 'UserController');
    Route::resource('bappenas', 'BappenasController');
    Route::resource('bidang', 'BidangController');
    Route::resource('subbidang', 'SubbidangController');
    Route::resource('dinas', 'DinasController');
    Route::resource('kl', 'KlController');
    Route::resource('pemda', 'PemdaController');
    Route::resource('document', 'DocumentController');
});

Route::group(['prefix' => 'pemda', 'namespace' => 'Pemda'], function () {
    Route::get('usulan', 'UsulanController@index');
});
