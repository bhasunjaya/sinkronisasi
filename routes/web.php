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
    Route::resource('kegiatan', 'KegiatanController');
    Route::get('list-kegiatan/{id}', 'DocumentController@listKegiatan');
    Route::get('document/download', 'DocumentController@download');
    Route::resource('document', 'DocumentController');
});

Route::group(['prefix' => 'pemda', 'namespace' => 'Pemda'], function () {
    Route::get('/', 'DashboardController@index');
    Route::post('usulan', 'UsulanController@postIndex');
    Route::get('usulan', 'UsulanController@index');
    Route::get('review', 'UsulanController@review');
    Route::get('review/{id}', 'UsulanController@detailReview');

    Route::get('entry/get-data-entry/{id}', 'EntryController@getDataEntry');
    Route::resource('entry', 'EntryController');
});

Route::group(['prefix' => 'kl', 'namespace' => 'Kl'], function () {
    Route::resource('kldata', 'KldataController');
    Route::get('review', 'KlController@review');
    Route::get('pemda/{pemda_id}', 'KlController@pemda');
    Route::get('sinkronisasi/{sinkronisasi_id}', 'KlController@sinkronisasi');
});

Route::group(['prefix' => 'bappenas', 'namespace' => 'Bappenas'], function () {
    Route::get('verifikasi', 'BappenasController@verivikasi');
    Route::post('pemda', 'BappenasController@pemda');
    Route::get('review', 'BappenasController@review');
    Route::get('sinkronisasi/{sinkronisasi_id}', 'BappenasController@sinkronisasi');
});
