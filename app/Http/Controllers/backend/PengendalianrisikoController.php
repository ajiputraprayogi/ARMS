<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\pengendalian_risiko;

class PengendalianrisikoController extends Controller
{
    //=======================================================================
    public function index()
    {
        $data = DB::table('pengendalian_risiko')->get();
        return view('backend.pengendalian_risiko.pengendalian_risiko',compact('data'));
    }

    
    //=======================================================================
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

    
    //=======================================================================
    public function store(Request $request)
    {
        $request->validate([
            'departemen'=>'required',
            'id_departemen'=>'required',
            'id_manajemen'=>'required',
            'priode_penerapan'=>'required',
            'risiko'=>'required',
            'id_risiko'=>'required',
            'id_akar_masalah'=>'required',
            'kode_tindak_pengendalian'=>'required',
            'kegiatan_pengendalian'=>'required',
            'klasifikasi_sub_unsur_spip'=>'required',
            'penanggung_jawab'=>'required',
            'indikator_keluaran'=>'required',
            'target_waktu'=>'required',
            'status_pelaksanaan'=>'required',
            'frekuensi_saat_ini'=>'required',
            'dampak_saat_ini'=>'required',
            'pr_saat_ini'=>'required',
            'besaran_saat_ini'=>'required',
        ]);
        $respons_risiko = implode(", ", $request->respons_risiko);
        DB::table('pengendalian_risiko')->insert([
            'faktur'=>$request->faktur,
            'id_manajemen'=>$request->id_manajemen,
            'id_departemen'=>$request->id_departemen,
            'id_risiko'=>$request->id_risiko,
            'id_akar_masalah'=>$request->id_akar_masalah,
            'kode_tindak_pengendalian'=>$request->kode_tindak_pengendalian,
            'respons_risiko'=>$respons_risiko,
            'kegiatan_pengendalian'=>$request->kegiatan_pengendalian,
            'id_klasifikasi_sub_unsur_spip'=>$request->klasifikasi_sub_unsur_spip,
            'penanggung_jawab'=>$request->penanggung_jawab,
            'indikator_keluaran'=>$request->indikator_keluaran,
            'target_waktu'=>$request->target_waktu,
            'status_pelaksanaan'=>'Belum Dilaksanakan',
            'frekuensi_saat_ini'=>$request->frekuensi_saat_ini,
            'dampak_saat_ini'=>$request->dampak_saat_ini,
            'pr_saat_ini'=>$request->pr_saat_ini,
            'besaran_saat_ini'=>$request->besaran_saat_ini,
        ]);
        return redirect('pengendalian')->with('status','Berhasil menambah data');
    }

   
    //=======================================================================
    public function show($id)
    {
        //
    }

    
    //=======================================================================
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
        ->select(DB::raw('pengendalian_risiko.*,resiko_teridentifikasi.pernyataan_risiko,klasifikasi_sub_unsur_spip.klasifikasi_sub_unsur_spip'))
        ->leftJoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pengendalian_risiko.id_manajemen')
        ->leftJoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
        ->leftJoin('klasifikasi_sub_unsur_spip','klasifikasi_sub_unsur_spip.id','=','pengendalian_risiko.id_klasifikasi_sub_unsur_spip')
        ->where('pengendalian_risiko.id','=',$id)->get();
        return view('backend.pengendalian_risiko.edit_pengendalian_risiko', compact('risikoterakhir','dampakterakhir','frekuensiterakhir','klasifikasi','skorrisiko','data'));
    }

    
    //=======================================================================
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'departemen'=>'required',
            'id_departemen'=>'required',
            'id_manajemen'=>'required',
            'priode_penerapan'=>'required',
            // 'risiko'=>'required',
            'id_risiko'=>'required',
            'kegiatan_pengendalian'=>'required',
            'klasifikasi_sub_unsur_spip'=>'required',
            'penanggung_jawab'=>'required',
            'indikator_keluaran'=>'required',
            'target_waktu'=>'required',
            'status_pelaksanaan'=>'required',
        ]);
        $respons_risiko = implode(", ", $request->respons_risiko);
        pengendalian_risiko::find($id)->update([
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
        ]);
        return redirect('pengendalian')->with('status','Berhasil mengubah data');
    }

    
    //=======================================================================
    public function destroy($id)
    {
        DB::table('pengendalian_risiko')->where('id',$id)->delete();
    }

    public function cari_departemen_manajemen(Request $request)
    {
        if($request->has('q')){
            $cari=$request->q;
            $data = DB::table('pelaksanaan_manajemen_risiko')
            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
            ->select('pelaksanaan_manajemen_risiko.*','departemen.id as idd','departemen.nama')
            ->where('nama','like','%'.$cari.'%')
            ->orderby('departemen.nama','asc')
            ->groupby('pelaksanaan_manajemen_risiko.faktur')
            ->get();
            return response()->json($data);
        }
    }
    public function cari_departemen_manajemen_hasil($id,$faktur)
    {
        $data = DB::table('pelaksanaan_manajemen_risiko')
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->select('pelaksanaan_manajemen_risiko.*','departemen.id as idd','departemen.nama')
        ->where('pelaksanaan_manajemen_risiko.id',$id)
        ->get();
        $resiko = DB::table('resiko_teridentifikasi')
        ->where('faktur',$faktur)
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
    public function cari_risiko_hasil($id,$kode_risiko)
    {
        $data = DB::table('resiko_teridentifikasi')
        // ->select('resiko_teridentifikasi.*','besaran_resiko.id as idbes','besaran_resiko.nilai as nilaibes','besaran_resiko.kode_warna','kriteria_probabilitas.nilai as nilpro', 'kriteria_dampak.nilai as nildam', 'kriteria_probabilitas.nama as nampro', 'kriteria_dampak.nama as namdam', 'kriteria_probabilitas.id as idpro', 'kriteria_dampak.id as iddam')
        // ->leftjoin('analisa_risiko','resiko_teridentifikasi.full_kode','=','analisa_risiko.kode_risiko')
        // ->leftjoin('besaran_resiko','analisa_risiko.id_besaran_residu','=','besaran_resiko.id')
        // ->leftjoin('kriteria_probabilitas', 'besaran_resiko.id_prob', '=', 'kriteria_probabilitas.id')
        // ->leftjoin('kriteria_dampak', 'besaran_resiko.id_dampak', '=', 'kriteria_dampak.id')
        ->where('resiko_teridentifikasi.id',$id)
        ->get();
        $akarmasalah = DB::table('analisa_masalah')
        ->where('kode_risiko',$kode_risiko)
        ->get();
        $print=[
            'detail'=>$data,
            'akarmasalah'=>$akarmasalah,
        ];
        return response()->json($print);
    }
    public function cari_akar_masalah_hasil($id)
    {
        $akarmasalah = DB::table('analisa_masalah')
        ->where('id',$id)
        ->get();
        $print=[
            'akarmasalah'=>$akarmasalah,
        ];
        return response()->json($print);
    }
    public function cario($frek, $dampak){
        $data = DB::table('besaran_resiko')
        ->select('besaran_resiko.*', 'kriteria_probabilitas.nilai as nilpro', 'kriteria_dampak.nilai as nildam', 'kriteria_probabilitas.nama as nampro', 'kriteria_dampak.nama as namdam', 'kriteria_probabilitas.id as idpro', 'kriteria_dampak.id as iddam')
        ->leftjoin('kriteria_probabilitas', 'besaran_resiko.id_prob', '=', 'kriteria_probabilitas.id')
        ->leftjoin('kriteria_dampak', 'besaran_resiko.id_dampak', '=', 'kriteria_dampak.id')
        ->where([['id_prob',$frek],['id_dampak', $dampak]])->get();
        return response()->json($data);
    }
}
