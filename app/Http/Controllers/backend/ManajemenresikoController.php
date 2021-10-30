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
use Carbon\Carbon;

class ManajemenresikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $infosearch ='';
        $active_departemen = 'Semua Departemen';
        $active_tahun = 'Semua Tahun';

        if($request->has('departemen')){
            if($request->departemen!='Semua Departemen'){
                $active_departemen = $request->departemen;
            }else{
                $active_departemen = 'Semua Departemen';
            }
        }

        if($request->has('tahun')){
            if($request->tahun!='Semua Tahun'){
                $active_tahun = $request->tahun;
            }else{
                $active_tahun = 'Semua Tahun';
            }
        }
        $departemen = DB::table('pelaksanaan_manajemen_risiko')
        ->select(DB::raw('pelaksanaan_manajemen_risiko.faktur,departemen.nama,departemen.id'))
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
        ->get();

        $tahun = DB::table('pelaksanaan_manajemen_risiko')
        ->groupby('priode_penerapan')
        ->get();

        if($active_departemen!='Semua Departemen'){
            if($active_tahun!='Semua Tahun'){
                $data = DB::table('pelaksanaan_manajemen_risiko')
                ->select(DB::raw('pelaksanaan_manajemen_risiko.*,count(konteks.faktur_konteks) as totalkonteks,count(resiko_teridentifikasi.kode_konteks) as totalrisiko,departemen.nama'))
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
                ->leftjoin('resiko_teridentifikasi', 'resiko_teridentifikasi.kode_konteks','=','konteks.kode')
                ->where([['departemen.id','=',$active_departemen],['priode_penerapan','=',$active_tahun]])
                ->orderby('pelaksanaan_manajemen_risiko.id','desc')
                ->groupby('pelaksanaan_manajemen_risiko.faktur')
                ->paginate(50);
               // dd($data);
            }else{
                $data = DB::table('pelaksanaan_manajemen_risiko')
                ->select(DB::raw('pelaksanaan_manajemen_risiko.*,count(konteks.faktur_konteks) as totalkonteks,count(resiko_teridentifikasi.kode_konteks) as totalrisiko,departemen.nama'))
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
                ->leftjoin('resiko_teridentifikasi', 'resiko_teridentifikasi.kode_konteks','=','konteks.kode')
                ->where('pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen)
                ->orderby('pelaksanaan_manajemen_risiko.id','desc')
                ->groupby('pelaksanaan_manajemen_risiko.faktur')
                ->paginate(50);
            }
        }else{
            if($active_tahun!='Semua Tahun'){
                $data = DB::table('pelaksanaan_manajemen_risiko')
                ->select(DB::raw('pelaksanaan_manajemen_risiko.*,count(konteks.faktur_konteks) as totalkonteks,count(resiko_teridentifikasi.kode_konteks) as totalrisiko,departemen.nama'))
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
                ->leftjoin('resiko_teridentifikasi', 'resiko_teridentifikasi.kode_konteks','=','konteks.kode')
                ->where('pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun)
                ->orderby('pelaksanaan_manajemen_risiko.id','desc')
                ->groupby('pelaksanaan_manajemen_risiko.faktur')
                ->paginate(50);
            }else{
                $data = DB::table('pelaksanaan_manajemen_risiko')
                ->select(DB::raw('pelaksanaan_manajemen_risiko.*,count(konteks.faktur_konteks) as totalkonteks,count(resiko_teridentifikasi.kode_konteks) as totalrisiko,departemen.nama'))
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
                ->leftjoin('resiko_teridentifikasi', 'resiko_teridentifikasi.kode_konteks','=','konteks.kode')
                ->orderby('pelaksanaan_manajemen_risiko.id','desc')
                ->groupby('pelaksanaan_manajemen_risiko.faktur')
                ->paginate(50);
            }
        }


        return view('backend.manajemen_risiko.pelaksanaan_risiko',compact('data','departemen','tahun','active_departemen','active_tahun'));
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
                $finalkode=sprintf('%00s',$tmp);
            }
        }else{
            $finalkode="1";
        }
        $konteks = konteks::leftJoin('jenis_konteks','konteks.id_konteks','=','jenis_konteks.id')
        ->select('jenis_konteks.id as idjk','jenis_konteks.*','konteks.*')->where('faktur_konteks',$finalkode)->get();
        $pemangku_kepentingan = pemangku_kepentingan::all()->where('faktur_pemangku',$finalkode);
        // $data = konteks::leftJoin('jenis_konteks','konteks.id_konteks','=','jenis_konteks.id')
        // ->select('jenis_konteks.id as idjk','jenis_konteks.*','konteks.*')->where('faktur_konteks',$finalkode)->get();
        return view('backend.manajemen_risiko.add_pelaksanaan_risiko',['finalkode'=>$finalkode,'jeniskonteks'=>$jeniskonteks,'konteks'=>$konteks,'pemangku_kepentingan'=>$pemangku_kepentingan]);
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
            'priode_penerapan_awal_akhir'=>'required',
            'selera_risiko'=>'required',
        ]);
        if($request->has('priode_penerapan_awal_akhir')){
            $priode_penerapan_awal_akhir = explode(" to ", $request->priode_penerapan_awal_akhir);
            if(count($priode_penerapan_awal_akhir)<2){
                $tglsatu = $priode_penerapan_awal_akhir[0];
                $tgldua = $priode_penerapan_awal_akhir[0];
            }else{
                $tglsatu = $priode_penerapan_awal_akhir[0];
                $tgldua = $priode_penerapan_awal_akhir[1];
            }
        }
        pelaksanaanmanajemenrisiko::insert([
            'faktur'=>$request->faktur,
            'id_departemen'=>$request->id_departemen,
            'nama_pemilik_risiko'=>$request->nama_pemilik_risiko,
            'jabatan_pemilik_risiko'=>$request->jabatan_pemilik_risiko,
            'nama_koordinator_pengelola_risiko'=>$request->nama_koordinator_pengelola_risiko,
            'jabatan_koordinator_pengelola_risiko'=>$request->jabatan_koordinator_pengelola_risiko,
            'priode_penerapan'=>$request->priode_penerapan,
            'priode_penerapan_awal'=>Carbon::createFromFormat('d-m-Y',$tglsatu)->format('Y-m-d'),
            'priode_penerapan_akhir'=>Carbon::createFromFormat('d-m-Y',$tgldua)->format('Y-m-d'),
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
            'priode_penerapan_awal_akhir'=>'required',
            'selera_risiko'=>'required',
        ]);
        if($request->has('priode_penerapan_awal_akhir')){
            $priode_penerapan_awal_akhir = explode(" to ", $request->priode_penerapan_awal_akhir);
            if(count($priode_penerapan_awal_akhir)<2){
                $tglsatu = $priode_penerapan_awal_akhir[0];
                $tgldua = $priode_penerapan_awal_akhir[0];
            }else{
                $tglsatu = $priode_penerapan_awal_akhir[0];
                $tgldua = $priode_penerapan_awal_akhir[1];
            }
        }
        pelaksanaanmanajemenrisiko::find($id)->update([
            'faktur'=>$request->faktur,
            'id_departemen'=>$request->id_departemen,
            'nama_pemilik_risiko'=>$request->nama_pemilik_risiko,
            'jabatan_pemilik_risiko'=>$request->jabatan_pemilik_risiko,
            'nama_koordinator_pengelola_risiko'=>$request->nama_koordinator_pengelola_risiko,
            'jabatan_koordinator_pengelola_risiko'=>$request->jabatan_koordinator_pengelola_risiko,
            'priode_penerapan'=>$request->priode_penerapan,
            'priode_penerapan_awal'=>Carbon::createFromFormat('d-m-Y',$tglsatu)->format('Y-m-d'),
            'priode_penerapan_akhir'=>Carbon::createFromFormat('d-m-Y',$tgldua)->format('Y-m-d'),
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
    public function destroy($id)
    {
        // $faktur = $request->faktur;
        pelaksanaanmanajemenrisiko::where('faktur', $id)->delete();
        konteks::where('faktur_konteks', $id)->delete();
        pemangku_kepentingan::where('faktur_pemangku', $id)->delete();
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

    //===========================================================================================================
    public function carikonteks($kode){
        $data = konteks::leftJoin('jenis_konteks','konteks.id_konteks','=','jenis_konteks.id')
        ->select('jenis_konteks.id as idjk','jenis_konteks.*','konteks.*')->where('faktur_konteks',$kode)->get();
        return response()->json($data);
    }

    //===========================================================================================================
    public function caridetailkonteks($kode){
        $data = konteks::where('id',$kode)->get();
        return response()->json($data);
    }
}
