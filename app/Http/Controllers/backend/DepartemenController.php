<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\departemen;
use DataTables;
use Illuminate\Support\Facades\DB;

class DepartemenController extends Controller
{
    public function caridepartemen($id)
    {
        $id_dep=[];
        $id_atasan = [];
        $i_limit=1;
        array_push($id_atasan,$id);
        //dd(count($id_atasan));

        for ($i=0; $i <$i_limit ; $i++) { 
            for ($j=0; $j < count($id_atasan) ; $j++) { 
                $data = DB::table('departemen')->where('id_atasan',$id_atasan[$j])->get();
                if(count($data)>0){
                    foreach($data as $row){
                        array_push($id_atasan,$row->id);
                    }
                    $i_limit++;
                }else{
                    $i_limit=$i;
                }
            }
        }
        // dd($id_atasan);
        return $id_atasan;
    }

    public function index()
    {
        // $this->caridepartemen(15);
        // $data = departemen::all();
        $data = DB::table('departemen')
        ->select('departemen.*','a.nama as namadep')
        ->leftjoin('departemen as a','a.id','=','departemen.id_atasan')
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
        // $mengelola_risiko = explode(",", $request->mengelola_risiko);
        //     if(count($mengelola_risiko)<2){
        //         $id = $mengelola_risiko[0];
        //         $id_atasan = $mengelola_risiko[0];
        //     }else{
        //         $id = $mengelola_risiko[0];
        //         $id_atasan = $mengelola_risiko[1];
        //     }
        departemen::insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            // 'id_bawahan'=>$id,
            'id_atasan'=>$request->mengelola_risiko,
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
        $id_dep=[];
        $id_atasan = [];
        $i_limit=1;
        array_push($id_atasan,$id);
        //dd(count($id_atasan));

        for ($i=0; $i <$i_limit ; $i++) { 
            for ($j=0; $j < count($id_atasan) ; $j++) { 
                $data = DB::table('departemen')->where('id_atasan',$id_atasan[$j])->get();
                if(count($data)>0){
                    foreach($data as $row){
                        array_push($id_atasan,$row->id);
                    }
                    $i_limit++;
                }else{
                    $i_limit=$i;
                }
            }
        }
        // dd($id_atasan);
        // return $id_atasan;
        $data = DB::table('departemen')
        ->select('departemen.*','a.nama as namadep')
        ->leftjoin('departemen as a','a.id','=','departemen.id_atasan')
        ->where('departemen.id',$id)
        ->get();
        foreach($data as $row){
            $datadep = DB::table('departemen')
            ->select('departemen.*')
            ->whereNotIn('id',$id_atasan)
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
        // $mengelola_risiko = explode(",", $request->mengelola_risiko);
        // if(count($mengelola_risiko)<2){
        //     $id_bawahan = $mengelola_risiko[0];
        //     $id_atasan = $mengelola_risiko[0];
        // }else{
        //     $id_bawahan = $mengelola_risiko[0];
        //     $id_atasan = $mengelola_risiko[1];
        // }
        departemen::find($id)->update([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'id_atasan'=>$request->mengelola_risiko,
            // 'id_bawahan'=>$id_bawahan,
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
