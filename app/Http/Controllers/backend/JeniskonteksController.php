<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\jeniskonteks;
use DataTables;

class JeniskonteksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = jeniskonteks::all();
        return view('backend.jenis_konteks.index',['data'=>$data]);
    }

    public function listdata(){
        return Datatables::of(jeniskonteks::all())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.jenis_konteks.add_jenis_konteks');
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
            'konteks' => 'required',
        ]);
        jeniskonteks::insert([
            'konteks' => $request->konteks,
        ]);
        return redirect('jeniskonteks')->with('status','Sukses menyimpan data');
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
        $data=jeniskonteks::find($id);
        return view('backend.jenis_konteks.edit_jenis_konteks',['data'=>$data]);
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
            'konteks'=>'required',
        ]);
        jeniskonteks::find($id)->update([
            'konteks'=>$request->konteks,
        ]);
        return redirect('jeniskonteks')->with('status','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        jeniskonteks::destroy($id);
    }
}
