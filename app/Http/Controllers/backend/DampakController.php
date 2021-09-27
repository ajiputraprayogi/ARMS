<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\dampak;
use DataTables;

class DampakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = dampak::all();
        return view('backend.kriteria_dampak.index',['data'=>$data]);
    }

    public function listdata(){
        return Datatables::of(dampak::all())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.kriteria_dampak.add_dampak');
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
            'nilai' => 'required',
            'nama' => 'required',
        ]);
        dampak::insert([
            'nilai' => $request->nilai,
            'nama' => $request->nama,
            'uraian' => $request->uraian,
        ]);
        return redirect('dampak')->with('status','Sukses menyimpan data');
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
        $data = dampak::find($id);
        return view('backend.kriteria_dampak.edit_dampak',['data'=>$data]);
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
            'nilai'=>'required',
            'nama'=>'required',
        ]);
        dampak::find($id)->update([
            'nilai'=>$request->nilai,
            'nama'=>$request->nama,
            'uraian'=>$request->uraian,
        ]);
        return redirect('dampak')->with('status','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dampak::destroy($id);
    }
}
