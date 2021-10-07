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
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/reload-captcha', '\App\Http\Controllers\Auth\LoginController@reloadCaptcha');
Auth::routes();
Route::group(['middleware' => ['auth']],function(){
    Route::get('/', function () {
        return view('backend.index');
    });
    // Basis Data
    // =============== Manajemen Risiko ========================
    Route::resource('/pelaksanaan', 'backend\ManajemenresikoController');
    Route::get('/edit-pelaksanaan/{id}', 'backend\ManajemenresikoController@edit');
    Route::post('/simpan-edit-pelaksanaan/{id}', 'backend\ManajemenresikoController@update');
    Route::get('/hapus-pelaksanaan/{id}', 'backend\ManajemenresikoController@destroy');
    Route::post('simpan-edit-pemangku-pelaksanaan/{id}', 'backend\ManajemenresikoController@simpaneditpemangku');
    Route::post('simpan-edit-edit-pemangku-pelaksanaan/{id}', 'backend\ManajemenresikoController@simpanediteditpemangku');
    Route::post('simpan-edit-konteks-pelaksanaan/{id}', 'backend\ManajemenresikoController@simpaneditkonteks');
    Route::post('simpan-edit-edit-konteks-pelaksanaan/{id}', 'backend\ManajemenresikoController@simpanediteditkonteks');
    // =============== End Manajemen Risiko ====================

    // =============== Pengendalian Risiko =====================
    Route::resource('/pengendalian', 'backend\PengendalianrisikoController');
    Route::get('cari_departemen_manajemen', 'backend\PengendalianrisikoController@cari_departemen_manajemen');
    Route::get('cari_departemen_manajemen_hasil/{id}/{id_departemen}', 'backend\PengendalianrisikoController@cari_departemen_manajemen_hasil');
    Route::get('cari_risiko', 'backend\PengendalianrisikoController@cari_risiko');
    Route::get('cari_risiko_hasil/{id}', 'backend\PengendalianrisikoController@cari_risiko_hasil');

    // =============== End Pengendalian Risiko =================

    Route::resource('konteks', 'backend\KonteksController');
    Route::get('data-konteks', 'backend\KonteksController@listdata');
    
    Route::resource('pemangkukepentingan', 'backend\PemangkukepentinganController');
    Route::get('data-pemangkukepentingan', 'backend\PemangkukepentinganController@listdata');

    // Master Data
    Route::resource('probabilitas', 'backend\ProbabilitasController');
    Route::get('data-probabilitas', 'backend\ProbabilitasController@listdata');

    Route::resource('dampak', 'backend\DampakController');
    Route::get('data-dampak', 'backend\DampakController@listdata');

    Route::resource('petabesaranresiko', 'backend\PetabesaranresikoController');
    Route::get('data-petabesaranresiko', 'backend\PetabesaranresikoController@listdata');

    Route::resource('kategoririsiko', 'backend\KategoririsikoController');
    Route::get('data-kategoririsiko', 'backend\KategoririsikoController@listdata');

    Route::resource('jeniskonteks', 'backend\JeniskonteksController');
    Route::get('data-jeniskonteks', 'backend\JeniskonteksController@listdata');

    Route::resource('penyebab', 'backend\PenyebabController');
    Route::get('data-penyebab', 'backend\PenyebabController@listdata');

    Route::resource('metodepencapaiantujuanspip', 'backend\MetodepencapaiantujuanspipController');
    Route::get('data-metodepencapaiantujuanspip', 'backend\MetodepencapaiantujuanspipController@listdata');

    Route::resource('departemen', 'backend\DepartemenController');
    Route::get('data-departemen', 'backend\DepartemenController@listdata');
    Route::get('cari_departemen', 'backend\DepartemenController@cari_departemen');
    Route::get('cari_departemen_hasil/{id}', 'backend\DepartemenController@cari_departemen_hasil');



    Route::resource('klasifikasisubunsurspip', 'backend\KlasifikasisubunsurspipController');
    Route::get('data-klasifikasisubunsurspip', 'backend\KlasifikasisubunsurspipController@listdata');

    Route::resource('user', 'backend\UserController');
    Route::get('data-user', 'backend\UserController@listdata');

    Route::resource('roles', 'backend\RolesController');
    Route::get('data-roles', 'backend\RolesController@listdata');

    Route::resource('resiko-teridentifikasi', 'backend\ResikoteridentifikasiController');
    Route::get('data-resikoteridentifikasi', 'backend\ResikoteridentifikasiController@listdata');
    Route::get('/cari-departmen','backend\ResikoteridentifikasiController@caridepartmen');
    Route::get('/hasil-cari-departmen/{id}/{id_departemen}','backend\ResikoteridentifikasiController@hasilcaridepartmen');
    Route::get('/cari-konteks','backend\ResikoteridentifikasiController@carikonteks');
    Route::get('/hasil-cari-konteks/{id}','backend\ResikoteridentifikasiController@hasilcarikonteks');
    Route::get('hasil-cari-kat/{id}', 'backend\ResikoteridentifikasiController@carikat');
    //----------------------------------analisa risiko-----------------------------------------
    Route::resource('analisa-risiko', 'backend\AnalisarisikoController');
    Route::get('data-analisarisiko', 'backend\AnalisarisikoController@listdata');
    Route::get('hasil-cario/{frek}/{damp}', 'backend\AnalisarisikoController@cario');
    Route::get('hasil-cari-residu/{frek}/{damp}', 'backend\AnalisarisikoController@cariresidu');
    Route::get('/cari-analisa-departmen','backend\AnalisarisikoController@caridepartmen');
    Route::get('/hasil-cari-analisa departmen/{id}/{id_departemen}','backend\AnalisarisikoController@hasilcaridepartmen');
    Route::get('/hasil-cari-kode/{id}','backend\AnalisarisikoController@hasilcarikode');
    // Route::get('hasil-cari-kat/{id}', 'backend\AnalisarisikoController@carikat');
    //----------------------------------analisa akar-----------------------------------------
    Route::resource('analisa-akar-masalah', 'backend\AnalisaakarController');
    Route::get('data-analisaakarmasalah', 'backend\AnalisaakarController@listdata');
});
Route::group(['middleware' => ['auth']],function(){
    Route::get('/home', 'HomeController@index')->name('home');
});
