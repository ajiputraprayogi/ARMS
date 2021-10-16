<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class dashboardController extends Controller
{
    //=====================================================================
    public function index()
    {
        $risiko_terkendali = DB::table('resiko_teridentifikasi')
        ->select(DB::raw('count(pengendalian_risiko.id) as jumlah_pengendalian'))
        ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
        ->having('jumlah_pengendalian', '>' , 0)
        ->groupby('resiko_teridentifikasi.id')
        ->get();

        $populasi_risiko = DB::table('resiko_teridentifikasi')
        ->count();

        $sebaran_risiko = DB::table('besaran_resiko')
        ->select(DB::raw('besaran_resiko.kode_warna,count(resiko_teridentifikasi.id) as total,besaran_resiko.level'))
        ->leftjoin('resiko_teridentifikasi','besaran_resiko.nilai','=','resiko_teridentifikasi.besaran_akhir')
        ->groupby('besaran_resiko.level')
        ->get();

        $usulan_risiko_baru = DB::table('resiko_teridentifikasi')->where('status_persetujuan','diajukan')
        ->count();

        $risiko_tidak_terkendali = DB::table('resiko_teridentifikasi')
        ->select(DB::raw('count(pengendalian_risiko.id) as jumlah_pengendalian'))
        ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
        ->having('jumlah_pengendalian', '=' , 0)
        ->groupby('resiko_teridentifikasi.id')
        ->get();

        $realisasi_pengendalian = DB::table('pengendalian_risiko')
        ->select(DB::raw('count(pengendalian_risiko.id) as total,pengendalian_risiko.status_pelaksanaan'))
        ->groupby('pengendalian_risiko.status_pelaksanaan')
        ->get();

        $rencana_pengendalian = DB::table('pengendalian_risiko')->count();
        return view('backend.index',compact('rencana_pengendalian','realisasi_pengendalian','sebaran_risiko','risiko_terkendali','risiko_tidak_terkendali','populasi_risiko','usulan_risiko_baru'));
    }
}
