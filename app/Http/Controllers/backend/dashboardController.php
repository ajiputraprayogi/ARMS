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
        $populasi_risiko = DB::table('resiko_teridentifikasi')
        ->count();

        $risiko_termitigasi = DB::table('resiko_teridentifikasi')
        ->select(DB::raw('resiko_teridentifikasi.*,pengendalian_risiko.status_pelaksanaan'))
        ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
        ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
        ->count();

        $penyebab_teridentifikasi = DB::table('analisa_masalah')->count();

        $penyebab_termitigasi = DB::table('analisa_masalah')
        ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
        ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
        ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
        ->count();

        $pengendalian_risiko = DB::table('pengendalian_risiko')->count();

        $pengendalian_risiko_termitigasi = DB::table('pengendalian_risiko')->where('status_pelaksanaan','=','Selesai dilaksanakan')->count();
        
        $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')->count();
        $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
        ->groupby('pencatatan_peristiwa_resiko.resiko_id')
        ->count();
        return view('backend.dashboard.index',compact('risiko_peristiwa_risiko','kejadian_peristiwa_risiko','pengendalian_risiko','pengendalian_risiko_termitigasi','populasi_risiko','risiko_termitigasi','penyebab_teridentifikasi','penyebab_termitigasi'));
    }

    
    //=====================================================================
    public function oldindex()
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

        $penurunan_besaran_risiko = DB::table('resiko_teridentifikasi')
        ->select(DB::raw('resiko_teridentifikasi.*,pelaksanaan_manajemen_risiko.selera_risiko'))
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
        ->get();

        $pencatatan_peristiwa_resiko = DB::table('pencatatan_peristiwa_resiko')->count();
        return view('backend.dashboard.index',compact('pencatatan_peristiwa_resiko','penurunan_besaran_risiko','rencana_pengendalian','realisasi_pengendalian','sebaran_risiko','risiko_terkendali','risiko_tidak_terkendali','populasi_risiko','usulan_risiko_baru'));
    }
}
