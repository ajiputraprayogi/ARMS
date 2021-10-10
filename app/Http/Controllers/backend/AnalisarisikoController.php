<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\analisarisiko;
use DataTables;
use DB;

class AnalisarisikoController extends Controller
{
    //====================================================================================
    public function index()
    {
        $data = DB::table('analisa_risiko')->orderby('id','desc')->get();
        return view('backend.resiko.analisa.index',compact('data'));
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
        
        $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)->update([
            'pr'=>$request->warna,
            'besaran_awal'=>$request->besaran,
            'frekuensi_awal'=>$request->nilpro.' - '.$request->nampro,
            'dampak_awal'=>$request->nildam.' - '.$request->namdam,
            'pr_akhir'=>$request->warnar,
            'besaran_akhir'=>$request->besarankini,
            'frekuensi_akhir'=>$request->nilpror.' - '.$request->nampror,
            'dampak_akhir'=>$request->nildamr.' - '.$request->namdamr,
        ]);
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
        $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)->update([
            'pr'=>$request->warna,
            'besaran_awal'=>$request->besaran,
            'frekuensi_awal'=>$request->nilpro.' - '.$request->nampro,
            'dampak_awal'=>$request->nildam.' - '.$request->namdam,
            'pr_akhir'=>$request->warnar,
            'besaran_akhir'=>$request->besarankini,
            'frekuensi_akhir'=>$request->nilpror.' - '.$request->nampror,
            'dampak_akhir'=>$request->nildamr.' - '.$request->namdamr,
        ]);
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
                    ->select('pelaksanaan_manajemen_risiko.id', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep')
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
        ->select('pelaksanaan_manajemen_risiko.id', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep')
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
