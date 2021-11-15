<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class perubahanBesaranRisiko extends Controller
{
    //=========================================================================================
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

        $active_departemen = 'Semua Departemen';
        $active_tahun = 'Semua Tahun';

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

        $departemen =DB::table('perubahan_besaran_risiko')
        ->select('pelaksanaan_manajemen_risiko.*','departemen.nama')
        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','perubahan_besaran_risiko.kode_resiko_teridentifikasi')
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','perubahan_besaran_risiko.id_pelaksanaan_manajemen_risiko')
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
        ->groupby('departemen.id')
        ->orderby('perubahan_besaran_risiko.id','desc')
        ->get();

        $tahun = DB::table('pelaksanaan_manajemen_risiko')
        ->groupby('priode_penerapan')
        ->get();

        if($active_departemen!='Semua Departemen'){
            if($active_tahun!='Semua Tahun'){
                $data = DB::table('perubahan_besaran_risiko')
                ->select(DB::raw('perubahan_besaran_risiko.*,resiko_teridentifikasi.besaran_akhir,resiko_teridentifikasi.frekuensi_akhir,resiko_teridentifikasi.dampak_akhir,resiko_teridentifikasi.pr_akhir'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','perubahan_besaran_risiko.kode_resiko_teridentifikasi')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','perubahan_besaran_risiko.id_pelaksanaan_manajemen_risiko')
                ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun]])
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('perubahan_besaran_risiko.id','desc')
                ->get();
            }else{
                $data = DB::table('perubahan_besaran_risiko')
                ->select(DB::raw('perubahan_besaran_risiko.*,resiko_teridentifikasi.besaran_akhir,resiko_teridentifikasi.frekuensi_akhir,resiko_teridentifikasi.dampak_akhir,resiko_teridentifikasi.pr_akhir'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','perubahan_besaran_risiko.kode_resiko_teridentifikasi')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','perubahan_besaran_risiko.id_pelaksanaan_manajemen_risiko')
                ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen]])
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('perubahan_besaran_risiko.id','desc')
                ->get();
            }
        }else{
            if($active_tahun!='Semua Tahun'){
                $data = DB::table('perubahan_besaran_risiko')
                ->select(DB::raw('perubahan_besaran_risiko.*,resiko_teridentifikasi.besaran_akhir,resiko_teridentifikasi.frekuensi_akhir,resiko_teridentifikasi.dampak_akhir,resiko_teridentifikasi.pr_akhir'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','perubahan_besaran_risiko.kode_resiko_teridentifikasi')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','perubahan_besaran_risiko.id_pelaksanaan_manajemen_risiko')
                ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun]])
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('perubahan_besaran_risiko.id','desc')
                ->get();
            }else{
                $data = DB::table('perubahan_besaran_risiko')
                ->select(DB::raw('perubahan_besaran_risiko.*,resiko_teridentifikasi.besaran_akhir,resiko_teridentifikasi.frekuensi_akhir,resiko_teridentifikasi.dampak_akhir,resiko_teridentifikasi.pr_akhir'))
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','perubahan_besaran_risiko.kode_resiko_teridentifikasi')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','perubahan_besaran_risiko.id_pelaksanaan_manajemen_risiko')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('perubahan_besaran_risiko.id','desc')
                ->get();
            }
        }
        return view('backend.perubahanbesaranrisiko.index',compact('data','departemen','active_departemen','tahun','active_tahun'));
    }

    //=========================================================================================
    public function create()
    {
        $frekuensi = DB::table('kriteria_probabilitas')->get();
        $dampak = DB::table('kriteria_dampak')->get();
        return view('backend.perubahanbesaranrisiko.create',compact('frekuensi','dampak'));
    }

    //=========================================================================================
    public function store(Request $request)
    {
        DB::table('perubahan_besaran_risiko')
        ->insert([
            'id_pelaksanaan_manajemen_risiko'=>$request->id,
            'id_frekuensi_aktual'=>$request->frekkini,
            'id_dampak_aktual'=>$request->dampakini,
            'kode_resiko_teridentifikasi'=>$request->full_kode,
            'besaran_aktual'=>$request->besarankini,
            'deviasi'=>$request->deviasi,
            'warna_aktual'=>$request->warnabesarankini,
            'rekomendasi'=>$request->rekomendasi,
            'frekuensi_saat_ini'=>$request->frekuensi_saat_ini,
            'dampak_saat_ini'=>$request->dampak_saat_ini,
            'besaran_saat_ini'=>$request->besaran_saat_ini,
            'pr_saat_ini'=>$request->pr_saat_ini,
        ]);
        $frekuensi = DB::table('kriteria_probabilitas')->where('id',$request->frekkini)->get();
        $dampak = DB::table('kriteria_dampak')->where('id',$request->dampakini)->get();

        $label_pro='';
        $label_dam='';
        foreach($frekuensi as $frek){
            $label_pro=$frek->nilai.' - '.$frek->nama;
        }

        foreach($dampak as $dam){
            $label_dam=$dam->nilai.' - '.$dam->nama;
        }
        $selera_risiko = $request->selera_risiko;
        $besaran_saat_ini = $request->besarankini;
        if($besaran_saat_ini <= $selera_risiko){
            $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)
            ->update([
                'pr_akhir'=>$request->warnabesarankini,
                'besaran_akhir'=>$request->besarankini,
                'frekuensi_akhir'=>$label_pro,
                'dampak_akhir'=>$label_dam,
                'status'=>'Memenuhi Selera Risiko',
            ]);
        }else{
            $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)
            ->update([
                'pr_akhir'=>$request->warnabesarankini,
                'besaran_akhir'=>$request->besarankini,
                'frekuensi_akhir'=>$label_pro,
                'dampak_akhir'=>$label_dam,
                'status'=>'Belum Memenuhi Selera Risiko',
            ]);
        }
        return redirect('perubahan-besaran-risiko')->with('status','Berhasil menyimpan data');
    }

    //=========================================================================================
    public function show($id)
    {
        //
    }

    //=========================================================================================
    public function edit($id)
    {
        $frekuensi = DB::table('kriteria_probabilitas')->get();
        $dampak = DB::table('kriteria_dampak')->get();
        $datadetail = DB::table('perubahan_besaran_risiko')->where('id',$id)->get();
        return view('backend.perubahanbesaranrisiko.edit',compact('frekuensi','dampak','datadetail'));
    }

    //=========================================================================================
    public function update(Request $request, $id)
    {
        DB::table('perubahan_besaran_risiko')
        ->where('id',$id)
        ->update([
            // 'id_pelaksanaan_manajemen_risiko'=>$request->id,
            'id_frekuensi_aktual'=>$request->frekkini,
            'id_dampak_aktual'=>$request->dampakini,
            // 'kode_resiko_teridentifikasi'=>$request->full_kode,
            'besaran_aktual'=>$request->besarankini,
            'deviasi'=>$request->deviasi,
            'warna_aktual'=>$request->warnabesarankini,
            'rekomendasi'=>$request->rekomendasi,
        ]);
        $frekuensi = DB::table('kriteria_probabilitas')->where('id',$request->frekkini)->get();
        $dampak = DB::table('kriteria_dampak')->where('id',$request->dampakini)->get();

        $label_pro='';
        $label_dam='';
        foreach($frekuensi as $frek){
            $label_pro=$frek->nilai.' - '.$frek->nama;
        }

        foreach($dampak as $dam){
            $label_dam=$dam->nilai.' - '.$dam->nama;
        }

        // $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)
        // ->update([
        //     'pr_akhir'=>$request->warnabesarankini,
        //     'besaran_akhir'=>$request->besarankini,
        //     'frekuensi_akhir'=>$label_pro,
        //     'dampak_akhir'=>$label_dam,
        // ]);
        $selera_risiko = $request->selera_risiko;
        $besaran_saat_ini = $request->besarankini;
        if($besaran_saat_ini <= $selera_risiko){
            $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)
            ->update([
                'pr_akhir'=>$request->warnabesarankini,
                'besaran_akhir'=>$request->besarankini,
                'frekuensi_akhir'=>$label_pro,
                'dampak_akhir'=>$label_dam,
                'status'=>'Memenuhi Selera Risiko',
            ]);
        }else{
            $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)
            ->update([
                'pr_akhir'=>$request->warnabesarankini,
                'besaran_akhir'=>$request->besarankini,
                'frekuensi_akhir'=>$label_pro,
                'dampak_akhir'=>$label_dam,
                'status'=>'Belum Memenuhi Selera Risiko',
            ]);
        }
        return redirect('perubahan-besaran-risiko')->with('status','Berhasil memperbarui data');
    }

    //=========================================================================================
    public function destroy($id)
    {
        DB::table('perubahan_besaran_risiko')->where('id',$id)->delete();
    }
}
