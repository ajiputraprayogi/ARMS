<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class pemantauanefektivitaspengendalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $data = DB::table('pemantauan_efektivitas_pengendalian')
                ->select([
                    'pemantauan_efektivitas_pengendalian.*',
                    'resiko_teridentifikasi.full_kode',
                    'resiko_teridentifikasi.pernyataan_risiko',
                    'resiko_teridentifikasi.frekuensi_akhir',
                    'resiko_teridentifikasi.dampak_akhir',
                    'resiko_teridentifikasi.besaran_akhir',
                    'resiko_teridentifikasi.pr_akhir',
                    'pengendalian_risiko.kode_tindak_pengendalian',
                    'pengendalian_risiko.frekuensi_saat_ini',
                    'pengendalian_risiko.dampak_saat_ini',
                    'pengendalian_risiko.besaran_saat_ini',
                    'pengendalian_risiko.pr_saat_ini',
                    'departemen.nama'
                    ])
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pemantauan_efektivitas_pengendalian.id_manajemen')
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pemantauan_efektivitas_pengendalian.id_risiko')
                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id','=','pemantauan_efektivitas_pengendalian.id_pengendalian')
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->get();
        return view('backend.pemantauan_efektivitas_pengendalian.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pemantauan_efektivitas_pengendalian.add');
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
            'id_manajemen'=>'required',
            'id_risiko'=>'required',
            'id_pengendalian'=>'required',
        ]);
        DB::table('pemantauan_efektivitas_pengendalian')->insert([
            'id_manajemen'=>$request->id_manajemen,
            'id_risiko'=>$request->id_risiko,
            'id_pengendalian'=>$request->id_pengendalian,
            'keterangan'=>$request->keterangan,
        ]);
        return redirect('pemantauan-efektivitas')->with('msg','Berhasil menambah data');
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
        $data = DB::table('pemantauan_efektivitas_pengendalian')
        ->select([
            'pemantauan_efektivitas_pengendalian.*',
            'resiko_teridentifikasi.full_kode',
            'resiko_teridentifikasi.pernyataan_risiko',
            'resiko_teridentifikasi.frekuensi_akhir',
            'resiko_teridentifikasi.dampak_akhir',
            'resiko_teridentifikasi.besaran_akhir',
            'resiko_teridentifikasi.pr_akhir',
            'pengendalian_risiko.kode_tindak_pengendalian',
            'pengendalian_risiko.frekuensi_saat_ini',
            'pengendalian_risiko.dampak_saat_ini',
            'pengendalian_risiko.besaran_saat_ini',
            'pengendalian_risiko.pr_saat_ini',
            'pengendalian_risiko.kegiatan_pengendalian',
            'pelaksanaan_manajemen_risiko.priode_penerapan',
            'departemen.nama'
            ])
        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.id','=','pemantauan_efektivitas_pengendalian.id_manajemen')
        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.id','=','pemantauan_efektivitas_pengendalian.id_risiko')
        ->leftjoin('pengendalian_risiko','pengendalian_risiko.id','=','pemantauan_efektivitas_pengendalian.id_pengendalian')
        ->where('pemantauan_efektivitas_pengendalian.id',$id)
        ->get();
        foreach($data as $row){
            $data_manajemen_risiko = DB::table('pelaksanaan_manajemen_risiko')
            ->select('pelaksanaan_manajemen_risiko.*','departemen.nama')
            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
            ->where('pelaksanaan_manajemen_risiko.id',$row->id_manajemen)
            ->get();
        }
        foreach($data as $row){
            $data_risiko = DB::table('resiko_teridentifikasi')
            ->where('id',$row->id_risiko)
            ->get();
        }
        foreach($data as $row){
            $data_pengendalian = DB::table('pengendalian_risiko')
            ->where('id',$row->id_pengendalian)
            ->get();
        }
        // dd($data);
        return view('backend.pemantauan_efektivitas_pengendalian.edit',compact('data','data_manajemen_risiko','data_risiko','data_pengendalian'));
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
            'id_manajemen'=>'required',
            'id_risiko'=>'required',
            'id_pengendalian'=>'required',
        ]);
        DB::table('pemantauan_efektivitas_pengendalian')->where('id',$id)->update([
            'id_manajemen'=>$request->id_manajemen,
            'id_risiko'=>$request->id_risiko,
            'id_pengendalian'=>$request->id_pengendalian,
            'keterangan'=>$request->keterangan,
        ]);
        return redirect('pemantauan-efektivitas')->with('msg','Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pemantauan_efektivitas_pengendalian')->where('id',$id)->delete();
    }
}
