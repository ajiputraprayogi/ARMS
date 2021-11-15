<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class PelaksanaanpengendalianrisikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ===================================
        $id = Auth::user()->id_departemen;
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
        // ===================================

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

        $departemen =DB::table('pelaksanaan_pengendalian_risiko')
        ->select([
            'pelaksanaan_manajemen_risiko.faktur',
            'pelaksanaan_pengendalian_risiko.*',
            'departemen.nama'
        ])
        ->leftjoin('pengendalian_risiko','pengendalian_risiko.id','=','pelaksanaan_pengendalian_risiko.id_pengendalian')
        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
        ->groupby('departemen.id')
        ->orderby('id','desc')->get();
        // dd($departemen);

        $tahun = DB::table('pelaksanaan_manajemen_risiko')
        ->groupby('priode_penerapan')
        ->get();

        if($active_departemen!='Semua Departemen'){
            if($active_tahun!='Semua Tahun'){
                $data = DB::table('pelaksanaan_pengendalian_risiko')
                ->select([
                    'pelaksanaan_pengendalian_risiko.*',
                    'pengendalian_risiko.kode_tindak_pengendalian','pengendalian_risiko.kegiatan_pengendalian','pengendalian_risiko.penanggung_jawab','pengendalian_risiko.status_pelaksanaan',
                    'resiko_teridentifikasi.full_kode',
                ])
                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id','=','pelaksanaan_pengendalian_risiko.id_pengendalian')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun]])
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('id','desc')->get();
                // dd($data);
            }else{
                $data = DB::table('pelaksanaan_pengendalian_risiko')
                ->select([
                    'pelaksanaan_pengendalian_risiko.*',
                    'pengendalian_risiko.kode_tindak_pengendalian','pengendalian_risiko.kegiatan_pengendalian','pengendalian_risiko.penanggung_jawab','pengendalian_risiko.status_pelaksanaan',
                    'resiko_teridentifikasi.full_kode',
                ])
                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id','=','pelaksanaan_pengendalian_risiko.id_pengendalian')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen]])
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('id','desc')->get();
                // dd($data);
            }
        }else{
            if($active_tahun!='Semua Tahun'){
                $data = DB::table('pelaksanaan_pengendalian_risiko')
                ->select([
                    'pelaksanaan_pengendalian_risiko.*',
                    'pengendalian_risiko.kode_tindak_pengendalian','pengendalian_risiko.kegiatan_pengendalian','pengendalian_risiko.penanggung_jawab','pengendalian_risiko.status_pelaksanaan',
                    'resiko_teridentifikasi.full_kode',
                ])
                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id','=','pelaksanaan_pengendalian_risiko.id_pengendalian')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun]])
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('id','desc')->get();
                // dd($data);
            }else{
                $data = DB::table('pelaksanaan_pengendalian_risiko')
                ->select([
                    'pelaksanaan_pengendalian_risiko.*',
                    'pengendalian_risiko.kode_tindak_pengendalian','pengendalian_risiko.kegiatan_pengendalian','pengendalian_risiko.penanggung_jawab','pengendalian_risiko.status_pelaksanaan',
                    'resiko_teridentifikasi.full_kode',
                ])
                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id','=','pelaksanaan_pengendalian_risiko.id_pengendalian')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->orderby('id','desc')->get();
                // dd($data);
            }
        }
        return view('backend.pelaksanaan_pengendalian_risiko.index',compact('data','departemen','active_departemen','tahun','active_tahun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pelaksanaan_pengendalian_risiko.add');
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
            'risiko'=>'required',
            'kode_tindak_pengendalian'=>'required',
            'realisasi_waktu'=>'required',
            'hambatan'=>'required',
        ]);
        DB::table('pelaksanaan_pengendalian_risiko')->insert([
            'id_pengendalian'=>$request->id_pengendalian,
            'realisasi_waktu'=>$request->realisasi_waktu,
            'hambatan'=>$request->hambatan,
        ]);
        $up = DB::table('pengendalian_risiko')->where('id','=',$request->id_pengendalian)->update([
            'status_pelaksanaan'=>$request->status_pelaksanaan,
        ]); 
        return redirect('pelaksanaan-pengendalian')->with('status','Berhasil menyimpan data');
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
        $data = DB::table('pelaksanaan_pengendalian_risiko')
        ->select([
            'pelaksanaan_pengendalian_risiko.*',
            'pengendalian_risiko.id as idpr','pengendalian_risiko.kode_tindak_pengendalian','pengendalian_risiko.kegiatan_pengendalian','pengendalian_risiko.penanggung_jawab','pengendalian_risiko.status_pelaksanaan','pengendalian_risiko.kegiatan_pengendalian','pengendalian_risiko.penanggung_jawab','pengendalian_risiko.indikator_keluaran','pengendalian_risiko.target_waktu','pengendalian_risiko.status_pelaksanaan',
            'resiko_teridentifikasi.id as idr','resiko_teridentifikasi.full_kode','resiko_teridentifikasi.pernyataan_risiko',
            'pelaksanaan_manajemen_risiko.id as idpmr','pelaksanaan_manajemen_risiko.id_departemen','pelaksanaan_manajemen_risiko.priode_penerapan as priode_penerapanpmr',
            'departemen.nama',
        ])
        ->leftjoin('pengendalian_risiko','pengendalian_risiko.id','=','pelaksanaan_pengendalian_risiko.id_pengendalian')
        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pengendalian_risiko.id_risiko')
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','pengendalian_risiko.faktur')
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->orderby('id','desc')
        ->where('pelaksanaan_pengendalian_risiko.id',$id)
        ->get();
        return view('backend.pelaksanaan_pengendalian_risiko.edit',compact('data'));
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
            'departemen'=>'required',
            'risiko'=>'required',
            'kode_tindak_pengendalian'=>'required',
            'realisasi_waktu'=>'required',
            'hambatan'=>'required',
        ]);
        DB::table('pelaksanaan_pengendalian_risiko')->where('id',$id)->update([
            'id_pengendalian'=>$request->id_pengendalian,
            'realisasi_waktu'=>$request->realisasi_waktu,
            'hambatan'=>$request->hambatan,
        ]);
        $up = DB::table('pengendalian_risiko')->where('id','=',$request->id_pengendalian)->update([
            'status_pelaksanaan'=>$request->status_pelaksanaan,
        ]); 
        return redirect('pelaksanaan-pengendalian')->with('status','Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pelaksanaan_pengendalian_risiko')->where('id',$id)->delete();
    }
    public function cari_departemen_manajemen_pelaksanaan(Request $request)
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
    public function cari_departemen_manajemen_pelaksanaan_hasil($id,$faktur)
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
    public function cari_risiko_pelaksanaan_hasil($id,$faktur)
    {
        $data = DB::table('resiko_teridentifikasi')
        // ->select('resiko_teridentifikasi.*','besaran_resiko.id as idbes','besaran_resiko.nilai as nilaibes','besaran_resiko.kode_warna','kriteria_probabilitas.nilai as nilpro', 'kriteria_dampak.nilai as nildam', 'kriteria_probabilitas.nama as nampro', 'kriteria_dampak.nama as namdam', 'kriteria_probabilitas.id as idpro', 'kriteria_dampak.id as iddam')
        // ->leftjoin('analisa_risiko','resiko_teridentifikasi.full_kode','=','analisa_risiko.kode_risiko')
        // ->leftjoin('besaran_resiko','analisa_risiko.id_besaran_residu','=','besaran_resiko.id')
        // ->leftjoin('kriteria_probabilitas', 'besaran_resiko.id_prob', '=', 'kriteria_probabilitas.id')
        // ->leftjoin('kriteria_dampak', 'besaran_resiko.id_dampak', '=', 'kriteria_dampak.id')
        ->where('resiko_teridentifikasi.id',$id)
        ->get();
        $pengendalian = DB::table('pengendalian_risiko')
        ->where('pengendalian_risiko.status_pelaksanaan','!=','Selesai Dilaksanakan')
        ->where('pengendalian_risiko.id_risiko',$id)
        ->get();
        $print=[
            'detail'=>$data,
            'pengendalian'=>$pengendalian,
        ];
        return response()->json($print);
    }
    public function cari_pengendalian_hasil($id)
    {
        $pengendalian = DB::table('pengendalian_risiko')
        ->where('id',$id)
        ->get();
        $print=[
            'pengendalian'=>$pengendalian,
        ];
        return response()->json($print);
    }
}
