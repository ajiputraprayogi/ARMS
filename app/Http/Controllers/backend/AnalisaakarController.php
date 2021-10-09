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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = analisaakar::orderby('id','desc')->get();
        return view('backend.resiko.akar_masalah.index',compact('data'));
    }

    public function create()
    {
        DB::table('akar_masalah_why_thumb')->where('pembuat','=',Auth::user()->id)->delete();
        $data = penyebab::all();
        return view('backend.resiko.akar_masalah.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
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
