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
Auth::routes();
Route::group(['middleware' => ['auth','checkRole:Superadmin']],function(){
    Route::get('/', function () {
        return view('backend.index');
    });
    // Basis Data
    Route::resource('/pelaksanaan', 'backend\ManajemenresikoController');

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

    Route::resource('resiko-teridentifikasi', 'backend\ResikoteridentifikasiController');
    Route::get('data-resikoteridentifikasi', 'backend\ResikoteridentifikasiController@listdata');
    Route::get('/cari-departmen','backend\ResikoteridentifikasiController@caridepartmen');
    Route::get('/hasil-cari-departmen/{id}','backend\ResikoteridentifikasiController@hasilcaridepartmen');
    Route::get('/cari-konteks','backend\ResikoteridentifikasiController@carikonteks');
    Route::get('/hasil-cari-konteks/{id}','backend\ResikoteridentifikasiController@hasilcarikonteks');
    //----------------------------------analisa risiko-----------------------------------------
    Route::resource('analisa-risiko', 'backend\AnalisarisikoController');
    Route::get('data-analisarisiko', 'backend\AnalisarisikoController@listdata');
    //----------------------------------analisa akar-----------------------------------------
    Route::resource('analisa-akar-masalah', 'backend\AnalisaakarController');
    Route::get('data-analisaakarmasalah', 'backend\AnalisaakarController@listdata');


});
Route::group(['middleware' => ['auth','checkRole:Superadmin']],function(){
    Route::get('/home', 'HomeController@index')->name('home');
});
