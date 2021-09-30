<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\besaranresiko;
use DataTables;
use DB;

class PetabesaranresikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data=DB::table('besaran_resiko')
        // ->join('kriteria_probabilitas', 'besaran_resiko.id_prob', '=', 'kriteria_probabilitas.id')->get();
        return view('backend.peta_besaran_resiko.index');
    }

    public function listdata(){
        return Datatables::of(DB::table('besaran_resiko')->select('besaran_resiko.id', 'besaran_resiko.id_prob', 'besaran_resiko.id_dampak', 'besaran_resiko.nilai', 'besaran_resiko.kode_warna', 'kriteria_dampak.nilai as nilai_dampak' , 'kriteria_probabilitas.nilai as nilai_probabilitas')
        ->join('kriteria_probabilitas', 'besaran_resiko.id_prob', '=', 'kriteria_probabilitas.id')->join('kriteria_dampak', 'besaran_resiko.id_dampak', '=', 'kriteria_dampak.id')->get())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $probabilitas = DB::table('kriteria_probabilitas')->orderby('id','desc')->get();
        $dampak = DB::table('kriteria_dampak')->get();
        return view('backend.peta_besaran_resiko.add_peta_besaran_resiko',['probabilitas'=>$probabilitas, 'dampak'=>$dampak]);
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
            'warna' => 'required',
            'prob' => 'required',
            'dampak' => 'required',
        ]);
        besaranresiko::insert([
            'kode_warna' => $request->warna,
            'id_prob' => $request->prob,
            'id_dampak' => $request->dampak,
            'nilai' => $request->nilai,
        ]);
        return redirect('petabesaranresiko')->with('status','Berhasil menyimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= DB::table('besaran_resiko')->select('besaran_resiko.kode_warna', 'besaran_resiko.id', 'besaran_resiko.id_prob', 'besaran_resiko.id_dampak', 'besaran_resiko.nilai as nilai_besaran', 'kriteria_probabilitas.id as id_probabilitas', 'kriteria_probabilitas.nama as nama_probabilitas', 'kriteria_probabilitas.nilai as nilai_probabilitas'
        , 'kriteria_dampak.id as id_dampak', 'kriteria_dampak.nama as nama_damp', 'kriteria_dampak.nilai as nilai_damp')
        ->leftjoin('kriteria_probabilitas', 'besaran_resiko.id_prob', '=', 'kriteria_probabilitas.id')
        ->leftjoin('kriteria_dampak', 'besaran_resiko.id_dampak', '=', 'kriteria_dampak.id')
        ->where('besaran_resiko.id','=',$id)
        ->get();
        // dd($data);
        // $data2= DB::table('besaran_resiko')->select('besaran_resiko.*', 'kriteria_dampak.*')
        // ->leftjoin('kriteria_dampak', 'besaran_resiko.id_dampak', '=', 'kriteria_dampak.id')
        // ->where('besaran_resiko.id','=',$id)
        // ->get();
        // $nilkod = DB::table('besaran_resiko')->select('kode_warna', 'nilai')->where('id', $id)->get();
        // dd($data);
        // $link= DB::table('besaran_resiko')->where('id',$id)->get();
        
        $probabilitas = DB::table('kriteria_probabilitas')->select('*')->get();
        $dampak = DB::table('kriteria_dampak')->select('*')->get();
        return view('backend.peta_besaran_resiko.edit',['data'=>$data, 'probabilitas'=>$probabilitas, 'dampak'=>$dampak]);
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
    //    $prob=$request->dampak;
    //    dd($prob);
        DB::table('besaran_resiko')->where('id', $id)->update([
            'id_prob' => $request->probabilitas,
            'id_dampak' => $request->dampak,
            'nilai' => $request->nilai,
            'kode_warna' => $request->warna,
        ]);
        
        return redirect('petabesaranresiko')->with('status','Berhasil menyimpan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        besaranresiko::destroy($id);
    }
}
