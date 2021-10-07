<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PengendalianrisikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('pengendalian_risiko')
        ->select('pengendalian_risiko.*')
        ->get();
        return view('backend.pengendalian_risiko.pengendalian_risiko',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $klasifikasi = DB::table('klasifikasi_sub_unsur_spip')
        ->select('klasifikasi_sub_unsur_spip.*')
        ->get();
        $skorrisiko = DB::table('besaran_resiko')
        ->select([
            'besaran_resiko.id as idb',
            'besaran_resiko.nilai as nilaib',
            'besaran_resiko.*',
            'kriteria_probabilitas.id as idp',
            'kriteria_probabilitas.nilai as nilaip',
            'kriteria_probabilitas.nama as namap',
            'kriteria_probabilitas.*',
            'kriteria_dampak.id as idd',
            'kriteria_dampak.nilai as nilaid',
            'kriteria_dampak.nama as namad',
            'kriteria_dampak.*'])
        ->leftJoin('kriteria_probabilitas','kriteria_probabilitas.id','=','besaran_resiko.id_prob')
        ->leftJoin('kriteria_dampak','kriteria_dampak.id','=','besaran_resiko.id_dampak')
        ->orderby('besaran_resiko.id','desc')
        ->paginate(1);
        $frekuensiterakhir = DB::table('kriteria_probabilitas')->select('kriteria_probabilitas.*')->orderby('kriteria_probabilitas.id','desc')->paginate(1);
        $dampakterakhir = DB::table('kriteria_dampak')->select('kriteria_dampak.*')->orderby('kriteria_dampak.id','desc')->paginate(1);
        $risikoterakhir = DB::table('resiko_teridentifikasi')->select('resiko_teridentifikasi.*')->orderby('resiko_teridentifikasi.id','desc')->paginate(1);
        return view('backend.pengendalian_risiko.add_pengendalian_risiko', compact('risikoterakhir','dampakterakhir','frekuensiterakhir','klasifikasi','skorrisiko'));
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
            'departemen'=>'required',
            'id_departemen'=>'required',
            'id_manajemen'=>'required',
            'priode_penerapan'=>'required',
            'risiko'=>'required',
            'id_risiko'=>'required',
            'kegiatan_pengendalian'=>'required',
            'klasifikasi_sub_unsur_spip'=>'required',
            'penanggung_jawab'=>'required',
            'indikator_keluaran'=>'required',
            'target_waktu'=>'required',
            'status_pelaksanaan'=>'required',
            'id_peta_besaran_risiko'=>'required',
        ]);
        $respons_risiko = implode(", ", $request->respons_risiko);
        DB::table('pengendalian_risiko')->insert([
            'id_manajemen'=>$request->id_manajemen,
            'id_departemen'=>$request->id_departemen,
            'id_risiko'=>$request->id_risiko,
            'respons_risiko'=>$respons_risiko,
            'kegiatan_pengendalian'=>$request->kegiatan_pengendalian,
            'id_klasifikasi_sub_unsur_spip'=>$request->klasifikasi_sub_unsur_spip,
            'penanggung_jawab'=>$request->penanggung_jawab,
            'indikator_keluaran'=>$request->indikator_keluaran,
            'target_waktu'=>$request->target_waktu,
            'status_pelaksanaan'=>'Belum Dilaksanakan',
            'id_peta_besaran_risiko'=>$request->id_peta_besaran_risiko,
        ]);
        return redirect('pengendalian')->with('status','Berhasil menambah data');
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
        $klasifikasi = DB::table('klasifikasi_sub_unsur_spip')
        ->select('klasifikasi_sub_unsur_spip.*')
        ->get();
        $skorrisiko = DB::table('besaran_resiko')
        ->select([
            'besaran_resiko.id as idb',
            'besaran_resiko.nilai as nilaib',
            'besaran_resiko.*',
            'kriteria_probabilitas.id as idp',
            'kriteria_probabilitas.nilai as nilaip',
            'kriteria_probabilitas.nama as namap',
            'kriteria_probabilitas.*',
            'kriteria_dampak.id as idd',
            'kriteria_dampak.nilai as nilaid',
            'kriteria_dampak.nama as namad',
            'kriteria_dampak.*'])
        ->leftJoin('kriteria_probabilitas','kriteria_probabilitas.id','=','besaran_resiko.id_prob')
        ->leftJoin('kriteria_dampak','kriteria_dampak.id','=','besaran_resiko.id_dampak')
        ->orderby('besaran_resiko.id','desc')
        ->paginate(1);
        $frekuensiterakhir = DB::table('kriteria_probabilitas')->select('kriteria_probabilitas.*')->orderby('kriteria_probabilitas.id','desc')->paginate(1);
        $dampakterakhir = DB::table('kriteria_dampak')->select('kriteria_dampak.*')->orderby('kriteria_dampak.id','desc')->paginate(1);
        $risikoterakhir = DB::table('resiko_teridentifikasi')->select('resiko_teridentifikasi.*')->orderby('resiko_teridentifikasi.id','desc')->paginate(1);
        $data = DB::table('pengendalian_risiko')
        ->select('pengendalian_risiko.*','pelaksanaan_manajemen_risiko.*','resiko_teridentifikasi.pernyataan_risiko')
        ->leftJoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
        ->leftJoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
        ->where('pengendalian_risiko.id','=',$id)->get();
        $responsid = DB::table('pengendalian_risiko')
        ->select('pengendalian_risiko.*')
        ->where('pengendalian_risiko.id','=',$id)->get();
        $respons_risiko = DB::table('pengendalian_risiko')->select('pengendalian_risiko.*','implode(", ", "respons_risiko")');
        return view('backend.pengendalian_risiko.edit_pengendalian_risiko', compact('risikoterakhir','dampakterakhir','frekuensiterakhir','klasifikasi','skorrisiko','data','respons_risiko'));
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

    public function cari_departemen_manajemen(Request $request)
    {
        if($request->has('q')){
            $cari=$request->q;
            $data = DB::table('pelaksanaan_manajemen_risiko')
            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
            ->select('pelaksanaan_manajemen_risiko.*','departemen.id as idd','departemen.nama')
            ->where('nama','like','%'.$cari.'%')
            ->orderby('pelaksanaan_manajemen_risiko.priode_penerapan','asc')
            ->groupby('pelaksanaan_manajemen_risiko.faktur')
            ->get();
            return response()->json($data);
        }
    }
    public function cari_departemen_manajemen_hasil($id,$iddepartemen)
    {
        $data = DB::table('pelaksanaan_manajemen_risiko')
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->select('pelaksanaan_manajemen_risiko.*','departemen.id as idd','departemen.nama')
        ->where('pelaksanaan_manajemen_risiko.id',$id)
        ->get();
        $resiko = DB::table('resiko_teridentifikasi')
        ->where('id_departmen',$iddepartemen)
        ->get();
        $print=[
            'detail'=>$data,
            'resiko'=>$resiko
        ];
        return response()->json($print);
    }
    public function cari_risiko(Request $request)
    {
        if($request->has('q')){
            $cari=$request->q;
            $data = DB::table('resiko_teridentifikasi')
            ->select('id','kode_risiko')
            ->where('kode_risiko','like','%'.$cari.'%')
            ->get();
            return response()->json($data);
        }
    }
    public function cari_risiko_hasil($id)
    {
        $data = DB::table('resiko_teridentifikasi')
        ->where('id',$id)
        ->get();
        return response()->json($data);
    }
}
