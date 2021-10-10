<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\analisarisiko;
use DataTables;
use DB;

class AnalisarisikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.resiko.analisa.index');
    }
    public function listdata(){
        return Datatables::of(analisarisiko::all())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $frekuensi = DB::table('kriteria_probabilitas')->get();
        $dampak = DB::table('kriteria_dampak')->get();
        return view('backend.resiko.analisa.add', ['frekuensi'=>$frekuensi, 'dampak'=>$dampak]);
    }

    public function cario($frek, $dampak){
        $data = DB::table('besaran_resiko')
        ->select('besaran_resiko.*','besaran_resiko.id as idbesaran', 'kriteria_probabilitas.nilai as nilpro', 'kriteria_dampak.nilai as nildam', 'kriteria_probabilitas.nama as nampro', 'kriteria_dampak.nama as namdam', 'kriteria_probabilitas.id as idpro', 'kriteria_dampak.id as iddam')
        ->leftjoin('kriteria_probabilitas', 'besaran_resiko.id_prob', '=', 'kriteria_probabilitas.id')
        ->leftjoin('kriteria_dampak', 'besaran_resiko.id_dampak', '=', 'kriteria_dampak.id')
        ->where([['id_prob',$frek],['id_dampak', $dampak]])->get();
        return response()->json($data);
    }

    public function cariresidu($frek, $dampak){
        $data = DB::table('besaran_resiko')
        ->select('besaran_resiko.*','besaran_resiko.id as idbesaran', 'kriteria_probabilitas.nilai as nilpro', 'kriteria_dampak.nilai as nildam', 'kriteria_probabilitas.nama as nampro', 'kriteria_dampak.nama as namdam', 'kriteria_probabilitas.id as idpro', 'kriteria_dampak.id as iddam')
        ->leftjoin('kriteria_probabilitas', 'besaran_resiko.id_prob', '=', 'kriteria_probabilitas.id')
        ->leftjoin('kriteria_dampak', 'besaran_resiko.id_dampak', '=', 'kriteria_dampak.id')
        ->where([['id_prob',$frek],['id_dampak', $dampak]])->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $sts = 'belum';
        analisarisiko::insert([
            'pr_melekat'=>$request->warna,
            'pr_residu'=>$request->warnar,
            'id_departmen'=>$request->id_dep,
            'kode_departmen'=>$request->kodedep,
            'departmen_pemilik'=>$request->namadep,
            'kode_risiko'=>$request->full_kode,
            'pernyataan'=>$request->pernyataan,
            'id_besaran_melekat'=>$request->idbesaranmelekat,
            'id_prob_melekat'=>$request->idpro,
            'id_dampak_melekat'=>$request->iddam,
            'frekuensi_melekat'=>$request->nilpro,
            'dampak_melekat'=>$request->nildam,
            'besaran_melekat'=>$request->besaran,
            'id_besaran_residu'=>$request->idbesaranresidu,
            'id_prob_residu'=>$request->idpror,
            'id_dampak_residu'=>$request->iddamr,
            'frekuensi_residu'=>$request->nilpror,
            'dampak_residu'=>$request->nildamr,
            'besaran_residu'=>$request->besarankini,
            'sudah_ada_pengendalian'=>$request->sudah_ada_pengendalian,
            'uraian_pengendalian'=>$request->uraian_pengendalian,
            'apakah_memadai'=>$request->apakah_memadai,

        ]);
        $up = DB::table('resiko_teridentifikasi')->where('full_kode', '=', $request->full_kode)->update([
            'besaran_awal'=>$request->besaran,
            'besaran_akhir'=>$request->besarankini,
            'pr'=>$request->warnar,
        ]);
        return redirect('analisa-risiko')->with('status','Berhasil menyimpan data');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        analisarisiko::destroy($id);
    }

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
    public function hasilcaridepartmen($id,$iddepartemen){
        $data = DB::table('pelaksanaan_manajemen_risiko')
        ->select('pelaksanaan_manajemen_risiko.id', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep')
        ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
        ->where('pelaksanaan_manajemen_risiko.id',$id)
        ->get();

        $resiko = DB::table('resiko_teridentifikasi')
        ->where('id_departmen',$iddepartemen)
        ->get();
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
    public function hasilcarikode($id){
        $data = DB::table('resiko_teridentifikasi')
                    ->where('id','=', $id)
                    ->get();
            
            return response()->json($data);
    }
}
