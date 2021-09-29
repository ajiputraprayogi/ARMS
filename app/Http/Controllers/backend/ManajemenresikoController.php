<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\jeniskonteks;
use App\konteks;
use App\pemangku_kepentingan;
use DB;

class ManajemenresikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.manajemen_risiko.pelaksanaan_risiko');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jeniskonteks = jeniskonteks::all();
        $tgl=date("Y-m-d");
        $min=date("-");
        $fk=DB::table("pelaksanaan_manajemen_risiko")
        ->select(DB::Raw("MAX(RIGHT(faktur,5)) as kd_max"));
        if($fk->count()>0){
        // $finalkode="DVN".$tgl."00001";
            foreach($fk->get() as $fak){
                $tmp=((int)$fak->kd_max)+1;
                $finalkode="FK".$tgl.$min.sprintf('%05s',$tmp);
            }
        }else{
            $finalkode="FK".$tgl.$min."00001";
        }
        $konteks = konteks::leftJoin('jenis_konteks','konteks.id_konteks','=','jenis_konteks.id')
        ->select('jenis_konteks.id as idjk','jenis_konteks.*','konteks.*')->where('faktur_konteks',$finalkode)->get();
        $pemangku_kepentingan = pemangku_kepentingan::all()->where('faktur_pemangku',$finalkode);
        // $data = konteks::leftJoin('jenis_konteks','konteks.id_konteks','=','jenis_konteks.id')
        // ->select('jenis_konteks.id as idjk','jenis_konteks.*','konteks.*')->where('faktur_konteks',$finalkode)->get();
        return view('backend.manajemen_risiko.add_pelaksanaan_risiko',['jeniskonteks'=>$jeniskonteks,'konteks'=>$konteks,'pemangku_kepentingan'=>$pemangku_kepentingan]);
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
            'faktur'=>'required',
            'id_departemen'=>'required',
            'nama_pemilik_risiko'=>'required',
            'jabatan_pemilik_risiko'=>'required',
            'nama_koordinator_pemilik_risiko'=>'required',
            'jabatan_koordinator_pemilik_risiko'=>'required',
            'priode_penerapan'=>'required',
            'selera_risiko'=>'required',
        ]);
        pelaksanaanmanajemenrisiko::insert([
            'faktur'=>$request->faktur,
            'id_departemen'=>$request->id_departemen,
            'nama_pemilik_risiko'=>$request->nama_pemilik_risiko,
            'jabatan_pemilik_risiko'=>$request->jabatan_pemilik_risiko,
            'nama_koordinator_pemilik_risiko'=>$request->nama_koordinator_pemilik_risiko,
            'jabatan_koordinator_pemilik_risiko'=>$request->jabatan_koordinator_pemilik_risiko,
            'priode_penerapan'=>$request->priode_penerapan,
            'selera_risiko'=>$request->selera_risiko,
        ]);
        return redirect('/pelaksanaan')->with('status','Sukses menyimpan data');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
