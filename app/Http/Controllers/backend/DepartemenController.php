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
        // $data = departemen::all();
        $data = DB::table('departemen')
        ->select('departemen.*','a.nama as namadep')
        ->leftjoin('departemen as a','a.id','=','departemen.id_bawahan')
        ->get();
        return view('backend.departemen.index',['data'=>$data]);
    }

    public function listdata(){
        return Datatables::of($data = DB::table('departemen')
        ->select('departemen.*','a.nama as namadep')
        ->leftjoin('departemen as a','a.mengelola_risiko','=','departemen.id')
        ->get())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = departemen::all();
        return view('backend.departemen.add_departemen',compact('data'));
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
        // if($request->mengelola_risiko == ''){
        //     $id_departemen = '';
        // }else{
        //     $id_departemen = implode(",",$request->mengelola_risiko);
        // }
        $mengelola_risiko = explode(",", $request->mengelola_risiko);
            if(count($mengelola_risiko)<2){
                $id = $mengelola_risiko[0];
                $id_atasan = $mengelola_risiko[0];
            }else{
                $id = $mengelola_risiko[0];
                $id_atasan = $mengelola_risiko[1];
            }
        departemen::insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'id_bawahan'=>$id,
            'id_atasan'=>$id_atasan,
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
        $data = DB::table('departemen')
        ->select('departemen.*','a.nama as namadep')
        ->leftjoin('departemen as a','a.id','=','departemen.id_bawahan')
        ->where('departemen.id',$id)
        ->get();
        foreach($data as $row){
            $datadep = DB::table('departemen')
            ->select('departemen.*')
            ->where([['id_atasan','!=',$row->id],['id_atasan','!=',$row->id_bawahan]])
            ->get();
        }
        return view('backend.departemen.edit_departemen',['data'=>$data,'datadep'=>$datadep]);
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
        // if($request->mengelola_risiko == ''){
        //     $id_departemen = '';
        // }else{
        //     $id_departemen = implode(",",$request->mengelola_risiko);
        // }
        $mengelola_risiko = explode(",", $request->mengelola_risiko);
        if(count($mengelola_risiko)<2){
            $id_bawahan = $mengelola_risiko[0];
            $id_atasan = $mengelola_risiko[0];
        }else{
            $id_bawahan = $mengelola_risiko[0];
            $id_atasan = $mengelola_risiko[1];
        }
        departemen::find($id)->update([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'id_atasan'=>$id_atasan,
            'id_bawahan'=>$id_bawahan,
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

    public function cari_departemen_hasil($id){
        $data=DB::table('departemen')
        ->where('id',$id)
        ->get();
        return response()->json($data);
    }
}
