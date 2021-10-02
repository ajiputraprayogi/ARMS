<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\resikoteridentifikasi;
use App\kategoriresiko;
use App\metode;
use DataTables;
use DB;

class ResikoteridentifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = resikoteridentifikasi::all();
        return view('backend.resiko.resiko_teridentifikasi.index',['data'=>$data]);
    }

    public function listdata(){
        return Datatables::of(resikoteridentifikasi::all())->make(true);
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
        $hariini = date('Y-m-d'); 
        return view('backend.resiko.resiko_teridentifikasi.add',['data'=>$kategori, 'data2'=>$spip, 'hariini'=>$hariini]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'pernyataan_' => 'required',
        // ]);
        $warna = "#BF00FF";
        $status= "Belum memenuhi selera risiko";
        $baw = "0";
        $bak = "0";
        resikoteridentifikasi::insert([
            
            'pr' => $warna,
            'id_departmen' => $request->id_dep,
            'kode_departemen'=> $request->kodedep,
            'departmen_pemilik_resiko'=> $request->namadep,
            'periode_penerapan'=> $request->tahun,
            'id_jenis_konteks'=> $request->id_jenis_konteks,
            'id_konteks'=> $request->id_konteks,
            'konteks'=> $request->namakonteks,
            'kode_konteks'=> $request->kode_konteks,
            'pernyataan_risiko'=> $request->pernyataan,
            'kategori_risiko'=> $request->kategori,
            'uraian_dampak'=> $request->dampak,
            'metode_spip'=> $request->metode,
            'status_persetujuan'=> $request->pengajuan,
            'diajukan_oleh'=> $request->diajukan,
            'diajukan_tanggal'=> $request->tanggal_pengajuan,
            'persetujuan_oleh'=> $request->disetujui_oleh,
            'tanggal_persetujua'=> $request->tanggal_persetujuan,
            'keterangan'=> $request->keterangan,
            'besaran_awal' => $baw,
            'besaran_akhir'=> $bak,
            'status' => $status
        ]);
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
        $kategori = kategoriresiko::all();
        $spip = metode::all();
        $res = DB::table('resiko_teridentifikasi')
        ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as ikat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat')
        ->leftjoin('kategori_resiko', 'resiko_teridentifikasi.kategori_risiko', '=', 'kategori_resiko.id')
        ->where('resiko_teridentifikasi.id','=', $id)->get();
        // dd($res);
        return view('backend.resiko.resiko_teridentifikasi.edit',['data'=>$kategori, 'data2'=>$spip, 'res'=>$res]);
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
        resikoteridentifikasi::find($id)->update([
            'id_departmen' => $request->id_dep,
            'kode_departemen'=> $request->kodedep,
            'departmen_pemilik_resiko'=> $request->namadep,
            'periode_penerapan'=> $request->tahun,
            'id_jenis_konteks'=> $request->id_jenis_konteks,
            'id_konteks'=> $request->id_konteks,
            'konteks'=> $request->namakonteks,
            'kode_konteks'=> $request->kode_konteks,
            'pernyataan_risiko'=> $request->pernyataan,
            'kategori_risiko'=> $request->kategori,
            'uraian_dampak'=> $request->dampak,
            'metode_spip'=> $request->metode,
            'status_persetujuan'=> $request->pengajuan,
            'diajukan_oleh'=> $request->diajukan,
            'diajukan_tanggal'=> $request->tanggal_pengajuan,
            'persetujuan_oleh'=> $request->disetujui_oleh,
            'tanggal_persetujua'=> $request->tanggal_persetujuan,
            'keterangan'=> $request->keterangan,
            'status' => $request->status
        ]);
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
        resikoteridentifikasi::destroy($id);
    }

    //----------------------------------cari data departmen-----------------------------------------
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

        $resiko = DB::table('konteks')
        ->where('id_departemen',$iddepartemen)
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
                    ->get();
            
            return response()->json($data);
        }
    }
    public function hasilcarikonteks($id){
        $data = DB::table('konteks')
                    ->select('konteks.id','konteks.kode as kode_konteks','jenis_konteks.id as id_konteks','jenis_konteks.konteks as namakonteks')
                    ->leftjoin('jenis_konteks', 'konteks.id_konteks', '=', 'jenis_konteks.id')
                    ->where('konteks.id','=', $id)
                    ->get();
            
            return response()->json($data);
    }
}
