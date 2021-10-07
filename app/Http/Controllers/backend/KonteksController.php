<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\konteks;
use DataTables;

class KonteksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function listdata(){
        return Datatables::of(konteks::leftJoin('jenis_konteks','konteks.id_konteks','=','jenis_konteks.id')
        ->select('jenis_konteks.id as idjk','jenis_konteks.*','konteks.*')->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'faktur_konteks'=>'required',
            'kode_konteks'=>'required',
            'nama_konteks'=>'required',
            'id_jenis_konteks'=>'required',
            'detail_ancaman_konteks'=>'required',
            'indikator_kinerja_kegiatan_konteks'=>'required',
        ]);
        konteks::insert([
            'faktur_konteks'=>$request->faktur_konteks,
            'kode'=>$request->kode_konteks,
            'nama'=>$request->nama_konteks,
            'id_konteks'=>$request->id_jenis_konteks,
            'detail_ancaman'=>$request->detail_ancaman_konteks,
            'indikator_kinerja_kegiatan'=>$request->indikator_kinerja_kegiatan_konteks,
        ]);
        //return redirect('pelaksanaan/create')->with('statuskonteks','Sukses menambah data');
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
        $request->validate([
            'edit_kode_konteks'=>'required',
            'edit_nama_konteks'=>'required',
            'edit_id_jenis_konteks'=>'required',
            'edit_detail_ancaman_konteks'=>'required',
            'edit_indikator_kinerja_kegiatan_konteks'=>'required',
        ]);
        konteks::find($id)->update([
            'kode'=>$request->edit_kode_konteks,
            'nama'=>$request->edit_nama_konteks,
            'id_konteks'=>$request->edit_id_jenis_konteks,
            'detail_ancaman'=>$request->edit_detail_ancaman_konteks,
            'indikator_kinerja_kegiatan'=>$request->edit_indikator_kinerja_kegiatan_konteks,
        ]);
        //return redirect('pelaksanaan/create')->with('statuskonteks','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        konteks::destroy($id);
    }
}
