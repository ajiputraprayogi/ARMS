<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\probabilitas;
use DataTables;

class ProbabilitasController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkSuperAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = probabilitas::all();
        return view('backend.kriteria_probabilitas.index',['data'=>$data]);
    }

    public function listdata(){
        return Datatables::of(probabilitas::all())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.kriteria_probabilitas.add_probabilitas');
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
            'nilai'=>'required',
            'nama'=>'required',
        ]);
        probabilitas::insert([
            'nilai' => $request->nilai,
            'nama' => $request->nama,
            'uraian' => $request->uraian,
        ]);
        return redirect('probabilitas')->with('status','Sukses menyimpan data');
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
        $data = probabilitas::find($id);
        return view('backend.kriteria_probabilitas.edit_probabilitas', ['data'=>$data]);
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
        probabilitas::find($id)->update([
            'nilai'=>$request->nilai,
            'nama'=>$request->nama,
            'uraian'=>$request->uraian,
        ]);
        return redirect('probabilitas')->with('status','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        probabilitas::destroy($id);
    }
}
