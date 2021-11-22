<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\klasifikasi_sub_unsur_spip;
use DataTables;

class KlasifikasisubunsurspipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = klasifikasi_sub_unsur_spip::all();
        return view('backend.klasifikasi_sub_unsur_spip.index',['data'=>$data]);
    }

    public function cari_klasifikasi(Request $request){
        if($request->has('q')){
            $cari=$request->q;
            $data=klasifikasi_sub_unsur_spip::where('klasifikasi_sub_unsur_spip','like','%'.$cari.'%')->get();
            $print=[
                'klasifikasi'=>$data,
            ];
            return response()->json($print);
        }

        $data = klasifikasi_sub_unsur_spip::all();
        $print=[
            'klasifikasi'=>$data,
        ];
        return response()->json($print);
    }

    public function listdata(){
        return Datatables::of(klasifikasi_sub_unsur_spip::all())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.klasifikasi_sub_unsur_spip.add_klasifikasi_sub_unsur_spip');
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
            'klasifikasi_sub_unsur_spip' => 'required',
        ]);
        klasifikasi_sub_unsur_spip::insert([
            'klasifikasi_sub_unsur_spip' => $request->klasifikasi_sub_unsur_spip,
        ]);
        return redirect('klasifikasisubunsurspip')->with('status','Sukses menyimpan data');
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
        $data = klasifikasi_sub_unsur_spip::find($id);
        return view('backend.klasifikasi_sub_unsur_spip.edit_klasifikasi_sub_unsur_spip',['data'=>$data]);
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
            'klasifikasi_sub_unsur_spip'=>'required',
        ]);
        klasifikasi_sub_unsur_spip::find($id)->update([
            'klasifikasi_sub_unsur_spip'=>$request->klasifikasi_sub_unsur_spip,
        ]);
        return redirect('klasifikasisubunsurspip')->with('status','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        klasifikasi_sub_unsur_spip::destroy($id);
    }
}
