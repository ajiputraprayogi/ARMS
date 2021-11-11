<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pencatatanperistiwa;
use Auth;

class PencatatanperistiwaController extends Controller
{
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
        $active_kode = 'Semua Kode Risiko';
        $active_penyebab = 'Semua Kode Penyebab';
        $active_pemicu = 'Semua Pemicu Kejadian';

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
        if($request->has('kode_risiko')){
            if($request->kode_risiko!='Semua Kode Risiko'){
                $active_kode = $request->kode_risiko;
            }else{
                $active_kode = 'Semua Kode Risiko';
            }
        }
        if($request->has('kode_penyebab')){
            if($request->kode_penyebab!='Semua Kode Penyebab'){
                $active_penyebab = $request->kode_penyebab;
            }else{
                $active_penyebab = 'Semua Kode Penyebab';
            }
        }
        if($request->has('pemicu_kejadian')){
            if($request->pemicu_kejadian!='Semua Pemicu Kejadian'){
                $active_pemicu = $request->pemicu_kejadian;
            }else{
                $active_pemicu = 'Semua Pemicu Kejadian';
            }
        }
        $departemen = DB::table('pencatatan_peristiwa_resiko')
                        ->select('departemen.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
        $tahun = DB::table('pelaksanaan_manajemen_risiko')
        ->groupby('priode_penerapan')
        ->get();
        $kode_risiko = DB::table('pencatatan_peristiwa_resiko')
                        ->select('resiko_teridentifikasi.full_kode')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pencatatan_peristiwa_resiko.id_risiko')
                        ->groupby('pencatatan_peristiwa_resiko.id_risiko')
                        ->orderby('resiko_teridentifikasi.full_kode','asc')
                        ->get();
        $kode_penyebab = DB::table('pencatatan_peristiwa_resiko')
                        ->select('penyebab.*')
                        ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                        ->groupby('pencatatan_peristiwa_resiko.penyebab_id')
                        ->orderby('penyebab.kode','asc')
                        ->get();
        $pemicu_kejadian = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*')
                            ->groupby('pencatatan_peristiwa_resiko.pemicu')
                            ->orderby('pencatatan_peristiwa_resiko.pemicu')
                            ->get();

        if($active_departemen!='Semua Departemen'){
            if($active_tahun!='Semua Tahun'){
                if($active_kode!='Semua Kode Risiko'){
                    if($active_penyebab!='Semua Kode Penyebab'){
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.full_kode','=',$active_kode],['penyebab.kode','=',$active_penyebab],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.full_kode','=',$active_kode],['penyebab.kode','=',$active_penyebab]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.full_kode','=',$active_kode],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.full_kode','=',$active_kode]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }
                }else{
                    if($active_penyebab!='Semua Kode Penyebab'){
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['penyebab.kode','=',$active_penyebab],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['penyebab.kode','=',$active_penyebab]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }
                }
            }else{
                if($active_kode!='Semua Kode Risiko'){
                    if($active_penyebab!='Semua Kode Penyebab'){
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['resiko_teridentifikasi.full_kode','=',$active_kode],['penyebab.kode','=',$active_penyebab],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['resiko_teridentifikasi.full_kode','=',$active_kode],['penyebab.kode','=',$active_penyebab]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['resiko_teridentifikasi.full_kode','=',$active_kode],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['resiko_teridentifikasi.full_kode','=',$active_kode]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }
                }else{
                    if($active_penyebab!='Semua Kode Penyebab'){
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['penyebab.kode',$active_penyebab],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['penyebab.kode',$active_penyebab]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where('pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen)
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                        }
                    }
                }
            }
            // $data = DB::select("SELECT a.id AS id,a.waktu AS waktu,a.resiko_id AS resiko_id,b.kode AS penyebab,c.nilai AS skor,c.nama AS dampak, d.`full_kode` AS full_kode, d.`pernyataan_risiko` AS pernyataan, d.`uraian_dampak` AS uraian
            // FROM pencatatan_peristiwa_resiko a
            // JOIN penyebab b ON a.`penyebab_id` = b.`id`
            // JOIN kriteria_dampak c ON a.`kriteria_id` = c.`id`
            // JOIN resiko_teridentifikasi d ON a.`departemen_id` = d.`id`
            // WHERE d.`departmen_pemilik_resiko`= '$active_departemen'
            // -- AND d.`periode_penerapan` = '$tahun'
            // ");
        }else{
            if($active_tahun!='Semua Tahun'){
                if($active_kode!='Semua Kode Risiko'){
                    if($active_penyebab!='Semua Kode Penyebab'){
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.full_kode','=',$active_kode],['penyebab.kode','=',$active_penyebab],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.full_kode','=',$active_kode],['penyebab.kode','=',$active_penyebab]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.full_kode','=',$active_kode],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.full_kode','=',$active_kode]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }
                }else{
                    if($active_penyebab!='Semua Kode Penyebab'){
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['penyebab.kode','=',$active_penyebab],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['penyebab.kode','=',$active_penyebab]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where('pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun)
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }
                }
            }else{
                if($active_kode!='Semua Kode Risiko'){
                    if($active_penyebab!='Semua Kode Penyebab'){
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['resiko_teridentifikasi.full_kode','=',$active_kode],['penyebab.kode','=',$active_penyebab],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['resiko_teridentifikasi.full_kode','=',$active_kode],['penyebab.kode','=',$active_penyebab]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['resiko_teridentifikasi.full_kode','=',$active_kode],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where('resiko_teridentifikasi.full_kode','=',$active_kode)
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }
                }else{
                    if($active_penyebab!='Semua Kode Penyebab'){
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['penyebab.kode','=',$active_penyebab],['pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where([['penyebab.kode','=',$active_penyebab]])
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }else{
                        if($active_pemicu!='Semua Pemicu Kejadian'){
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            ->where('pencatatan_peristiwa_resiko.pemicu','=',$active_pemicu)
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }else{
                            $data = DB::table('pencatatan_peristiwa_resiko')
                            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
                            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pencatatan_peristiwa_resiko.id_manajemen')
                            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
                            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
                            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                            ->get();
                            // dd($data);
                        }
                    }
                }
            }
            // $data = DB::select("SELECT a.id AS id,a.waktu AS waktu,a.resiko_id AS resiko_id,b.kode AS penyebab,c.nilai AS skor,c.nama AS dampak, d.`full_kode` AS full_kode, d.`pernyataan_risiko` AS pernyataan, d.`uraian_dampak` AS uraian
            //         FROM pencatatan_peristiwa_resiko a
            //         JOIN penyebab b ON a.`penyebab_id` = b.`id`
            //         JOIN kriteria_dampak c ON a.`kriteria_id` = c.`id`
            //         JOIN resiko_teridentifikasi d ON a.`departemen_id` = d.`id`");
        }
        // $cari = DB::select("SELECT b.`departmen_pemilik_resiko` AS dept, b.`periode_penerapan` AS tahun FROM pencatatan_peristiwa_resiko a
        //                     JOIN resiko_teridentifikasi b ON a.`departemen_id` = b.`id`
        //                     GROUP BY b.`periode_penerapan`, a.departemen_id");
        return view('backend.pencatatanperistiwa.index',compact('data','active_departemen','active_tahun','active_kode','active_penyebab','active_pemicu','departemen','tahun','kode_risiko','kode_penyebab','pemicu_kejadian'));
    }

    public function cari(Request $request)
    {
        $tahun=$request->tahun;
        $dept=$request->dept;
        $data = DB::select("SELECT a.id AS id,a.waktu AS waktu,a.resiko_id AS resiko_id,b.kode AS penyebab,c.nilai AS skor,c.nama AS dampak, d.`full_kode` AS full_kode, d.`pernyataan_risiko` AS pernyataan, d.`uraian_dampak` AS uraian
                            FROM pencatatan_peristiwa_resiko a
                            JOIN penyebab b ON a.`penyebab_id` = b.`id`
                            JOIN kriteria_dampak c ON a.`kriteria_id` = c.`id`
                            JOIN resiko_teridentifikasi d ON a.`departemen_id` = d.`id`
                            WHERE d.`departmen_pemilik_resiko`= '$dept'
                            AND d.`periode_penerapan` = '$tahun'");
        $cari = DB::select("SELECT b.`departmen_pemilik_resiko` AS dept, b.`periode_penerapan` AS tahun FROM pencatatan_peristiwa_resiko a
                            JOIN resiko_teridentifikasi b ON a.`departemen_id` = b.`id`
                            GROUP BY b.`periode_penerapan`, a.departemen_id");
        return view('backend.pencatatanperistiwa.index',compact('data','cari'));
    }

    public function  create()
    {
        $dampakterakhir = DB::table('kriteria_dampak')->select('kriteria_dampak.*')->orderby('kriteria_dampak.id','desc')->get();
        $penyebab = DB::table('penyebab')->get();
        $resiko = DB::table('resiko_teridentifikasi')->select('id','departmen_pemilik_resiko','periode_penerapan')->get();
        return view('backend.pencatatanperistiwa.create', compact('penyebab','dampakterakhir','resiko'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'departemen'=>'required',
            // 'tahun'=>'required',
            'risiko'=>'required',
            // 'pernyataan_risiko'=>'required',
            // 'uraian'=>'required',
            'waktu'=>'required',
            'tempat'=>'required',
            'skor'=>'required',
            'pemicu'=>'required',
            'kode_penyebab'=>'required',
        ]);
        $data = DB::table('pencatatan_peristiwa_resiko')->insert([
            'departemen_id'=>$request->id_departemen,
            'id_manajemen'=>$request->id_manajemen,
            'id_risiko'=>$request->id_risiko,
            // tahun'=>$request->tahun,
            'resiko_id'=>$request->kode_risiko,
            // 'pernyataan'=>$request->pernyataan_risiko,
            'uraian'=>$request->uraian,
            'waktu'=>$request->waktu,
            'tempat'=>$request->tempat,
            'kriteria_id'=>$request->skor,
            'pemicu'=>$request->pemicu,
            'penyebab_id'=>$request->kode_penyebab,
            ]);
            
        return redirect('pencatatan-peristiwa')->with('status','Berhasil menambah data');
    }

    public function edit($id)
    {
        $data = DB::select("SELECT a.*,a.`uraian` AS uraianpencatatan,b.kode AS penyebab,c.nilai AS skor,c.nama AS dampak, d.`full_kode` AS full_kode, d.`pernyataan_risiko` AS pernyataan, d.`uraian_dampak` AS uraian,d.periode_penerapan as tahun, d.`faktur` AS faktur,e.`id_departemen` AS id_departemen, f.`nama` AS nama
                            FROM pencatatan_peristiwa_resiko a
                            JOIN penyebab b ON a.`penyebab_id` = b.`id`
                            JOIN kriteria_dampak c ON a.`kriteria_id` = c.`id`
                            JOIN resiko_teridentifikasi d ON a.`id_risiko` = d.`id`
                            JOIN pelaksanaan_manajemen_risiko e ON d.`faktur` = e.`faktur`
                            JOIN departemen f ON e.`id_departemen` = f.`id`
                            WHERE a.id = '$id'");
                            // dd($data);
        $dampakterakhir = DB::table('kriteria_dampak')->select('kriteria_dampak.*')->orderby('kriteria_dampak.id','desc')->get();
        $penyebab = DB::table('penyebab')->get();
        $resiko = DB::table('resiko_teridentifikasi')->select('id','full_kode','departmen_pemilik_resiko','periode_penerapan')->get();

        return view('backend.pencatatanperistiwa.update', compact('penyebab','dampakterakhir','resiko','data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'departemen'=>'required',
            // 'tahun'=>'required',
            // 'risiko'=>'required',
            // 'pernyataan_risiko'=>'required',
            // 'uraian'=>'required',
            'waktu'=>'required',
            'tempat'=>'required',
            'skor'=>'required',
            'pemicu'=>'required',
            'kode_penyebab'=>'required',
        ]);
        Pencatatanperistiwa::find($id)->update([
            'departemen_id'=>$request->id_departemen,
            'id_manajemen'=>$request->id_manajemen,
            'id_risiko'=>$request->id_risiko,
            'resiko_id'=>$request->kode_risiko,
            // tahun'=>$request->tahun,
            // 'resiko_id'=>$request->risiko,
            // 'pernyataan'=>$request->pernyataan_risiko,
            'uraian'=>$request->uraian,
            'waktu'=>$request->waktu,
            'tempat'=>$request->tempat,
            'kriteria_id'=>$request->skor,
            'pemicu'=>$request->pemicu,
            'penyebab_id'=>$request->kode_penyebab,
        ]);
        return redirect('pencatatan-peristiwa')->with('status','Berhasil merubah data');
    }

    public function destroy($id)
    {
        DB::table('pencatatan_peristiwa_resiko')->where('id',$id)->delete();
    }

    public function cari_pencatatan_manajemen(Request $request)
    {
        $dept = DB::table('resiko_teridentifikasi')->where("id",$request->depID)->get();
        return response()->json($dept);
    }
}
