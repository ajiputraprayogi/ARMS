<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\resikoteridentifikasi;
use DataTables;
use DB;

class ResikoteridentifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = resikoteridentifikasi::all();
        return view('backend.resiko.resiko_teridentifikasi.index',['data'=>$data]);
    }

    public function listdata(){
        return Datatables::of(resikoteridentifikasi::all())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.resiko.resiko_teridentifikasi.add');
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
            'nama' => 'required',
        ]);
        resikoteridentifikasi::insert([
            'nama' => $request->nama,
        ]);
        return redirect('resiko-teridentifikasi')->with('status','Berhasil menyimpan data');
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
        $data=resikoteridentifikasi::find($id);
        return view('backend.resiko.resiko_teridentifikasi.edit',['data'=>$data]);
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
            'nama' => 'required',
        ]);
        resikoteridentifikasi::find($id)->update([
            'nama' => $request->nama,
        ]);
        return redirect('resiko-teridentifikasi')->with('status','Berhasil menyimpan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        resikoteridentifikasi::destroy($id);
    }

    //cari data konteks
    public function carikonteks(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('jenis_konteks')
                    ->select('id','konteks')
                    ->where('konteks','like','%'.$cari.'%')
                    ->get();
            
            return response()->json($data);
        }
    }
    public function hasilcari($id){
        $data = DB::table('jenis_konteks')
                    ->select('konteks','id')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
}
