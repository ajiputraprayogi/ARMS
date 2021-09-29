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
    return view('backend.index');
});
Route::resource('/pelaksanaan', 'backend\ManajemenresikoController');

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

Route::resource('klasifikasisubunsurspip', 'backend\KlasifikasisubunsurspipController');
Route::get('data-klasifikasisubunsurspip', 'backend\KlasifikasisubunsurspipController@listdata');

//=======================================RESIKO==============================================
Route::resource('resiko-teridentifikasi', 'backend\ResikoteridentifikasiController');
Route::get('data-resikoteridentifikasi', 'backend\ResikoteridentifikasiController@listdata');
Route::get('/cari-konteks','backend\ResikoteridentifikasiController@carikonteks');
Route::get('/hasil-cari/{id}','backend\ResikoteridentifikasiController@hasilcari');
//----------------------------------analisa risiko-----------------------------------------
Route::resource('analisa-risiko', 'backend\AnalisarisikoController');
Route::get('data-analisarisiko', 'backend\AnalisarisikoController@listdata');
//----------------------------------analisa akar-----------------------------------------
Route::resource('analisa-akar-masalah', 'backend\AnalisaakarController');
Route::get('data-analisaakarmasalah', 'backend\AnalisaakarController@listdata');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
