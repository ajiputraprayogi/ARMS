<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\analisarisiko;
use DataTables;
use DB;
use Auth;

class AnalisarisikoController extends Controller
{
    //====================================================================================
    public function index(Request $request)
    {
        // ==================================
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
        // ==================================

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
        $departemen = DB::table('analisa_risiko')
        ->select('pelaksanaan_manajemen_risiko.*','departemen.nama')
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','analisa_risiko.id_pelaksanaan_manajemen_risiko')
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
        ->groupby('departemen.id')
        ->orderby('analisa_risiko.id','desc')
        ->get();

        $tahun = DB::table('pelaksanaan_manajemen_risiko')
        ->groupby('priode_penerapan')
        ->get();

        if($active_departemen!='Semua Departemen'){
            if($active_tahun!='Semua Tahun'){
                $data = DB::table('analisa_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','analisa_risiko.id_pelaksanaan_manajemen_risiko')
                ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun]])
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('analisa_risiko.id','desc')
                ->get();
                // dd($data);
            }else{
                $data = DB::table('analisa_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','analisa_risiko.id_pelaksanaan_manajemen_risiko')
                ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen]])
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('analisa_risiko.id','desc')
                ->get();
                // dd($data);
            }
        }else{
            if($active_tahun!='Semua Tahun'){
                $data = DB::table('analisa_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','analisa_risiko.id_pelaksanaan_manajemen_risiko')
                ->where('pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun)
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('analisa_risiko.id','desc')
                ->get();
                // dd($data);
            }else{
                $data = DB::table('analisa_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','analisa_risiko.id_pelaksanaan_manajemen_risiko')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('analisa_risiko.id','desc')
                ->get();
                // dd($data);
            }
        }
        return view('backend.resiko.analisa.index',compact('data','departemen','active_departemen','tahun','active_tahun'));
    }

    //====================================================================================
    public function listdata(){
        return Datatables::of(analisarisiko::all())->make(true);
    }

    //====================================================================================
    public function create()
    {
        $frekuensi = DB::table('kriteria_probabilitas')->get();
        $dampak = DB::table('kriteria_dampak')->get();
        return view('backend.resiko.analisa.add', ['frekuensi'=>$frekuensi, 'dampak'=>$dampak]);
    }

    //====================================================================================
    public function cario($frek, $dampak){
        $data = DB::table('besaran_resiko')
        ->select('besaran_resiko.*','besaran_resiko.id as idbesaran', 'kriteria_probabilitas.nilai as nilpro', 'kriteria_dampak.nilai as nildam', 'kriteria_probabilitas.nama as nampro', 'kriteria_dampak.nama as namdam', 'kriteria_probabilitas.id as idpro', 'kriteria_dampak.id as iddam')
        ->leftjoin('kriteria_probabilitas', 'besaran_resiko.id_prob', '=', 'kriteria_probabilitas.id')
        ->leftjoin('kriteria_dampak', 'besaran_resiko.id_dampak', '=', 'kriteria_dampak.id')
        ->where([['id_prob',$frek],['id_dampak', $dampak]])->get();
        return response()->json($data);
    }

    //====================================================================================
    public function cariresidu($frek, $dampak){
        $data = DB::table('besaran_resiko')
        ->select('besaran_resiko.*','besaran_resiko.id as idbesaran', 'kriteria_probabilitas.nilai as nilpro', 'kriteria_dampak.nilai as nildam', 'kriteria_probabilitas.nama as nampro', 'kriteria_dampak.nama as namdam', 'kriteria_probabilitas.id as idpro', 'kriteria_dampak.id as iddam')
        ->leftjoin('kriteria_probabilitas', 'besaran_resiko.id_prob', '=', 'kriteria_probabilitas.id')
        ->leftjoin('kriteria_dampak', 'besaran_resiko.id_dampak', '=', 'kriteria_dampak.id')
        ->where([['id_prob',$frek],['id_dampak', $dampak]])->get();
        return response()->json($data);
    }

    //====================================================================================
    public function store(Request $request)
    {
        analisarisiko::insert([
            'kode_risiko'=>$request->full_kode,
            'id_pelaksanaan_manajemen_risiko'=>$request->id,
            'id_prob'=>$request->idpro,
            'id_dampak'=>$request->iddam,
            'pr'=>$request->warna,
            'frekuensi_melekat'=>$request->nilpro.' - '.$request->nampro,
            'dampak_melekat'=>$request->nildam.' - '.$request->namdam,
            'besaran_melekat'=>$request->besaran,
            'id_prob_residu'=>$request->idpror,
            'id_dampak_residu'=>$request->iddamr,
            'pr_residu'=>$request->warnar,
            'frekuensi_residu'=>$request->nilpror.' - '.$request->nampror,
            'dampak_residu'=>$request->nildamr.' - '.$request->namdamr,
            'besaran_residu'=>$request->besarankini,
            'sudah_ada_pengendalian'=>$request->sudah_ada_pengendalian,
            'uraian_pengendalian'=>$request->uraian_pengendalian,
            'apakah_memadai'=>$request->apakah_memadai,
        ]);
        
        $selera_risiko = $request->selera_risiko;
        $besarankini = $request->besarankini;
        if($besarankini <= $selera_risiko){
            $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)->update([
                'pr'=>$request->warna,
                'besaran_awal'=>$request->besaran,
                'frekuensi_awal'=>$request->nilpro.' - '.$request->nampro,
                'dampak_awal'=>$request->nildam.' - '.$request->namdam,
                'pr_akhir'=>$request->warnar,
                'besaran_akhir'=>$request->besarankini,
                'frekuensi_akhir'=>$request->nilpror.' - '.$request->nampror,
                'dampak_akhir'=>$request->nildamr.' - '.$request->namdamr,
                'status'=>'Memenuhi Selera Risiko',
            ]);
        }else{
            $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)->update([
                'pr'=>$request->warna,
                'besaran_awal'=>$request->besaran,
                'frekuensi_awal'=>$request->nilpro.' - '.$request->nampro,
                'dampak_awal'=>$request->nildam.' - '.$request->namdam,
                'pr_akhir'=>$request->warnar,
                'besaran_akhir'=>$request->besarankini,
                'frekuensi_akhir'=>$request->nilpror.' - '.$request->nampror,
                'dampak_akhir'=>$request->nildamr.' - '.$request->namdamr,
                'status'=>'Belum Memenuhi Selera Risiko',
            ]);
        }
        return redirect('analisa-risiko')->with('status','Berhasil menyimpan data');
    }

    //====================================================================================
    public function show($id)
    {
        //
    }

    //====================================================================================
    public function edit($id)
    {
        $frekuensi = DB::table('kriteria_probabilitas')->get();
        $dampak = DB::table('kriteria_dampak')->get();
        $data = DB::table('analisa_risiko')->where('id',$id)->get();
        return view('backend.resiko.analisa.edit', ['frekuensi'=>$frekuensi, 'dampak'=>$dampak,'data'=>$data]);
    }

    //====================================================================================
    public function update(Request $request, $id)
    {
        analisarisiko::where('id',$id)
        ->update([
            'kode_risiko'=>$request->full_kode,
            'id_pelaksanaan_manajemen_risiko'=>$request->id,
            'id_prob'=>$request->idpro,
            'id_dampak'=>$request->iddam,
            'pr'=>$request->warna,
            'frekuensi_melekat'=>$request->nilpro.' - '.$request->nampro,
            'dampak_melekat'=>$request->nildam.' - '.$request->namdam,
            'besaran_melekat'=>$request->besaran,
            'id_prob_residu'=>$request->idpror,
            'id_dampak_residu'=>$request->iddamr,
            'pr_residu'=>$request->warnar,
            'frekuensi_residu'=>$request->nilpror.' - '.$request->nampror,
            'dampak_residu'=>$request->nildamr.' - '.$request->namdamr,
            'besaran_residu'=>$request->besarankini,
            'sudah_ada_pengendalian'=>$request->sudah_ada_pengendalian,
            'uraian_pengendalian'=>$request->uraian_pengendalian,
            'apakah_memadai'=>$request->apakah_memadai,
        ]);
        $selera_risiko = $request->selera_risiko;
        $besarankini = $request->besarankini;
        if($besarankini <= $selera_risiko){
            $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)->update([
                'pr'=>$request->warna,
                'besaran_awal'=>$request->besaran,
                'frekuensi_awal'=>$request->nilpro.' - '.$request->nampro,
                'dampak_awal'=>$request->nildam.' - '.$request->namdam,
                'pr_akhir'=>$request->warnar,
                'besaran_akhir'=>$request->besarankini,
                'frekuensi_akhir'=>$request->nilpror.' - '.$request->nampror,
                'dampak_akhir'=>$request->nildamr.' - '.$request->namdamr,
                'status'=>'Memenuhi Selera Risiko',
            ]);
        }else{
            $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)->update([
                'pr'=>$request->warna,
                'besaran_awal'=>$request->besaran,
                'frekuensi_awal'=>$request->nilpro.' - '.$request->nampro,
                'dampak_awal'=>$request->nildam.' - '.$request->namdam,
                'pr_akhir'=>$request->warnar,
                'besaran_akhir'=>$request->besarankini,
                'frekuensi_akhir'=>$request->nilpror.' - '.$request->nampror,
                'dampak_akhir'=>$request->nildamr.' - '.$request->namdamr,
                'status'=>'Belum Memenuhi Selera Risiko',
            ]);
        }
        return redirect('analisa-risiko')->with('status','Berhasil mengupdate data');
    }

    //====================================================================================
    public function destroy($id)
    {
        analisarisiko::destroy($id);
    }

    //====================================================================================
    public function caridepartmen(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('pelaksanaan_manajemen_risiko')
                    ->select('pelaksanaan_manajemen_risiko.id', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep','pelaksanaan_manajemen_risiko.selera_risiko')
                    ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
                    ->where('departemen.kode','like','%'.$cari.'%')
                    ->orwhere('departemen.nama','like','%'.$cari.'%')
                    ->get();
            
            return response()->json($data);
        }
    }
    
    //====================================================================================
    public function hasilcaridepartmen($id,$iddepartemen){
        $data = DB::table('pelaksanaan_manajemen_risiko')
        ->select('pelaksanaan_manajemen_risiko.id', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep','pelaksanaan_manajemen_risiko.selera_risiko')
        ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
        ->where('pelaksanaan_manajemen_risiko.id',$id)
        ->get();

        foreach ($data as $row) {
            $resiko = DB::table('resiko_teridentifikasi')
            ->where([['id_departmen',$iddepartemen],['periode_penerapan',$row->priode_penerapan]])
            ->get();
        }
        
        $print=[
            'detail'=>$data,
            'resiko'=>$resiko
        ];
        return response()->json($print);
    }
    //--------------------------------cari data konteks --------------------------------------------
    // public function carikonteks(Request $request){
    //     if($request->has('q')){
    //         $cari = $request->q;
    //         $data = DB::table('konteks')
    //                 ->select('konteks.*','jenis_konteks.id as id_konteks','jenis_konteks.konteks as namakonteks')
    //                 ->leftjoin('jenis_konteks', 'konteks.id_konteks', '=', 'jenis_konteks.id')
    //                 ->where('jenis_konteks.konteks','like','%'.$cari.'%')
    //                 ->get();
            
    //         return response()->json($data);
    //     }
    // }
    
    //====================================================================================
    public function hasilcarikode($id){
        $data = DB::table('resiko_teridentifikasi')
                    ->where('id','=', $id)
                    ->get();
            
            return response()->json($data);
    }
}
