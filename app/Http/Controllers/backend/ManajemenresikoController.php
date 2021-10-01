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
        // $konteks = konteks::leftJoin('jenis_konteks','konteks.id_konteks','=','jenis_konteks.id')
        // ->select('jenis_konteks.id as idjk','jenis_konteks.*','konteks.*')->where('faktur_konteks',$finalkode)->get();
        // SELECT *, COUNT( * ) AS total FROM comment GROUP BY post_id
        $cek = pelaksanaanmanajemenrisiko::leftJoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        // ->leftJoin('konteks','pelaksanaan_manajemen_risiko.faktur','=','konteks.faktur_konteks')
        // ->leftJoin('pemangku_kepentingan','pelaksanaan_manajemen_risiko.faktur','=','pemangku_kepentingan.faktur_pemangku')
        ->select('departemen.id as idd','departemen.nama as nama_departemen','pelaksanaan_manajemen_risiko.*')->get();
        // $pelaksanaanmanajemenrisiko = pelaksanaanmanajemenrisiko::all();
        // $pelaksanaanmanajemenrisiko1 = DB::table('pelaksanaan_manajemen_risiko')
        // ->join('konteks', 'pelaksanaan_manajemen_risiko.faktur', '=', 'konteks.faktur_konteks')
        // ->select([
        //     'pelaksanaan_manajemen_risiko.faktur', 
        //     DB::raw("count(konteks.faktur_konteks) as count")
        //     ])->groupBy('pelaksanaan_manajemen_risiko.faktur')
        // ->get();
        // $pelaksanaanmanajemenrisiko1 = pelaksanaanmanajemenrisiko::leftJoin('konteks','pelaksanaan_manajemen_risiko.faktur','=','konteks.faktur_konteks')
        // ->leftJoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        // ->select('pelaksanaan_manajemen_risiko.faktur', \DB::raw('count(konteks.faktur_konteks) as count'))
        // ->groupBy('faktur')
        // ->get();

        // $pelaksanaanmanajemenrisiko1 = pelaksanaanmanajemenrisiko::select(DB::raw("count(konteks.faktur_konteks) as count"),'departemen.*','pelaksanaan_manajemen_risiko.*')
        // ->leftJoin('konteks','pelaksanaan_manajemen_risiko.faktur','=','konteks.faktur_konteks')
        // ->leftJoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        // ->get();

        // $pelaksanaanmanajemenrisiko1 = DB::table('pelaksanaan_manajemen_risiko')
        // ->join('konteks', 'pelaksanaan_manajemen_risiko.faktur', '=', 'konteks.faktur_konteks')
        // ->selectRaw('*, count(konteks.faktur_konteks)')
        // ->groupBy('faktur');

        // $pelaksanaanmanajemenrisiko1 = DB::table('select pelaksanaan_manajemen_risiko.*, departemen.nama, 
        //                                 sum(konteks.faktur_konteks) as totalkonteks,
        //                                 sum(pemangku_kepentingan.faktur_pemangku) as totalpemangku
        //                                 left join departemen on departemen.id = pelaksanaan_manajemen_risiko.id_departemen 
        //                                 left join konteks on konteks.faktur_konteks = pelaksanaan_manajemen_risiko.faktur 
        //                                 left join pemangku_kepentingan on pemangku_kepentingan.faktur_pemangku = pelaksanaan_manajemen_risiko.faktur 
        //                                 group by pelaksanaan_manajemen_risiko.faktur');

        $pelaksanaanmanajemenrisiko1 = DB::table('pelaksanaan_manajemen_risiko')
        ->select([
                // DB::raw('pelaksanaan_manajemen_risiko.faktur','konteks.faktur_konteks','departemen.nama',),
                DB::raw('count(konteks.faktur_konteks) as totalkonteks'),
                // DB::raw('count(pemangku_kepentingan.faktur_pemangku) as totalpemangku')
                ])
        ->leftJoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
        ->leftJoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
        // ->leftJoin('pemangku_kepentingan','pemangku_kepentingan.faktur_pemangku','=','pelaksanaan_manajemen_risiko.faktur')
        ->groupBy('pelaksanaan_manajemen_risiko.faktur')
        ->get();
        // $pelaksanaanmanajemenrisiko1 = DB::table('pelaksanaan_manajemen_risiko')
        // ->leftJoin('departemen','pelaksanaan_manajemen_risiko.id_departemen','=','departemen.id')
        // ->leftJoin('konteks','pelaksanaan_manajemen_risiko.faktur','=','konteks.faktur_konteks')
        // ->select(DB::raw('pelaksanaan_manajemen_risiko.*, departemen.nama, sum(konteks.faktur_konteks) as totalkonteks'))->groupBy('pelaksanaan_manajemen_risiko.faktur');
        return view('backend.manajemen_risiko.pelaksanaan_risiko',['pelaksanaanmanajemenrisiko1'=>$pelaksanaanmanajemenrisiko1]);
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
