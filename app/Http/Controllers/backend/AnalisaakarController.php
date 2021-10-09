<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use App\analisaakar;
use DB;
use App\penyebab;
use Auth;

class AnalisaakarController extends Controller
{
    //=============================================================================================
    public function index()
    {
        $data = analisaakar::orderby('id','desc')->get();
        return view('backend.resiko.akar_masalah.index',compact('data'));
    }

    //=============================================================================================
    public function create()
    {
        DB::table('akar_masalah_why_thumb')->where('pembuat','=',Auth::user()->id)->delete();
        $data = penyebab::all();
        return view('backend.resiko.akar_masalah.add',compact('data'));
    }

    //=============================================================================================
    public function store(Request $request)
    {
        $data=[];
        $datawhy = DB::table('akar_masalah_why_thumb')->where('pembuat',Auth::user()->id)->get();
        foreach ($datawhy as $row) {
            $data[]=[
                'kode_analisis'=>$request->kode_analisis,
                'uraian'=>$row->uraian,
            ];
        }
        DB::table('akar_masalah_why')->insert($data);
        DB::table('analisa_masalah')
        ->insert([
            'kode_analisis'=>$request->kode_analisis,
            'kode_risiko'=>$request->cari_risiko,
            'kategori_penyebab'=>$request->kategori,
            'akar_masalah'=>$request->penyebab,
            'tindakan_pengendalian'=>$request->pengendalian,
        ]);
        DB::table('akar_masalah_why_thumb')->where('pembuat','=',Auth::user()->id)->delete();
        return redirect('analisa-akar-masalah')->with('status','Data berhasil disimpan');
    }

    //=============================================================================================
    public function show($id)
    {
        //
    }

    //=============================================================================================
    public function carikode($kode)
    {
        $carikode = DB::table('analisa_masalah')
        ->where('kode_analisis','like','%'.$kode.'%')
        ->max('kode_analisis');
        //dd($carikode);
        if(!$carikode){
            $finalkode = $kode.'.1';
        }else{
            $getnumber = explode('.',$carikode);
            $jumlah = count($getnumber);
            $newno = $getnumber[$jumlah-1]+1;
            $finalkode = $kode.'.'.$newno;
        }
        return response()->json($finalkode);
    }

    //=============================================================================================
    public function edit($id)
    {
        $datanya = [];
        DB::table('akar_masalah_why_thumb')->where('pembuat','=',Auth::user()->id)->delete();
        $datadetail = DB::table('analisa_masalah')->where('id',$id)->get();
        foreach($datadetail as $row){
            $datawhy = DB::table('akar_masalah_why')->where('kode_analisis','=',$row->kode_analisis)->get();
            foreach ($datawhy as $rowwhy) {
                $datanya[]=[
                    'uraian'=>$rowwhy->uraian,
                    'pembuat'=>Auth::user()->id,
                ];
            }
        }
        $data = penyebab::all();
        DB::table('akar_masalah_why_thumb')->insert($datanya);
        return view('backend.resiko.akar_masalah.edit',compact('data','datadetail'));
    }

    //=============================================================================================
    public function update(Request $request, $id)
    {
        $data=[];
        DB::table('akar_masalah_why')->where('kode_analisis','=',$request->kode_analisis)->delete();
        $datawhy = DB::table('akar_masalah_why_thumb')->where('pembuat',Auth::user()->id)->get();
        foreach ($datawhy as $row) {
            $data[]=[
                'kode_analisis'=>$request->kode_analisis,
                'uraian'=>$row->uraian,
            ];
        }
        DB::table('akar_masalah_why')->insert($data);
        DB::table('analisa_masalah')
        ->where('id',$id)
        ->update([
            'kode_analisis'=>$request->kode_analisis,
            'kode_risiko'=>$request->cari_risiko,
            'kategori_penyebab'=>$request->kategori,
            'akar_masalah'=>$request->penyebab,
            'tindakan_pengendalian'=>$request->pengendalian,
        ]);
        DB::table('akar_masalah_why_thumb')->where('pembuat','=',Auth::user()->id)->delete();
        return redirect('analisa-akar-masalah')->with('status','Data berhasil diupdate');
    }

    //=============================================================================================
    public function destroy($id)
    {
        $datadetail = DB::table('analisa_masalah')->where('id',$id)->get();
        foreach($datadetail as $row){
            $datawhy = DB::table('akar_masalah_why')->where('kode_analisis','=',$row->kode_analisis)->delete();
        }
        DB::table('analisa_masalah')->where('id',$id)->delete();
    }

    //=============================================================================================
    public function caridepartmen(Request $request)
    {
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

    //=============================================================================================
    public function hasilcaridepartmen($id,$iddepartemen)
    {
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

    //=============================================================================================
    public function hasilcarikode($id)
    {
        $data = DB::table('resiko_teridentifikasi')
                    ->where('id','=', $id)
                    ->get();
            
            return response()->json($data);
    }

    //=============================================================================================
    public function storewhy(Request $request){
        DB::table('akar_masalah_why_thumb')
        ->insert([
            'uraian'=>$request->akar_penyebab,
            'pembuat'=>Auth::user()->id
        ]);
    }

    //=============================================================================================
    public function listwhy(){
        $data = DB::table('akar_masalah_why_thumb')
        ->where('pembuat',Auth::user()->id)
        ->get();
        return response()->json($data);
    }

    //=============================================================================================
    public function hapuswhy($id){
        DB::table('akar_masalah_why_thumb')
        ->where('id',$id)
        ->delete();
    }

    //=============================================================================================
    public function showwhy($id){
        $data = DB::table('akar_masalah_why_thumb')
        ->where('id',$id)
        ->get();
        return response()->json($data);
    }

    //=============================================================================================
    public function updatewhy(Request $request){
        $data = DB::table('akar_masalah_why_thumb')
        ->where('id',$request->kode_why)
        ->update([
            'uraian'=>$request->edit_akar_penyebab,
        ]);
    }
}
