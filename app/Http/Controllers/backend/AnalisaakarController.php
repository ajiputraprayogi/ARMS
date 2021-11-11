<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use App\analisaakar;
use DB;
use App\penyebab;
use Auth;

class AnalisaakarController extends Controller
{
    //=============================================================================================
    public function index(Request $request)
    {
        // ==================================
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
        // ==================================
        $infosearch ='';
        $active_departemen = 'Semua Departemen';
        $active_tahun = 'Semua Tahun';
        $active_kategori = 'Semua Kategori Penyebab';
        $active_kode = 'Semua Kode Risiko';

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
        if($request->has('kategori_penyebab')){
            if($request->kategori_penyebab){
                $active_kategori = $request->kategori_penyebab;
            }else{
                $active_kategori = 'Semua Kategori Penyebab';
            }
        }
        if($request->has('kode_risiko')){
            if($request->kode_risiko!='Semua Kode Risiko'){
                $active_kode = $request->kode_risiko;
            }else{
                $active_kode = 'Semua Kode Risiko';
            }
        }
        $departemen = DB::table('analisa_masalah')
                        ->select('pelaksanaan_manajemen_risiko.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
        $tahun = DB::table('pelaksanaan_manajemen_risiko')
        ->groupby('priode_penerapan')
        ->get();

        $kategori_penyebab = DB::table('analisa_masalah')
                                ->select('penyebab.*')
                                ->leftjoin('penyebab','penyebab.kode','=','analisa_masalah.kategori_penyebab')
                                ->groupby('penyebab.id')
                                ->orderby('penyebab.kode','asc')
                                ->get();
        
        if($active_departemen!='Semua Departemen'){
            $kode_risiko = DB::table('analisa_masalah')
            ->select('analisa_masalah.*','resiko_teridentifikasi.full_kode')
            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->where('pelaksanaan_manajemen_risiko.faktur','=',$active_departemen)
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->groupby('resiko_teridentifikasi.full_kode')
            ->orderby('resiko_teridentifikasi.full_kode','asc')
            ->get();
            // dd($kode_risiko);
        }else{
            $kode_risiko = DB::table('analisa_masalah')
            ->select('analisa_masalah.*','resiko_teridentifikasi.full_kode')
            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
            ->groupby('resiko_teridentifikasi.full_kode')
            ->orderby('resiko_teridentifikasi.full_kode','asc')
            ->get();
            // dd($kode_risiko);
        }

        if($active_departemen!='Semua Departemen'){
            if($active_tahun!='Semua Tahun'){
                if($active_kategori!='Semua Kategori Penyebab'){
                    if($active_kode!='Semua Kode Risiko'){
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->leftjoin('penyebab','penyebab.kode','=','analisa_masalah.kategori_penyebab')
                        ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['penyebab.kode','=',$active_kategori],['resiko_teridentifikasi.full_kode','=',$active_kode]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }else{
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->leftjoin('penyebab','penyebab.kode','=','analisa_masalah.kategori_penyebab')
                        ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['penyebab.kode','=',$active_kategori]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }
                }else{
                    if($active_kode!='Semua Kode Risiko'){
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.full_kode','=',$active_kode]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }else{
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }
                }
            }else{
                if($active_kategori!='Semua Kategori Penyebab'){
                    if($active_kode!='Semua Kode Risiko'){
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->leftjoin('penyebab','penyebab.kode','=','analisa_masalah.kategori_penyebab')
                        ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['penyebab.kode','=',$active_kategori],['resiko_teridentifikasi.full_kode','=',$active_kode]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }else{
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->leftjoin('penyebab','penyebab.kode','=','analisa_masalah.kategori_penyebab')
                        ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['penyebab.kode','=',$active_kategori]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }
                }else{
                    if($active_kode!='Semua Kode Risiko'){
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_departemen],['resiko_teridentifikasi.full_kode','=',$active_kode]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }else{
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->where('pelaksanaan_manajemen_risiko.faktur','=',$active_departemen)
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                    }
                }
            }
           
        }else{
            if($active_tahun!='Semua Tahun'){
                if($active_kategori!='Semua Kategori Penyebab'){
                    if($active_kode!='Semua Kode Risiko'){
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->leftjoin('penyebab','penyebab.kode','=','analisa_masalah.kategori_penyebab')
                        ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_tahun],['penyebab.kode','=',$active_kategori],['resiko_teridentifikasi.full_kode','=',$active_kode]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }else{
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->leftjoin('penyebab','penyebab.kode','=','analisa_masalah.kategori_penyebab')
                        ->where([['pelaksanaan_manajemen_risiko.faktur','=',$active_tahun],['penyebab.kode','=',$active_kategori]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }
                }else{
                    if($active_kode!='Semua Kode Risiko'){
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->where([['pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun],['resiko_teridentifikasi.full_kode','=',$active_kode]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }else{
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->where('pelaksanaan_manajemen_risiko.priode_penerapan','=',$active_tahun)
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }
                }
            }else{
                if($active_kategori!='Semua Kategori Penyebab'){
                    if($active_kode!='Semua Kode Risiko'){
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->leftjoin('penyebab','penyebab.kode','=','analisa_masalah.kategori_penyebab')
                        ->where([['penyebab.kode',$active_kategori],['resiko_teridentifikasi.full_kode','=',$active_kode]])
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }else{
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->leftjoin('penyebab','penyebab.kode','=','analisa_masalah.kategori_penyebab')
                        ->where('penyebab.kode',$active_kategori)
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }
                }else{
                    if($active_kode!='Semua Kode Risiko'){
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->where('resiko_teridentifikasi.full_kode','=',$active_kode)
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }else{
                        $data = DB::table('analisa_masalah')
                        ->select('analisa_masalah.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                        // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
                        // dd($data);
                    }
                }
            }
        }
        // $data = analisaakar::orderby('id','desc')->get();
        return view('backend.resiko.akar_masalah.index',compact('data','active_departemen','active_tahun','active_kategori','active_kode','departemen','tahun','kategori_penyebab','kode_risiko'));
    }

    //=============================================================================================
    public function create()
    {
        DB::table('akar_masalah_why_thumb')->where('pembuat','=',Auth::user()->id)->delete();
        $data = penyebab::all();
        return view('backend.resiko.akar_masalah.add',compact('data'));
    }

    //=============================================================================================
    public function store(Request $request)
    {
        $data=[];
        $datawhy = DB::table('akar_masalah_why_thumb')->where('pembuat',Auth::user()->id)->get();
        foreach ($datawhy as $row) {
            $data[]=[
                'kode_analisis'=>$request->kode_analisis,
                'uraian'=>$row->uraian,
            ];
        }
        DB::table('akar_masalah_why')->insert($data);
        DB::table('analisa_masalah')
        ->insert([
            'kode_analisis'=>$request->kode_analisis,
            'kode_risiko'=>$request->cari_risiko,
            'kategori_penyebab'=>$request->kategori,
            'akar_masalah'=>$request->penyebab,
            'tindakan_pengendalian'=>$request->pengendalian,
        ]);
        DB::table('akar_masalah_why_thumb')->where('pembuat','=',Auth::user()->id)->delete();
        return redirect('analisa-akar-masalah')->with('status','Data berhasil disimpan');
    }

    //=============================================================================================
    public function show($id)
    {
        //
    }

    //=============================================================================================
    public function carikode($kode)
    {
        $carikode = DB::table('analisa_masalah')
        ->where('kode_analisis','like','%'.$kode.'%')
        ->max('kode_analisis');
        //dd($carikode);
        if(!$carikode){
            $finalkode = $kode.'.1';
        }else{
            $getnumber = explode('.',$carikode);
            $jumlah = count($getnumber);
            $newno = $getnumber[$jumlah-1]+1;
            $finalkode = $kode.'.'.$newno;
        }
        return response()->json($finalkode);
    }

    //=============================================================================================
    public function edit($id)
    {
        $datanya = [];
        DB::table('akar_masalah_why_thumb')->where('pembuat','=',Auth::user()->id)->delete();
        $datadetail = DB::table('analisa_masalah')->where('id',$id)->get();
        foreach($datadetail as $row){
            $datawhy = DB::table('akar_masalah_why')->where('kode_analisis','=',$row->kode_analisis)->get();
            foreach ($datawhy as $rowwhy) {
                $datanya[]=[
                    'uraian'=>$rowwhy->uraian,
                    'pembuat'=>Auth::user()->id,
                ];
            }
        }
        $data = penyebab::all();
        DB::table('akar_masalah_why_thumb')->insert($datanya);
        return view('backend.resiko.akar_masalah.edit',compact('data','datadetail'));
    }

    //=============================================================================================
    public function update(Request $request, $id)
    {
        $data=[];
        DB::table('akar_masalah_why')->where('kode_analisis','=',$request->kode_analisis)->delete();
        $datawhy = DB::table('akar_masalah_why_thumb')->where('pembuat',Auth::user()->id)->get();
        foreach ($datawhy as $row) {
            $data[]=[
                'kode_analisis'=>$request->kode_analisis,
                'uraian'=>$row->uraian,
            ];
        }
        DB::table('akar_masalah_why')->insert($data);
        DB::table('analisa_masalah')
        ->where('id',$id)
        ->update([
            'kode_analisis'=>$request->kode_analisis,
            'kode_risiko'=>$request->cari_risiko,
            'kategori_penyebab'=>$request->kategori,
            'akar_masalah'=>$request->penyebab,
            'tindakan_pengendalian'=>$request->pengendalian,
        ]);
        DB::table('akar_masalah_why_thumb')->where('pembuat','=',Auth::user()->id)->delete();
        return redirect('analisa-akar-masalah')->with('status','Data berhasil diupdate');
    }

    //=============================================================================================
    public function destroy($id)
    {
        $datadetail = DB::table('analisa_masalah')->where('id',$id)->get();
        foreach($datadetail as $row){
            $datawhy = DB::table('akar_masalah_why')->where('kode_analisis','=',$row->kode_analisis)->delete();
        }
        DB::table('analisa_masalah')->where('id',$id)->delete();
    }

    //=============================================================================================
    public function caridepartmen(Request $request)
    {
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('pelaksanaan_manajemen_risiko')
                    ->select('pelaksanaan_manajemen_risiko.id', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep')
                    ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
                    ->where('departemen.kode','like','%'.$cari.'%')
                    ->orwhere('departemen.nama','like','%'.$cari.'%')
                    ->get();
            
            return response()->json($data);
        }
    }

    //=============================================================================================
    public function hasilcaridepartmen($id,$iddepartemen)
    {
        $data = DB::table('pelaksanaan_manajemen_risiko')
        ->select('pelaksanaan_manajemen_risiko.id','pelaksanaan_manajemen_risiko.selera_risiko', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep')
        ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
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

    //=============================================================================================
    public function hasilcarikode($id)
    {
        $data = DB::table('resiko_teridentifikasi')
                    ->where('full_kode','=', $id)
                    ->get();
            
            return response()->json($data);
    }

    //=============================================================================================
    public function storewhy(Request $request){
        DB::table('akar_masalah_why_thumb')
        ->insert([
            'uraian'=>$request->akar_penyebab,
            'pembuat'=>Auth::user()->id
        ]);
    }

    //=============================================================================================
    public function listwhy(){
        $data = DB::table('akar_masalah_why_thumb')
        ->where('pembuat',Auth::user()->id)
        ->get();
        return response()->json($data);
    }

    //=============================================================================================
    public function hapuswhy($id){
        DB::table('akar_masalah_why_thumb')
        ->where('id',$id)
        ->delete();
    }

    //=============================================================================================
    public function showwhy($id){
        $data = DB::table('akar_masalah_why_thumb')
        ->where('id',$id)
        ->get();
        return response()->json($data);
    }

    //=============================================================================================
    public function updatewhy(Request $request){
        $data = DB::table('akar_masalah_why_thumb')
        ->where('id',$request->kode_why)
        ->update([
            'uraian'=>$request->edit_akar_penyebab,
        ]);
    }

    // ============================================ Filter ========================================
    public function hasilcaridepartmenfilter($id){
        // ==================================
        $iduser = Auth::user()->id_departemen;
        $id_dep=[];
        $id_atasan = [];
        $i_limit=1;
        array_push($id_atasan,$iduser);
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
        // ==================================
        // $datad = DB::table('pelaksanaan_manajemen_risiko')
        // ->select('pelaksanaan_manajemen_risiko.id', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','departemen.kode as kodedep','departemen.nama as namadep')
        // ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
        // ->where('pelaksanaan_manajemen_risiko.id',$id)
        // ->get();
        // $data =  DB::table('pelaksanaan_manajemen_risiko')
        // ->select('pelaksanaan_manajemen_risiko.id','pelaksanaan_manajemen_risiko.faktur', 'pelaksanaan_manajemen_risiko.id_departemen', 'pelaksanaan_manajemen_risiko.priode_penerapan','pelaksanaan_manajemen_risiko.selera_risiko','departemen.kode as kodedep','departemen.nama as namadep','konteks.id as idk','konteks.kode as kodek')
        // ->leftjoin('departemen', 'pelaksanaan_manajemen_risiko.id_departemen', '=', 'departemen.id')
        // ->leftjoin('konteks','konteks.faktur_konteks','=','pelaksanaan_manajemen_risiko.faktur')
        // ->where('pelaksanaan_manajemen_risiko.id',$id)
        // ->get();
        $data = DB::table('analisa_masalah')
                ->select('analisa_masalah.*','departemen.nama','pelaksanaan_manajemen_risiko.faktur')
                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
                ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->where('pelaksanaan_manajemen_risiko.faktur','=',$id)
                ->whereIn('pelaksanaan_manajemen_risiko.id_departemen',$id_atasan)
                ->get();

        // $risiko = DB::table('konteks')
        // ->where('faktur_konteks',$id)
        // ->groupby('konteks.id')
        // ->get();
        $risiko = DB::table('analisa_masalah')
        ->select('analisa_masalah.*')
        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','analisa_masalah.kode_risiko')
        ->where('resiko_teridentifikasi.faktur',$id)
        ->groupby('resiko_teridentifikasi.full_kode')
        ->get();
        $print=[
            'detail'=>$data,
            'risiko'=>$risiko
        ];
        return response()->json($print);
    }
}
