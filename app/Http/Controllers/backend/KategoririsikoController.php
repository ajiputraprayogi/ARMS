<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\kategoriresiko;
use DataTables;

class KategoririsikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = kategoriresiko::all();
        return view('backend.kategori_risiko.index',['data'=>$data]);
    }

    public function listdata(){
        return Datatables::of(kategoriresiko::all())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.kategori_risiko.add_kategori_risiko');
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
            'kode' => 'required',
            'risiko' => 'required',
        ]);
        kategoriresiko::insert([
            'kode' => $request->kode,
            'resiko' => $request->risiko,
        ]);
        return redirect('kategoririsiko')->with('status','Berhasil menyimpan data');
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
        $data=kategoriresiko::find($id);
        return view('backend.kategori_risiko.edit_kategori_risiko',['data'=>$data]);
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
            'kode'=>'required',
            'resiko'=>'required',
        ]);
        kategoriresiko::find($id)->update([
            'kode'=>$request->kode,
            'resiko'=>$request->resiko,
        ]);
        return redirect('kategoririsiko')->with('status','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kategoriresiko::destroy($id);
    }
}
