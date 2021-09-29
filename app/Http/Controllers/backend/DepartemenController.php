<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\departemen;
use DataTables;
use Illuminate\Support\Facades\DB;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = departemen::all();
        return view('backend.departemen.index',['data'=>$data]);
    }

    public function listdata(){
        return Datatables::of(departemen::all())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.departemen.add_departemen');
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
            'nama' => 'required',
        ]);
        departemen::insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);
        return redirect('departemen')->with('status','Sukses menyimpan data');
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
        $data = departemen::find($id);
        return view('backend.departemen.edit_departemen',['data'=>$data]);
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
            'nama'=>'required',
        ]);
        departemen::find($id)->update([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
        ]);
        return redirect('departemen')->with('status','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        departemen::destroy($id);
    }

    public function cari_departemen(Request $request){
        if($request->has('q')){
            $cari=$request->q;
            $data=DB::table('departemen')
            ->select('id','nama')
            ->where('nama','like','%'.$cari.'%')
            ->get();
            return response()->json($data);
        }
    }
}
