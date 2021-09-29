<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\pemangku_kepentingan;
use DataTables;

class PemangkukepentinganController extends Controller
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
        return Datatables::of(pemangku_kepentingan::all())->make(true);
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
            'faktur_pemangku'=>'required',
            'pemangku_kepentingan'=>'required',
            'keterangan'=>'required',
        ]);
        pemangku_kepentingan::insert([
            'faktur_pemangku'=>$request->faktur_pemangku,
            'pemangku_kepentingan'=>$request->pemangku_kepentingan,
            'keterangan'=>$request->keterangan,
        ]);
        return redirect('pelaksanaan/create')->with('statuspemangku','Sukses menambahkan data');
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
            'pemangku_kepentingan'=>'required',
            'keterangan'=>'required',
        ]);
        pemangku_kepentingan::find($id)->update([
            'pemangku_kepentingan'=>$request->pemangku_kepentingan,
            'keterangan'=>$request->keterangan,
        ]);
        return redirect('pelaksanaan/create')->with('statuspemangku','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pemangku_kepentingan::destroy($id);
    }
}
