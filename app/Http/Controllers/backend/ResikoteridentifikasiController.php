<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\resikoteridentifikasi;
use App\kategoriresiko;
use App\metode;
use DataTables;
use DB;
use Auth;
// use Alfa6661\AutoNumber\AutoNumberTrait;

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
        $data = DB::table('kategori_resiko')->select('kategori_resiko.*')
                    ->where('kategori_resiko.id','=', $id)
                    ->get();
            
            return response()->json($data);
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
        $coba = $request->kode_konteks.".".$request->kodedep.".".$request->kodekat;
        $kode= resikoteridentifikasi::where('kode_risiko', $coba )->max('number')+1;
        $full_code= $coba.".".$kode;
        // dd($full_code);
        resikoteridentifikasi::insert([
            
            'pr' => $warna,
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
        $kategori = kategoriresiko::get();
        $spip = metode::all();
        $res = DB::table('resiko_teridentifikasi')
        ->select('resiko_teridentifikasi.*', 'kategori_resiko.id as idkat','kategori_resiko.kode as kodekat', 'kategori_resiko.resiko as namakat')
        ->join('kategori_resiko', 'resiko_teridentifikasi.id_kategori', '=', 'kategori_resiko.id')
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
        $coba = $request->kode_konteks.".".$request->kodedep.".".$request->kodekat;
        $kode= resikoteridentifikasi::where('kode_risiko', $coba )->max('number')+1;
        $full_code= $coba.".".$kode;
        $data2 = DB::table('resiko_teridentifikasi')->where('id', $id)->get();
        // $data = $request->idkat;
        // dd($data);
        $ui="21sadasd";
        
        resikoteridentifikasi::find($id)->update([
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
            'id_kategori'=>$ui,
            'kategori_risiko'=> $request->kodekat,
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
    public function hasilcarikonteks($id){
        $data = DB::table('konteks')
                    ->select('konteks.id','konteks.kode as kode_konteks','jenis_konteks.id as id_konteks','jenis_konteks.konteks as namakonteks')
                    ->leftjoin('jenis_konteks', 'konteks.id_konteks', '=', 'jenis_konteks.id')
                    ->where('konteks.id','=', $id)
                    ->get();
            
            return response()->json($data);
    }
}
