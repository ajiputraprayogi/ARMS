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
    Route::get('cari_departemen', 'backend\DepartemenController@cari_departemen');

    Route::resource('klasifikasisubunsurspip', 'backend\KlasifikasisubunsurspipController');
    Route::get('data-klasifikasisubunsurspip', 'backend\KlasifikasisubunsurspipController@listdata');

    // Basis Data
    Route::resource('konteks', 'backend\KonteksController');
    Route::get('data-konteks', 'backend\KonteksController@listdata');

    Route::resource('pemangkukepentingan', 'backend\PemangkukepentinganController');
    Route::get('data-pemangkukepentingan', 'backend\PemangkukepentinganController@listdata');
});
Route::group(['middleware' => ['auth','checkRole:Superadmin']],function(){
    Route::get('/home', 'HomeController@index')->name('home');
});
