<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PengendalianrisikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pengendalian_risiko.pengendalian_risiko');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $klasifikasi = DB::table('klasifikasi_sub_unsur_spip')
        ->select('klasifikasi_sub_unsur_spip.*')
        ->get();
        $frekuensiterakhir = DB::table('kriteria_probabilitas')->select('kriteria_probabilitas.*')->orderby('kriteria_probabilitas.id','desc')->paginate(1);
        $dampakterakhir = DB::table('kriteria_dampak')->select('kriteria_dampak.*')->orderby('kriteria_dampak.id','desc')->paginate(1);
        $risikoterakhir = DB::table('resiko_teridentifikasi')->select('resiko_teridentifikasi.*')->orderby('resiko_teridentifikasi.id','desc')->paginate(1);
        return view('backend.pengendalian_risiko.add_pengendalian_risiko', compact('klasifikasi','frekuensiterakhir','dampakterakhir','risikoterakhir'));
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

    public function cari_departemen_manajemen(Request $request)
    {
        if($request->has('q')){
            $cari=$request->q;
            $data = DB::table('pelaksanaan_manajemen_risiko')
            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
            ->select('pelaksanaan_manajemen_risiko.*','departemen.id as idd','departemen.nama')
            ->where('nama','like','%'.$cari.'%')
            ->orderby('pelaksanaan_manajemen_risiko.priode_penerapan','asc')
            ->groupby('pelaksanaan_manajemen_risiko.faktur')
            ->get();
            return response()->json($data);
        }
    }
    public function cari_departemen_manajemen_hasil($id)
    {
        $data = DB::table('pelaksanaan_manajemen_risiko')
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->select('pelaksanaan_manajemen_risiko.*','departemen.id as idd','departemen.nama')
        ->where('pelaksanaan_manajemen_risiko.id',$id)
        ->get();
        return response()->json($data);
    }
    public function cari_risiko(Request $request)
    {
        if($request->has('q')){
            $cari=$request->q;
            $data = DB::table('resiko_teridentifikasi')
            ->select('id','kode_risiko')
            ->where('kode_risiko','like','%'.$cari.'%')
            ->get();
            return response()->json($data);
        }
    }
    public function cari_risiko_hasil($id)
    {
        $data = DB::table('resiko_teridentifikasi')
        ->where('id',$id)
        ->get();
        return response()->json($data);
    }
}
