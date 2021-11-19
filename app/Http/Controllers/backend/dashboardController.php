<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use DB;
use Carbon\Carbon;
use Auth;

class dashboardController extends Controller
{
    //=====================================================================
    public function index(Request $request)
    {
        $user = $request->getClientIp();
        $waktu = Carbon::now();
        // ===================================
        $id = Auth::user()->id_departemen;
        $id_dep=[];
        $id_atasan = [];
        $i_limit=1;
        array_push($id_atasan,$id);
        //dd(count($id_atasan));

        for ($i=0; $i <$i_limit ; $i++) { 
            for ($j=0; $j < count($id_atasan) ; $j++) { 
                $data = DB::table('departemen')->where('id_atasan',$id_atasan[$j])->get();
                if(count($data)>0){
                    foreach($data as $row){
                        array_push($id_atasan,$row->id);
                    }
                    $i_limit++;
                }else{
                    $i_limit=$i;
                }
            }
        }
        // dd($id_atasan);
        // return $id_atasan;
        // ===================================
       $hasilcari = false;
        if ($request->has('departemen')) {
            if($request->departemen!='semua'){
                $populasi_risiko = DB::table('resiko_teridentifikasi')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                // $populasi_risiko = DB::table('resiko_teridentifikasi')
                // ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                // ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                // ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)->count();

                // =========================== Jika Dibutuhkan ==============================
                // $risiko_termitigasi = DB::table('resiko_teridentifikasi')
                // ->select(DB::raw('resiko_teridentifikasi.*,pengendalian_risiko.status_pelaksanaan'))
                // ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
                // ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                // ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                // ->count();
                // ==========================================================================
                $risiko_termitigasi = DB::table('pengendalian_risiko')
                ->select('pengendalian_risiko.*','resiko_teridentifikasi.full_kode')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->orderby('pengendalian_risiko.id','desc')
                ->count();
                // $risiko_termitigasi = DB::table('resiko_teridentifikasi')
                // ->select(DB::raw('resiko_teridentifikasi.*,pengendalian_risiko.status_pelaksanaan'))
                // ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
                // ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                // ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)->count();
                $penyebab_teridentifikasi = DB::table('analisa_masalah')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                // $penyebab_teridentifikasi = DB::table('analisa_masalah')
                // ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                // ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
                // ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                // ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                // ->count();
                $penyebab_termitigasi = DB::table('analisa_masalah')
                ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                // $penyebab_termitigasi = DB::table('analisa_masalah')
                // ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                // ->where('pengendalian_risiko.id_departemen',$request->departemen)
                // ->count();
                $pengendalian_risiko = DB::table('pengendalian_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                // $pengendalian_risiko = DB::table('pengendalian_risiko')->where('id_departemen',$request->departemen)->count();
                $pengendalian_risiko_termitigasi = DB::table('pengendalian_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('status_pelaksanaan','=','Selesai dilaksanakan')
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                // $pengendalian_risiko_termitigasi = DB::table('pengendalian_risiko')->where('id_departemen',$request->departemen)->where('status_pelaksanaan','=','Selesai dilaksanakan')->count();
                $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                // $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')->where('departemen_id',$request->departemen)->count();
                $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->groupBy('resiko_id')
                ->get();
                // $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                // ->where('departemen_id',$request->departemen)
                // ->groupBy('resiko_id')
                // ->get();
                $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->groupBy('pemicu')
                ->get();
                // $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                // ->where('departemen_id',$request->departemen)
                // ->groupBy('pemicu')
                // ->get(); 
                $hasilcari = true;
            }else{
                $populasi_risiko = DB::table('resiko_teridentifikasi')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->count();
                $risiko_termitigasi = DB::table('pengendalian_risiko')
                ->select('pengendalian_risiko.*','resiko_teridentifikasi.full_kode')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                ->orderby('pengendalian_risiko.id','desc')
                ->count();
                // $risiko_termitigasi = DB::table('resiko_teridentifikasi')
                // ->select(DB::raw('resiko_teridentifikasi.*,pengendalian_risiko.status_pelaksanaan'))
                // ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
                // ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                // ->count();
                $penyebab_teridentifikasi = DB::table('analisa_masalah')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->count();
                // dd($penyebab_teridentifikasi);
                $penyebab_termitigasi = DB::table('analisa_masalah')
                ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                ->count();
                $pengendalian_risiko = DB::table('pengendalian_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->count();
                // dd($pengendalian_risiko);
                $pengendalian_risiko_termitigasi = DB::table('pengendalian_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('status_pelaksanaan','=','Selesai dilaksanakan')
                ->count();
                $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->count();
                $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->groupBy('resiko_id')
                ->get();
                $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->groupBy('pemicu')
                ->get();
                $hasilcari = true;
            }
        }else{
            $populasi_risiko = DB::table('resiko_teridentifikasi')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->count();
            $risiko_termitigasi = DB::table('pengendalian_risiko')
            ->select('pengendalian_risiko.*','resiko_teridentifikasi.full_kode')
            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
            ->orderby('pengendalian_risiko.id','desc')
            ->count();
            // $risiko_termitigasi = DB::table('resiko_teridentifikasi')
            // ->select(DB::raw('resiko_teridentifikasi.*,pengendalian_risiko.status_pelaksanaan'))
            // ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
            // ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
            // ->count();
            $penyebab_teridentifikasi = DB::table('analisa_masalah')
            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->count();
            // dd($penyebab_teridentifikasi);
            $penyebab_termitigasi = DB::table('analisa_masalah')
            ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
            ->count();
            $pengendalian_risiko = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->count();
            // dd($pengendalian_risiko);
            $pengendalian_risiko_termitigasi = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('status_pelaksanaan','=','Selesai dilaksanakan')
            ->count();
            $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->count();
            $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->groupBy('resiko_id')
            ->get();
            $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->groupBy('pemicu')
            ->get();
        }
        $data_departemen = DB::table('departemen')
        ->select('departemen.id as id','pelaksanaan_manajemen_risiko.*','departemen.nama')
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
        ->groupby('departemen.id')
        ->orderby('pelaksanaan_manajemen_risiko.id','asc')
        ->get();
        return view('backend.dashboard.index',compact('waktu','user','hasilcari','data_departemen','penyebab_peristiwa_risiko','risiko_peristiwa_risiko','kejadian_peristiwa_risiko','pengendalian_risiko','pengendalian_risiko_termitigasi','populasi_risiko','risiko_termitigasi','penyebab_teridentifikasi','penyebab_termitigasi'));
    }

    //=====================================================================
    public function risiko(Request $request)
    {
        // ===================================
        $id = Auth::user()->id_departemen;
        $id_dep=[];
        $id_atasan = [];
        $i_limit=1;
        array_push($id_atasan,$id);
        //dd(count($id_atasan));

        for ($i=0; $i <$i_limit ; $i++) { 
            for ($j=0; $j < count($id_atasan) ; $j++) { 
                $data = DB::table('departemen')->where('id_atasan',$id_atasan[$j])->get();
                if(count($data)>0){
                    foreach($data as $row){
                        array_push($id_atasan,$row->id);
                    }
                    $i_limit++;
                }else{
                    $i_limit=$i;
                }
            }
        }
        // dd($id_atasan);
        // return $id_atasan;
        // ===================================
        if ($request->has('departemen')) {
            if($request->departemen!='semua'){
                $populasi_risiko = DB::table('resiko_teridentifikasi')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                $usulan_risiko_baru = DB::table('resiko_teridentifikasi')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->where('status_persetujuan','Diajukan')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                $selera_risiko = DB::table('resiko_teridentifikasi')
                ->select(DB::raw('resiko_teridentifikasi.*,pelaksanaan_manajemen_risiko.selera_risiko'))
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->get();
                $risiko_termitigasi = DB::table('pengendalian_risiko')
                ->select('pengendalian_risiko.*','resiko_teridentifikasi.full_kode')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                ->orderby('pengendalian_risiko.id','desc')
                ->count();
                // $risiko_termitigasi = DB::table('resiko_teridentifikasi')
                // ->select(DB::raw('resiko_teridentifikasi.*,pengendalian_risiko.status_pelaksanaan'))
                // ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
                // ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                // ->count();
                $resiko_deparetemen = DB::table('departemen')
                ->select(DB::raw('departemen.*,count(resiko_teridentifikasi.id) as total'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id_departmen','=','departemen.id')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                // ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->groupby('departemen.id')
                ->get();
                // dd($resiko_deparetemen);
            }else{
                $populasi_risiko = DB::table('resiko_teridentifikasi')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->count();
                $usulan_risiko_baru = DB::table('resiko_teridentifikasi')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->where('status_persetujuan','Diajukan')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->count();
                $selera_risiko = DB::table('resiko_teridentifikasi')
                ->select(DB::raw('resiko_teridentifikasi.*,pelaksanaan_manajemen_risiko.selera_risiko'))
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->get();
                $risiko_termitigasi = DB::table('pengendalian_risiko')
                ->select('pengendalian_risiko.*','resiko_teridentifikasi.full_kode')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                ->orderby('pengendalian_risiko.id','desc')
                ->count();
                // $risiko_termitigasi = DB::table('resiko_teridentifikasi')
                // ->select(DB::raw('resiko_teridentifikasi.*,pengendalian_risiko.status_pelaksanaan'))
                // ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
                // ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                // ->count();
                $resiko_deparetemen = DB::table('departemen')
                ->select(DB::raw('departemen.*,count(resiko_teridentifikasi.id) as total'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id_departmen','=','departemen.id')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->groupby('departemen.id')
                ->get();
                // dd($resiko_deparetemen);
            }
        }else{
            $populasi_risiko = DB::table('resiko_teridentifikasi')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->count();
            $usulan_risiko_baru = DB::table('resiko_teridentifikasi')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->where('status_persetujuan','Diajukan')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->count();
            $selera_risiko = DB::table('resiko_teridentifikasi')
            ->select(DB::raw('resiko_teridentifikasi.*,pelaksanaan_manajemen_risiko.selera_risiko'))
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->get();
            $risiko_termitigasi = DB::table('pengendalian_risiko')
            ->select('pengendalian_risiko.*','resiko_teridentifikasi.full_kode')
            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
            ->orderby('pengendalian_risiko.id','desc')
            ->count();
            // $risiko_termitigasi = DB::table('resiko_teridentifikasi')
            // ->select(DB::raw('resiko_teridentifikasi.*,pengendalian_risiko.status_pelaksanaan'))
            // ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
            // ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
            // ->count();
            $resiko_deparetemen = DB::table('departemen')
            ->select(DB::raw('departemen.*,count(resiko_teridentifikasi.id) as total'))
            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id_departmen','=','departemen.id')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->groupby('departemen.id')
            ->get();
            // dd($resiko_deparetemen);
        }

        $peta_risiko = DB::table('kriteria_probabilitas')->orderby('nilai','desc')->get();
        $skor_dampak = DB::table('kriteria_dampak')->orderby('nilai','asc')->get();
        $data_departemen = DB::table('departemen')
        ->select('departemen.id as id','pelaksanaan_manajemen_risiko.*','departemen.nama')
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
        ->groupby('departemen.id')
        ->orderby('pelaksanaan_manajemen_risiko.id','asc')
        ->get();
        return view('backend.dashboard.risiko',compact('skor_dampak','peta_risiko','resiko_deparetemen','risiko_termitigasi','selera_risiko','data_departemen','populasi_risiko','usulan_risiko_baru'));
    }

    //=====================================================================
    public function penyebab(Request $request)
    {
        // ===================================
        $id = Auth::user()->id_departemen;
        $id_dep=[];
        $id_atasan = [];
        $i_limit=1;
        array_push($id_atasan,$id);
        //dd(count($id_atasan));

        for ($i=0; $i <$i_limit ; $i++) { 
            for ($j=0; $j < count($id_atasan) ; $j++) { 
                $data = DB::table('departemen')->where('id_atasan',$id_atasan[$j])->get();
                if(count($data)>0){
                    foreach($data as $row){
                        array_push($id_atasan,$row->id);
                    }
                    $i_limit++;
                }else{
                    $i_limit=$i;
                }
            }
        }
        // dd($id_atasan);
        // return $id_atasan;
        // ===================================
        if ($request->has('departemen')) {
            if($request->departemen!='semua'){
                // $penyebab_teridentifikasi = DB::table('analisa_masalah')
                // ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                // ->where('pengendalian_risiko.id_departemen',$request->departemen)
                // ->count();
                $penyebab_teridentifikasi = DB::table('analisa_masalah')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                // $penyebab_termitigasi = DB::table('analisa_masalah')
                // ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                // ->where('pengendalian_risiko.id_departemen',$request->departemen)
                // ->count();
                $penyebab_termitigasi = DB::table('analisa_masalah')
                ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
            }else{
                // $penyebab_teridentifikasi = DB::table('analisa_masalah')
                // ->count();
                $penyebab_teridentifikasi = DB::table('analisa_masalah')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                // ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                // $penyebab_termitigasi = DB::table('analisa_masalah')
                // ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                // ->count();
                $penyebab_termitigasi = DB::table('analisa_masalah')
                ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                // ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
            }
        }else{
            // $penyebab_teridentifikasi = DB::table('analisa_masalah')
            // ->count();
            $penyebab_teridentifikasi = DB::table('analisa_masalah')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                // ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
            // $penyebab_termitigasi = DB::table('analisa_masalah')
            // ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
            // ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
            // ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
            // ->count();
            $penyebab_termitigasi = DB::table('analisa_masalah')
                ->select(DB::raw('analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                // ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
        }
        $penyebab = DB::table('penyebab')->orderby('id','desc')->get();
        // $data_departemen = DB::table('departemen')->orderby('id','desc')->get();
        $data_departemen = DB::table('departemen')
        ->select('departemen.id as id','pelaksanaan_manajemen_risiko.*','departemen.nama')
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
        ->groupby('departemen.id')
        ->orderby('pelaksanaan_manajemen_risiko.id','asc')
        ->get();
        return view('backend.dashboard.penyebab',compact('id_atasan','penyebab','penyebab_termitigasi','penyebab_teridentifikasi','data_departemen'));
    }

    //=====================================================================
    public function tindaklanjut(Request $request)
    {
        // ===================================
        $id = Auth::user()->id_departemen;
        $id_dep=[];
        $id_atasan = [];
        $i_limit=1;
        array_push($id_atasan,$id);
        //dd(count($id_atasan));

        for ($i=0; $i <$i_limit ; $i++) { 
            for ($j=0; $j < count($id_atasan) ; $j++) { 
                $data = DB::table('departemen')->where('id_atasan',$id_atasan[$j])->get();
                if(count($data)>0){
                    foreach($data as $row){
                        array_push($id_atasan,$row->id);
                    }
                    $i_limit++;
                }else{
                    $i_limit=$i;
                }
            }
        }
        // dd($id_atasan);
        // return $id_atasan;
        // ===================================
        $triwulan = $this->gettriwulan(date('m'));
        $triwulandate = $this->getrangedatetriwulan($triwulan);
        $finaldate = explode(' to ',$triwulandate);

        if ($request->has('departemen')) {
            if($request->departemen!='semua'){
                // $pengendalian_risiko = DB::table('pengendalian_risiko')->where('id_departemen',$request->departemen)->count();
                // $pengendalian_risiko_terealisasi = DB::table('pengendalian_risiko')->where('id_departemen',$request->departemen)->where('status_pelaksanaan','=','Selesai dilaksanakan')->count();
                // $pengendalian_risiko_tahun_ini = DB::table('pengendalian_risiko')->where('id_departemen',$request->departemen)->whereYear('target_waktu',date('Y'))->count();
                // $pengendalian_risiko_terlambat = DB::table('pengendalian_risiko')->where('id_departemen',$request->departemen)->where('status_pelaksanaan','=','Terlambat')->count();
                // $pengendalian_risiko_triwulan_ini = DB::table('pengendalian_risiko')->where('id_departemen',$request->departemen)->WhereBetween('target_waktu', [$finaldate[0], $finaldate[1]])->count();
                // $realisasi_pengendalian = DB::table('pengendalian_risiko')
                // ->select(DB::raw('count(pengendalian_risiko.id) as total,pengendalian_risiko.status_pelaksanaan'))
                // ->where('id_departemen',$request->departemen)
                // ->groupby('pengendalian_risiko.status_pelaksanaan')
                // ->get();
                // $pengendalian_risiko = DB::table('pengendalian_risiko')->count();
            $pengendalian_risiko = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
            ->count();
            // $pengendalian_risiko_terealisasi = DB::table('pengendalian_risiko')->where('status_pelaksanaan','=','Selesai dilaksanakan')->count();
            $pengendalian_risiko_terealisasi = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
            ->where('status_pelaksanaan','=','Selesai dilaksanakan')
            ->count();
            $pengendalian_risiko_tahun_ini = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
            ->whereYear('target_waktu',date('Y'))
            ->count();
            $pengendalian_risiko_terlambat = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
            ->where('status_pelaksanaan','=','Terlambat')
            ->count();
            $pengendalian_risiko_triwulan_ini = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
            ->WhereBetween('target_waktu', [$finaldate[0], $finaldate[1]])
            ->count();
            $realisasi_pengendalian = DB::table('pengendalian_risiko')
            ->select(DB::raw('count(pengendalian_risiko.id) as total,pengendalian_risiko.status_pelaksanaan'))
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
            ->groupby('pengendalian_risiko.status_pelaksanaan')
            ->get();
            }else{
                // $pengendalian_risiko = DB::table('pengendalian_risiko')->count();
                // $pengendalian_risiko_terealisasi = DB::table('pengendalian_risiko')->where('status_pelaksanaan','=','Selesai dilaksanakan')->count();
                // $pengendalian_risiko_tahun_ini = DB::table('pengendalian_risiko')->whereYear('target_waktu',date('Y'))->count();
                // $pengendalian_risiko_terlambat = DB::table('pengendalian_risiko')->where('status_pelaksanaan','=','Terlambat')->count();
                // $pengendalian_risiko_triwulan_ini = DB::table('pengendalian_risiko')->WhereBetween('target_waktu', [$finaldate[0], $finaldate[1]])->count();
                // $realisasi_pengendalian = DB::table('pengendalian_risiko')
                // ->select(DB::raw('count(pengendalian_risiko.id) as total,pengendalian_risiko.status_pelaksanaan'))
                // ->groupby('pengendalian_risiko.status_pelaksanaan')
                // ->get();
                // $pengendalian_risiko = DB::table('pengendalian_risiko')->count();
            $pengendalian_risiko = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->count();
            // $pengendalian_risiko_terealisasi = DB::table('pengendalian_risiko')->where('status_pelaksanaan','=','Selesai dilaksanakan')->count();
            $pengendalian_risiko_terealisasi = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('status_pelaksanaan','=','Selesai dilaksanakan')
            ->count();
            $pengendalian_risiko_tahun_ini = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->whereYear('target_waktu',date('Y'))
            ->count();
            $pengendalian_risiko_terlambat = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('status_pelaksanaan','=','Terlambat')
            ->count();
            $pengendalian_risiko_triwulan_ini = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->WhereBetween('target_waktu', [$finaldate[0], $finaldate[1]])
            ->count();
            $realisasi_pengendalian = DB::table('pengendalian_risiko')
            ->select(DB::raw('count(pengendalian_risiko.id) as total,pengendalian_risiko.status_pelaksanaan'))
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->groupby('pengendalian_risiko.status_pelaksanaan')
            ->get();
            }
        }else{
            // $pengendalian_risiko = DB::table('pengendalian_risiko')->count();
            $pengendalian_risiko = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->count();
            // $pengendalian_risiko_terealisasi = DB::table('pengendalian_risiko')->where('status_pelaksanaan','=','Selesai dilaksanakan')->count();
            $pengendalian_risiko_terealisasi = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('status_pelaksanaan','=','Selesai dilaksanakan')
            ->count();
            $pengendalian_risiko_tahun_ini = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->whereYear('target_waktu',date('Y'))
            ->count();
            $pengendalian_risiko_terlambat = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->where('status_pelaksanaan','=','Terlambat')
            ->count();
            $pengendalian_risiko_triwulan_ini = DB::table('pengendalian_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->WhereBetween('target_waktu', [$finaldate[0], $finaldate[1]])
            ->count();
            $realisasi_pengendalian = DB::table('pengendalian_risiko')
            ->select(DB::raw('count(pengendalian_risiko.id) as total,pengendalian_risiko.status_pelaksanaan'))
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->groupby('pengendalian_risiko.status_pelaksanaan')
            ->get();
        }
        // $data_departemen = DB::table('departemen')->orderby('id','desc')->get();
        $data_departemen = DB::table('departemen')
        ->select('departemen.id as id','pelaksanaan_manajemen_risiko.*','departemen.nama')
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
        ->groupby('departemen.id')
        ->orderby('pelaksanaan_manajemen_risiko.id','asc')
        ->get();
        return view('backend.dashboard.tindaklanjut',compact('realisasi_pengendalian','pengendalian_risiko_triwulan_ini','pengendalian_risiko_terlambat','pengendalian_risiko_tahun_ini','pengendalian_risiko','pengendalian_risiko_terealisasi','data_departemen'));
    }

    //=====================================================================
    public function pemantauan(Request $request)
    {
        // ===================================
        $id = Auth::user()->id_departemen;
        $id_dep=[];
        $id_atasan = [];
        $i_limit=1;
        array_push($id_atasan,$id);
        //dd(count($id_atasan));

        for ($i=0; $i <$i_limit ; $i++) { 
            for ($j=0; $j < count($id_atasan) ; $j++) { 
                $data = DB::table('departemen')->where('id_atasan',$id_atasan[$j])->get();
                if(count($data)>0){
                    foreach($data as $row){
                        array_push($id_atasan,$row->id);
                    }
                    $i_limit++;
                }else{
                    $i_limit=$i;
                }
            }
        }
        // dd($id_atasan);
        // return $id_atasan;
        // ===================================
        if ($request->has('departemen')) {
            if($request->departemen!='semua'){
                // $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')->where('departemen_id',$request->departemen)->count();
                // $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                // ->where('departemen_id',$request->departemen)
                // ->groupBy('resiko_id')
                // ->get();
                // $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                // ->where('departemen_id',$request->departemen)
                // ->groupBy('pemicu')
                // ->get();
                // $sebaran_penyebab = DB::table('penyebab')
                // ->select(DB::raw('penyebab.*,count(pencatatan_peristiwa_resiko.id) as total'))
                // ->leftjoin('pencatatan_peristiwa_resiko','pencatatan_peristiwa_resiko.penyebab_id','=','penyebab.id')
                // ->where('pencatatan_peristiwa_resiko.departemen_id',$request->departemen)
                // ->groupby('penyebab.id')
                // ->get();
                // $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')->count();
                $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->count();
                // $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                // ->groupBy('resiko_id')
                // ->get();
                $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->groupBy('resiko_id')
                ->get();
                // $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                // ->groupBy('pemicu')
                // ->get();
                $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->groupBy('pemicu')
                ->get();
                $sebaran_penyebab = DB::table('penyebab')
                ->select(DB::raw('penyebab.*,count(pencatatan_peristiwa_resiko.id) as total'))
                ->leftjoin('pencatatan_peristiwa_resiko','pencatatan_peristiwa_resiko.penyebab_id','=','penyebab.id')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->where('pelaksanaan_manajemen_risiko.id',$request->departemen)
                ->groupby('penyebab.id')
                ->get();
            }else{
                // $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')->count();
                // $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                // ->groupBy('resiko_id')
                // ->get();
                // $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                // ->groupBy('pemicu')
                // ->get();
                // $sebaran_penyebab = DB::table('penyebab')
                // ->select(DB::raw('penyebab.*,count(pencatatan_peristiwa_resiko.id) as total'))
                // ->leftjoin('pencatatan_peristiwa_resiko','pencatatan_peristiwa_resiko.penyebab_id','=','penyebab.id')
                // ->groupby('penyebab.id')
                // ->get();
                // $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')->count();
                $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->count();
                // $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                // ->groupBy('resiko_id')
                // ->get();
                $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->groupBy('resiko_id')
                ->get();
                // $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                // ->groupBy('pemicu')
                // ->get();
                $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->groupBy('pemicu')
                ->get();
                $sebaran_penyebab = DB::table('penyebab')
                ->select(DB::raw('penyebab.*,count(pencatatan_peristiwa_resiko.id) as total'))
                ->leftjoin('pencatatan_peristiwa_resiko','pencatatan_peristiwa_resiko.penyebab_id','=','penyebab.id')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->groupby('penyebab.id')
                ->get();
                }
        }else{
            // $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')->count();
            $kejadian_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->count();
            // $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
            // ->groupBy('resiko_id')
            // ->get();
            $risiko_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->groupBy('resiko_id')
            ->get();
            // $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
            // ->groupBy('pemicu')
            // ->get();
            $penyebab_peristiwa_risiko = DB::table('pencatatan_peristiwa_resiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->groupBy('pemicu')
            ->get();
            $sebaran_penyebab = DB::table('penyebab')
            ->select(DB::raw('penyebab.*,count(pencatatan_peristiwa_resiko.id) as total'))
            ->leftjoin('pencatatan_peristiwa_resiko','pencatatan_peristiwa_resiko.penyebab_id','=','penyebab.id')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->groupby('penyebab.id')
            ->get();
        }
        
        $kategori_resiko = DB::table('kategori_resiko')->get();
        // $data_departemen = DB::table('departemen')->orderby('id','desc')->get();
        $data_departemen = DB::table('departemen')
        ->select('departemen.id as id','pelaksanaan_manajemen_risiko.*','departemen.nama')
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
        ->groupby('departemen.id')
        ->orderby('pelaksanaan_manajemen_risiko.id','asc')
        ->get();
        return view('backend.dashboard.pemantauan',compact('kategori_resiko','sebaran_penyebab','penyebab_peristiwa_risiko','risiko_peristiwa_risiko','kejadian_peristiwa_risiko','data_departemen'));
    }

     //=====================================================================
     public function getrangedatetriwulan($triwulan)
     {
         if($triwulan==1){
            $start_date = date('Y').'-01-01';
            $end_date = date('Y').'-03-01';
            $date = new DateTime($end_date);
            $date->modify('last day of this month');
            $final_end_date = $date->format('Y-m-d');
            $final_date = $start_date.' to '.$final_end_date;
            return $final_date;
         }else if($triwulan==2){
            $start_date = date('Y').'-04-01';
            $end_date = date('Y').'-06-01';
            $date = new DateTime($end_date);
            $date->modify('last day of this month');
            $final_end_date = $date->format('Y-m-d');
            $final_date = $start_date.' to '.$final_end_date;
            return $final_date;
         }else if($triwulan==3){
            $start_date = date('Y').'-07-01';
            $end_date = date('Y').'-09-01';
            $date = new DateTime($end_date);
            $date->modify('last day of this month');
            $final_end_date = $date->format('Y-m-d');
            $final_date = $start_date.' to '.$final_end_date;
            return $final_date;
         }else{
            $start_date = date('Y').'-10-01';
            $end_date = date('Y').'-12-01';
            $date = new DateTime($end_date);
            $date->modify('last day of this month');
            $final_end_date = $date->format('Y-m-d');
            $final_date = $start_date.' to '.$final_end_date;
            return $final_date;
         }
     }

    //=====================================================================
    public function gettriwulan($monthnow)
    {
        if($monthnow>=1 && $monthnow<=3){
            return 1;
        }else if($monthnow>3 && $monthnow<=6){
            return 2;
        }else if($monthnow>6 && $monthnow<=9){
            return 3;
        }else{
            return 4;
        }
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
