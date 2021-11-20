<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\resikoteridentifikasi;
use App\kategoriresiko;
use App\metode;
use App\selectedmetodespip;
use DataTables;
use DB;
use Auth;
use Carbon\Carbon;
// use Alfa6661\AutoNumber\AutoNumberTrait;

class ResikoteridentifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        $infosearch ='';
        $active_departemen = 'Semua Departemen';
        $active_tahun = 'Semua Tahun';
        $active_konteks = 'Semua Konteks';
        $active_status = 'Semua Status';
        $active_kategori = 'Semua Kategori';

        if($request->has('departemen')){
            if($request->departemen!='Semua Departemen'){
                $active_departemen = $request->departemen;
            }else{
                $active_departemen = 'Semua Departemen';
            }
        }
        if($request->has('tahun')){
            if($request->tahun!='Semua Tahun'){
                $active_tahun = $request->tahun;
            }else{
                $active_tahun = 'Semua Tahun';
            }
        }
        if($request->has('konteks')){
            if($request->konteks!='Semua Konteks'){
                $active_konteks = $request->konteks;
            }else{
                $active_konteks = 'Semua Konteks';
            }
        }
        if($request->has('status')){
            if($request->status!='Semua Status'){
                $active_status = $request->status;
            }else{
                $active_status = 'Semua Status';
            }
        }
        if($request->has('kategori')){
            if($request->kategori!='Semua Kategori'){
                $active_kategori = $request->kategori;
            }else{
                $active_kategori = 'Semua Kategori';
            }
        }
        $departemen = DB::table('resiko_teridentifikasi')
                        ->select('pelaksanaan_manajemen_risiko.faktur','departemen.*','departemen.nama')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
        $tahun = DB::table('pelaksanaan_manajemen_risiko')
        ->groupby('priode_penerapan')
        ->get();

        if($active_departemen!='Semua Departemen'){
            $konteks = DB::table('resiko_teridentifikasi')
                            ->select('konteks.*')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                            ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
                            ->where('pelaksanaan_manajemen_risiko.faktur','=',$active_departemen)
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->groupby('konteks.id')
                            ->orderby('konteks.nama','asc')
                            ->get();
        }else{
            $konteks = DB::table('resiko_teridentifikasi')
                            ->select('konteks.*')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                            ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
                            // ->where('pelaksanaan_manajemen_risiko.faktur','=',$active_departemen)
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->groupby('konteks.id')
                            ->orderby('konteks.nama','asc')
                            ->get();
        }

        $status = DB::table('resiko_teridentifikasi')
                        ->select('resiko_teridentifikasi.*')
                        ->groupby('status')
                        ->orderby('status','asc')
                        ->get();

        $kategori = DB::table('resiko_teridentifikasi')
                        ->select('kategori_resiko.*')
                        ->leftjoin('kategori_resiko','kategori_resiko.id','=','resiko_teridentifikasi.id_kategori')
                        ->groupby('kategori_resiko.id')
                        ->orderby('kategori_resiko.resiko')
                        ->get();

        if($active_departemen!='Semua Departemen'){
            if($active_tahun!='Semua Tahun'){
                if($active_konteks!='Semua Konteks'){
                    if($active_status!='Semua Status'){
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['konteks.id','=',$active_konteks],['resiko_teridentifikasi.status','=',$active_status],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['konteks.id','=',$active_konteks],['resiko_teridentifikasi.status','=',$active_status]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['konteks.id','=',$active_konteks],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['konteks.id','=',$active_konteks]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }
                }else{
                    if($active_status!='Semua Status'){
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.status','=',$active_status],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.status','=',$active_status]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }
                }
            }else{
                if($active_konteks!='Semua Konteks'){
                    if($active_status!='Semua Status'){
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['konteks.id','=',$active_konteks],['resiko_teridentifikasi.status','=',$active_status],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['konteks.id','=',$active_konteks],['resiko_teridentifikasi.status','=',$active_status]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['konteks.id','=',$active_konteks],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['konteks.id','=',$active_konteks]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }
                }else{
                    if($active_status!='Semua Status'){
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['resiko_teridentifikasi.status','=',$active_status],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['resiko_teridentifikasi.status','=',$active_status]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }
                }
            }
        }else{
            if($active_tahun!='Semua Tahun'){
                if($active_konteks!='Semua Konteks'){
                    if($active_status!='Semua Status'){
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['konteks.id','=',$active_konteks],['resiko_teridentifikasi.status','=',$active_status],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['konteks.id','=',$active_konteks],['resiko_teridentifikasi.status','=',$active_status]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['konteks.id','=',$active_konteks],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['konteks.id','=',$active_konteks]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }
                }else{
                    if($active_status!='Semua Status'){
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.status','=',$active_status],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.status','=',$active_status]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }
                }
            }else{
                if($active_konteks!='Semua Konteks'){
                    if($active_status!='Semua Status'){
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['konteks.id',$active_konteks],['resiko_teridentifikasi.status','=',$active_status],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['konteks.id',$active_konteks],['resiko_teridentifikasi.status','=',$active_status]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['konteks.id',$active_konteks],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['konteks.id',$active_konteks]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }
                }else{
                    if($active_status!='Semua Status'){
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['resiko_teridentifikasi.status','=',$active_status],['resiko_teridentifikasi.id_kategori','=',$active_kategori]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['resiko_teridentifikasi.status','=',$active_status]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_kategori!='Semua Kategori'){
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->where([['resiko_teridentifikasi.id_kategori','=',$active_kategori],['pelaksanaan_manajemen_risiko.id_departemen',$id_atasan]])
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('resiko_teridentifikasi')
                            ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
                            ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
                            ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
                            ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
                            ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
                            ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->orderby('id')
                            ->get();
                        }
                    }
                }
            }
        }
        // $data = resikoteridentifikasi::all();
        return view('backend.resiko.resiko_teridentifikasi.index',compact('data','active_departemen','active_tahun','active_konteks','active_status','active_kategori','departemen','tahun','konteks','status','kategori'));
    }

    public function listdata(){
        return Datatables::of(DB::table('resiko_teridentifikasi')
        ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
        ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
        ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
        ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
        ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
        ->orderby('id')
        ->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategoriresiko::all();
        $spip = metode::all();
        $hariini = date('d-m-Y');
        $auth= Auth::user()->id;
        $pengaju = DB::table('users')->where('id', '!=', $auth)->get();
        // dd($pengaju);
        return view('backend.resiko.resiko_teridentifikasi.add',['data'=>$kategori, 'data2'=>$spip, 'hariini'=>$hariini, 'orang'=>$pengaju]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function carikat($id)
    {
        $carikode = DB::table('resiko_teridentifikasi')
        ->where('full_kode','like','%'.$id.'-%')
        ->max('full_kode');

        if(!$carikode){
            $finalkode = $id.'.1';
        }else{
            $getnumber = explode('.',$carikode);
            $jumlah = count($getnumber);
            $newno = $getnumber[$jumlah]+1;
            $finalkode = $id.'.'.$newno;
        }
        return response()->json($finalkode);
    }
    public function store(Request $request)
    {
        // $request->validate([
        //     'pernyataan_' => 'required',
        // ]);
        $warna = "#BF00FF";
        $status= "Belum memenuhi selera risiko";
        $baw = "0";
        $bak = "0";
        $cari = $request->kategori;
        // $kodekat = DB::table('kategori_resiko')->select('kode as kodekat')->where('id', '=', $cari)->get();
        // $ex = explode(":" , $kodekat);
        // $ex2 = explode("[{}]" , $ex);
        // foreach ($ex as $key => $dataa) {
        //     echo $dataa;
        // }
        // dd($ex2);
        $coba = $request->kode_konteks.".".$request->kodedep.".".$request->kategori;
        $kode= resikoteridentifikasi::where('kode_risiko', $coba )->max('number')+1;
        $full_code= $coba.".".$kode;
        // $pengajuan = $request->tanggal_pengajuan->format('Y-m-d');
        // $persetujuan = $request->tanggal_persetujuan->format('Y-m-d');
        // dd($full_code);
        $insert_resiko = resikoteridentifikasi::create([
            'faktur'=>$request->faktur,
            'pr' => $warna,
            'pr_akhir' => $warna,
            'kode_risiko'=>$coba,
            'number'=>$kode,
            'full_kode'=>$full_code,
            'id_departmen' => $request->id_dep,
            'kode_departemen'=> $request->kodedep,
            'departmen_pemilik_resiko'=> $request->namadep,
            'periode_penerapan'=> $request->tahun,
            'id_jenis_konteks'=> $request->id_jenis_konteks,
            'id_konteks'=> $request->id_konteks,
            'konteks'=> $request->namakonteks,
            'kode_konteks'=> $request->kode_konteks,
            'pernyataan_risiko'=> $request->pernyataan,
            'id_kategori'=>$request->kategori,
            'kategori_risiko'=> $request->kategori,
            'uraian_dampak'=> $request->dampak,
            'metode_spip'=> 1,
            'status_persetujuan'=> $request->pengajuan,
            'diajukan_oleh'=> $request->diajukan,
            'diajukan_tanggal'=> Carbon::createFromFormat('d-m-Y',$request->tanggal_pengajuan)->format('Y-m-d'),
            'persetujuan_oleh'=> $request->disetujui_oleh ? $request->disetujui_oleh : '',
            'tanggal_persetujua'=> $request->tanggal_persetujuan ? Carbon::createFromFormat('d-m-Y',$request->tanggal_persetujuan)->format('Y-m-d') : '',
            // 'keterangan'=> $request->keterangan,
            'besaran_awal' => $baw,
            'besaran_akhir'=> $bak,
            'status' => $status
        ]);

        foreach ($request->metode as $metode){
            selectedmetodespip::create([
                'id_resiko_teridentifikasi'  => $insert_resiko->id,
                'id_metode_spip' => $metode
            ]);
        }

        return redirect('resiko-teridentifikasi')->with('status','Berhasil menyimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $deviasi = $res->besaran_akhir - $res->besaran_awal;
        $kategori = kategoriresiko::get();
        $spip = metode::all();
        $res = DB::table('resiko_teridentifikasi')
        ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat','metode_pencapaian_tujuan.id as idmet','metode_pencapaian_tujuan.metode as metod','konteks.id as idkonteks','konteks.kode as kodekonteks','konteks.nama as namakonteks','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.selera_risiko','departemen.nama as namadep','pelaksanaan_manajemen_risiko.priode_penerapan')
        ->leftjoin('pelaksanaan_manajemen_risiko','resiko_teridentifikasi.faktur','=','pelaksanaan_manajemen_risiko.faktur')
        ->leftjoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        ->leftjoin('konteks','resiko_teridentifikasi.id_konteks','=','konteks.id')
        ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
        ->join('metode_pencapaian_tujuan', 'resiko_teridentifikasi.metode_spip', '=', 'metode_pencapaian_tujuan.id')
        ->where('resiko_teridentifikasi.id','=', $id)->get();
        // $pengajuan = Carbon::createFromFormat('Y-m-d', $res->diajukan_tanggal)->format('d-m-Y');
        // $pengajuan = Carbon::parse(DB::table('resiko_teridentifikasi')->select('resiko_teridentifikasi.diajukan_tanggal')->where('id','=', $id)->get())->format('d-m-Y');
        // dd($res);

        $selectedspip = selectedmetodespip::where('id_resiko_teridentifikasi', '=', $id)->with('metode')->get();

        // dd($selectedspip);

        return view('backend.resiko.resiko_teridentifikasi.edit',['data'=>$kategori, 'data2'=>$spip, 'res'=>$res, 'selectedspip' => $selectedspip]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'nama' => 'required',
        // ]);
        $coba = $request->kode_konteks.".".$request->kodedep.".".$request->kodekat;
        $kode= resikoteridentifikasi::where('kode_risiko', $coba )->max('number')+1;
        $full_code= $coba.".".$kode;
        $data2 = DB::table('resiko_teridentifikasi')->where('id', $id)->get();
        // $data = $request->idkat;
        // dd($full_code);
        // $ui="21sadasd";

        resikoteridentifikasi::find($id)->update([
            'faktur'=>$request->faktur,
            'kode_risiko'=>$coba,
            'number'=>$kode,
            'full_kode'=>$full_code,
            'id_departmen' => $request->id_dep,
            'kode_departemen'=> $request->kodedep,
            'departmen_pemilik_resiko'=> $request->namadep,
            'periode_penerapan'=> $request->tahun,
            'id_jenis_konteks'=> $request->id_jenis_konteks,
            'id_konteks'=> $request->id_konteks,
            'konteks'=> $request->namakonteks,
            'kode_konteks'=> $request->kode_konteks,
            'pernyataan_risiko'=> $request->pernyataan,
            'id_kategori'=>$request->kategori,
            'kategori_risiko'=> $request->kodekat,
            'uraian_dampak'=> $request->dampak,
            'metode_spip'=> 1,
            'status_persetujuan'=> $request->pengajuan,
            'diajukan_oleh'=> $request->diajukan,
            'diajukan_tanggal'=> Carbon::createFromFormat('d-m-Y',$request->tanggal_pengajuan)->format('Y-m-d'),
            'persetujuan_oleh'=> $request->disetujui_oleh ? $request->disetujui_oleh : '',
            'tanggal_persetujua'=> $request->tanggal_persetujuan ? Carbon::createFromFormat('d-m-Y',$request->tanggal_persetujuan)->format('Y-m-d') : '',
            // 'keterangan'=> $request->keterangan,
            'status' => $request->status
        ]);

        selectedmetodespip::where('id_resiko_teridentifikasi', '=', $id)->delete();

        foreach ($request->metode as $metode){
            selectedmetodespip::create([
                'id_resiko_teridentifikasi'  => $id,
                'id_metode_spip' => $metode
            ]);
        }

        return redirect('resiko-teridentifikasi')->with('status','Berhasil menyimpan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        selectedmetodespip::where('id_resiko_teridentifikasi', '=', $id)->delete();
        resikoteridentifikasi::destroy($id);
    }

    //----------------------------------cari data departmen-----------------------------------------
    public function caridepartmen(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('pelaksanaan_manajemen_risiko')
                    ->select('pelaksanaan_manajemen_risiko.id','pelaksanaan_manajemen_risiko.faktur', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep')
                    ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
                    // ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
                    ->where('departemen.kode','like','%'.$cari.'%')
                    ->orwhere('departemen.nama','like','%'.$cari.'%')
                    ->get();

            return response()->json($data);
        }
    }
    public function hasilcaridepartmen($id,$faktur){
        // $datad = DB::table('pelaksanaan_manajemen_risiko')
        // ->select('pelaksanaan_manajemen_risiko.id', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep')
        // ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
        // ->where('pelaksanaan_manajemen_risiko.id',$id)
        // ->get();
        $data =  DB::table('pelaksanaan_manajemen_risiko')
        ->select('pelaksanaan_manajemen_risiko.id','pelaksanaan_manajemen_risiko.faktur', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','pelaksanaan_manajemen_risiko.selera_risiko','departemen.kode as kodedep','departemen.nama as namadep','konteks.id as idk','konteks.kode as kodek')
        ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
        ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
        ->where('pelaksanaan_manajemen_risiko.id',$id)
        ->get();

        $resiko = DB::table('konteks')
        ->where('faktur_konteks',$faktur)
        ->get();
        $print=[
            'detail'=>$data,
            'resiko'=>$resiko
        ];
        return response()->json($print);
    }
    //--------------------------------cari data konteks --------------------------------------------
    public function carikonteks(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('konteks')
                    ->select('konteks.*','jenis_konteks.id as id_konteks','jenis_konteks.konteks as namakonteks')
                    ->leftjoin('jenis_konteks', 'konteks.id_konteks', '=', 'jenis_konteks.id')
                    ->where('jenis_konteks.konteks','like','%'.$cari.'%')
                    ->orwhere('konteks.kode','like','%'.$cari.'%')
                    ->get();

            return response()->json($data);
        }
    }
    public function hasilcarikonteks($id){
        $data = DB::table('konteks')
                    ->leftjoin('resiko_teridentifikasi','konteks.id','=','resiko_teridentifikasi.id_konteks')
                    ->select('resiko_teridentifikasi.full_kode','konteks.id as idk','konteks.kode as kode_konteks','jenis_konteks.id as id_konteks','jenis_konteks.konteks as namakonteks')
                    ->leftjoin('jenis_konteks', 'konteks.id_konteks', '=', 'jenis_konteks.id')
                    ->where('konteks.id','=', $id)
                    ->get();

            return response()->json($data);
    }

    // ========================== Filter =============================
    public function caridepartmenfilter(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('pelaksanaan_manajemen_risiko')
                    ->select('pelaksanaan_manajemen_risiko.id','pelaksanaan_manajemen_risiko.faktur', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep')
                    ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
                    // ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
                    ->where('departemen.kode','like','%'.$cari.'%')
                    ->orwhere('departemen.nama','like','%'.$cari.'%')
                    ->get();

            return response()->json($data);
        }
    }
    public function hasilcaridepartmenfilter($id){
        // $datad = DB::table('pelaksanaan_manajemen_risiko')
        // ->select('pelaksanaan_manajemen_risiko.id', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep')
        // ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
        // ->where('pelaksanaan_manajemen_risiko.id',$id)
        // ->get();
        $data =  DB::table('pelaksanaan_manajemen_risiko')
        ->select('pelaksanaan_manajemen_risiko.id','pelaksanaan_manajemen_risiko.faktur', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','pelaksanaan_manajemen_risiko.selera_risiko','departemen.kode as kodedep','departemen.nama as namadep','konteks.id as idk','konteks.kode as kodek')
        ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
        ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
        ->where('pelaksanaan_manajemen_risiko.id',$id)
        ->get();

        $resiko = DB::table('konteks')
        ->where('faktur_konteks',$id)
        ->groupby('konteks.id')
        ->get();
        $print=[
            'detail'=>$data,
            'resiko'=>$resiko
        ];
        return response()->json($print);
    }
}
