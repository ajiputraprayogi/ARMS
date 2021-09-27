<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\metode;
use DataTables;

class MetodepencapaiantujuanspipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = metode::all();
        return view('backend.metode_pencapaian_tujuan_spip.index',['data'=>$data]);
    }

    public function listdata(){
        return Datatables::of(metode::all())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.metode_pencapaian_tujuan_spip.add_metode_pencapaian_tujuan_spip');
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
            'metode' => 'required',
        ]);
        metode::insert([
            'metode' => $request->metode,
        ]);
        return redirect('metodepencapaiantujuanspip')->with('status','Sukses menyimpan data');
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
        $data = metode::find($id);
        return view('backend.metode_pencapaian_tujuan_spip.edit_metode_pencapaian_tujuan_spip',['data'=>$data]);
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
            'metode'=>'required',
        ]);
        metode::find($id)->update([
            'metode'=>$request->metode,
        ]);
        return redirect('metodepencapaiantujuanspip')->with('status','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        metode::destroy($id);
    }
}
