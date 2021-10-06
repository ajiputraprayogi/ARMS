<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\jeniskonteks;
use App\konteks;
use App\pemangku_kepentingan;
use DB;
use App\pelaksanaanmanajemenrisiko;
use App\departemen;

class ManajemenresikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('pelaksanaan_manajemen_risiko')
        ->select(DB::raw('pelaksanaan_manajemen_risiko.*,count(konteks.faktur_konteks) as totalkonteks,count(resiko_teridentifikasi.id_konteks) as totalrisiko,departemen.nama'))
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
        ->leftjoin('resiko_teridentifikasi', 'resiko_teridentifikasi.id_konteks','=','konteks.kode')
        ->orderby('pelaksanaan_manajemen_risiko.id','desc')
        ->groupby('pelaksanaan_manajemen_risiko.faktur')
        ->get();
        // $pelaksanaanmanajemenrisiko1 = DB::table('pelaksanaan_manajemen_risiko')
        // ->join('konteks', 'pelaksanaan_manajemen_risiko.faktur', '=', 'konteks.faktur_konteks')
        // ->select([
        //     'pelaksanaan_manajemen_risiko.faktur', 
        //     DB::raw("count(konteks.faktur_konteks) as count")
        //     ])->groupBy('pelaksanaan_manajemen_risiko.faktur')
        // ->get();
        return view('backend.manajemen_risiko.pelaksanaan_risiko',compact('data'));
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
            'nama_koordinator_pengelola_risiko'=>'required',
            'jabatan_koordinator_pengelola_risiko'=>'required',
            'priode_penerapan'=>'required',
            'selera_risiko'=>'required',
        ]);
        pelaksanaanmanajemenrisiko::insert([
            'faktur'=>$request->faktur,
            'id_departemen'=>$request->id_departemen,
            'nama_pemilik_risiko'=>$request->nama_pemilik_risiko,
            'jabatan_pemilik_risiko'=>$request->jabatan_pemilik_risiko,
            'nama_koordinator_pengelola_risiko'=>$request->nama_koordinator_pengelola_risiko,
            'jabatan_koordinator_pengelola_risiko'=>$request->jabatan_koordinator_pengelola_risiko,
            'priode_penerapan'=>$request->priode_penerapan,
            'selera_risiko'=>$request->selera_risiko,
        ]);
        $up = DB::table('konteks')->where('faktur_konteks', '=', $request->faktur)->update([
            'id_departemen'=>$request->id_departemen,
        ]);
        return redirect('/pelaksanaan')->with('status','Sukses menyimpan data');
  //
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
        $jeniskonteks = jeniskonteks::all();
        $konteks = konteks::leftJoin('jenis_konteks','konteks.id_konteks','=','jenis_konteks.id')
        ->select('jenis_konteks.id as idjk','jenis_konteks.*','konteks.*')->where('faktur_konteks',$id)->get();
        $pemangku_kepentingan = pemangku_kepentingan::all()->where('faktur_pemangku',$id);
        $data = DB::table('pelaksanaan_manajemen_risiko')
        ->select(DB::raw('pelaksanaan_manajemen_risiko.*,count(*) as totalkonteks,departemen.nama'))
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
        ->orderby('pelaksanaan_manajemen_risiko.id','desc')
        ->groupby('pelaksanaan_manajemen_risiko.faktur')
        ->where('pelaksanaan_manajemen_risiko.faktur',$id)
        ->get();
        $manajemenrisiko = pelaksanaanmanajemenrisiko::all()->where('faktur',$id);
        return view('backend.manajemen_risiko.edit_pelaksanaan_risiko',compact('data','konteks','pemangku_kepentingan','jeniskonteks','manajemenrisiko'));
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
            'faktur'=>'required',
            'id_departemen'=>'required',
            'nama_pemilik_risiko'=>'required',
            'jabatan_pemilik_risiko'=>'required',
            'nama_koordinator_pengelola_risiko'=>'required',
            'jabatan_koordinator_pengelola_risiko'=>'required',
            'priode_penerapan'=>'required',
            'selera_risiko'=>'required',
        ]);
        pelaksanaanmanajemenrisiko::find($id)->update([
            'faktur'=>$request->faktur,
            'id_departemen'=>$request->id_departemen,
            'nama_pemilik_risiko'=>$request->nama_pemilik_risiko,
            'jabatan_pemilik_risiko'=>$request->jabatan_pemilik_risiko,
            'nama_koordinator_pengelola_risiko'=>$request->nama_koordinator_pengelola_risiko,
            'jabatan_koordinator_pengelola_risiko'=>$request->jabatan_koordinator_pengelola_risiko,
            'priode_penerapan'=>$request->priode_penerapan,
            'selera_risiko'=>$request->selera_risiko,
        ]);
        $up = DB::table('konteks')->where('faktur_konteks', '=', $request->faktur)->update([
            'id_departemen'=>$request->id_departemen,
        ]);
        return redirect('/pelaksanaan')->with('status','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $faktur = $request->faktur;
        pelaksanaanmanajemenrisiko::destroy($id);
        konteks::destroy($faktur);
        pemangku_kepentingan::destroy($faktur);
    }

    public function simpaneditkonteks(Request $request, $id){
        $request->validate([
            'faktur_konteks'=>'required',
            'kode'=>'required',
            'nama'=>'required',
            'id_konteks'=>'required',
            'detail_ancaman'=>'required',
            'indikator_kinerja_kegiatan'=>'required',
        ]);
        konteks::insert([
            'faktur_konteks'=>$request->faktur_konteks,
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'id_konteks'=>$request->id_konteks,
            'detail_ancaman'=>$request->detail_ancaman,
            'indikator_kinerja_kegiatan'=>$request->indikator_kinerja_kegiatan,
        ]);
        return redirect('edit-pelaksanaan/'.$id)->with('statuskonteks','Sukses menambah data');
    }

    public function simpanediteditkonteks(Request $request, $id){
        $request->validate([
            'kode'=>'required',
            'nama'=>'required',
            'id_konteks'=>'required',
            'detail_ancaman'=>'required',
            'indikator_kinerja_kegiatan'=>'required',
        ]);
        $faktur = $request->faktur;
        konteks::find($id)->update([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'id_konteks'=>$request->id_konteks,
            'detail_ancaman'=>$request->detail_ancaman,
            'indikator_kinerja_kegiatan'=>$request->indikator_kinerja_kegiatan,
        ]);
        return redirect('edit-pelaksanaan/'.$faktur)->with('statuskonteks','Sukses mengubah data');
    }

    public function simpaneditpemangku(Request $request, $id){
        $request->validate([
            'faktur_pemangku'=>'required',
            'pemangku_kepentingan'=>'required',
            'keterangan'=>'required',
        ]);
        pemangku_kepentingan::insert([
            'faktur_pemangku'=>$request->faktur_pemangku,
            'pemangku_kepentingan'=>$request->pemangku_kepentingan,
            'keterangan'=>$request->keterangan,
        ]);
        return redirect('edit-pelaksanaan/'.$id)->with('statuspemangku','Sukses mengubah data');
    }

    public function simpanediteditpemangku(Request $request, $id){
        $request->validate([
            'pemangku_kepentingan'=>'required',
            'keterangan'=>'required',
        ]);
        $faktur = $request->faktur;
        pemangku_kepentingan::find($id)->update([
            'pemangku_kepentingan'=>$request->pemangku_kepentingan,
            'keterangan'=>$request->keterangan,
        ]);
        return redirect('edit-pelaksanaan/'.$faktur)->with('statuspemangku','Sukses mengubah data');
    }
}
