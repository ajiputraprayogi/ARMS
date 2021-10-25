<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pencatatanperistiwa;

class PencatatanperistiwaController extends Controller
{
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
        $departemen = DB::table('pencatatan_peristiwa_resiko')
                        ->select('departemen.*','departemen.nama')
                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                        ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                        ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
                        ->get();
        $tahun = DB::table('pelaksanaan_manajemen_risiko')
        ->groupby('priode_penerapan')
        ->get();
        if($active_departemen!='Semua Departemen'){
            $data = DB::table('pencatatan_peristiwa_resiko')
            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
            ->where('pelaksanaan_manajemen_risiko.id_departemen','=',$active_departemen)
            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
            ->get();
            // $data = DB::select("SELECT a.id AS id,a.waktu AS waktu,a.resiko_id AS resiko_id,b.kode AS penyebab,c.nilai AS skor,c.nama AS dampak, d.`full_kode` AS full_kode, d.`pernyataan_risiko` AS pernyataan, d.`uraian_dampak` AS uraian
            // FROM pencatatan_peristiwa_resiko a
            // JOIN penyebab b ON a.`penyebab_id` = b.`id`
            // JOIN kriteria_dampak c ON a.`kriteria_id` = c.`id`
            // JOIN resiko_teridentifikasi d ON a.`departemen_id` = d.`id`
            // WHERE d.`departmen_pemilik_resiko`= '$active_departemen'
            // -- AND d.`periode_penerapan` = '$tahun'
            // ");
        }else{
            $data = DB::table('pencatatan_peristiwa_resiko')
            ->select('pencatatan_peristiwa_resiko.*','resiko_teridentifikasi.pernyataan_risiko','resiko_teridentifikasi.uraian_dampak','departemen.nama','kriteria_dampak.nilai','kriteria_dampak.nama','penyebab.penyebab')
            ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
            ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
            ->leftjoin('kriteria_dampak','kriteria_dampak.id','=','pencatatan_peristiwa_resiko.kriteria_id')
            ->leftjoin('penyebab','penyebab.id','=','pencatatan_peristiwa_resiko.penyebab_id')
            // ->groupby('pelaksanaan_manajemen_risiko.id_departemen')
            ->get();
            // dd($data);
            // $data = DB::select("SELECT a.id AS id,a.waktu AS waktu,a.resiko_id AS resiko_id,b.kode AS penyebab,c.nilai AS skor,c.nama AS dampak, d.`full_kode` AS full_kode, d.`pernyataan_risiko` AS pernyataan, d.`uraian_dampak` AS uraian
            //         FROM pencatatan_peristiwa_resiko a
            //         JOIN penyebab b ON a.`penyebab_id` = b.`id`
            //         JOIN kriteria_dampak c ON a.`kriteria_id` = c.`id`
            //         JOIN resiko_teridentifikasi d ON a.`departemen_id` = d.`id`");
        }
        // $cari = DB::select("SELECT b.`departmen_pemilik_resiko` AS dept, b.`periode_penerapan` AS tahun FROM pencatatan_peristiwa_resiko a
        //                     JOIN resiko_teridentifikasi b ON a.`departemen_id` = b.`id`
        //                     GROUP BY b.`periode_penerapan`, a.departemen_id");
        return view('backend.pencatatanperistiwa.index',compact('data','active_departemen','active_tahun','departemen','tahun'));
    }

    public function cari(Request $request)
    {
        $tahun=$request->tahun;
        $dept=$request->dept;
        $data = DB::select("SELECT a.id AS id,a.waktu AS waktu,a.resiko_id AS resiko_id,b.kode AS penyebab,c.nilai AS skor,c.nama AS dampak, d.`full_kode` AS full_kode, d.`pernyataan_risiko` AS pernyataan, d.`uraian_dampak` AS uraian
                            FROM pencatatan_peristiwa_resiko a
                            JOIN penyebab b ON a.`penyebab_id` = b.`id`
                            JOIN kriteria_dampak c ON a.`kriteria_id` = c.`id`
                            JOIN resiko_teridentifikasi d ON a.`departemen_id` = d.`id`
                            WHERE d.`departmen_pemilik_resiko`= '$dept'
                            AND d.`periode_penerapan` = '$tahun'");
        $cari = DB::select("SELECT b.`departmen_pemilik_resiko` AS dept, b.`periode_penerapan` AS tahun FROM pencatatan_peristiwa_resiko a
                            JOIN resiko_teridentifikasi b ON a.`departemen_id` = b.`id`
                            GROUP BY b.`periode_penerapan`, a.departemen_id");
        return view('backend.pencatatanperistiwa.index',compact('data','cari'));
    }

    public function  create()
    {
        $dampakterakhir = DB::table('kriteria_dampak')->select('kriteria_dampak.*')->orderby('kriteria_dampak.id','desc')->get();
        $penyebab = DB::table('penyebab')->get();
        $resiko = DB::table('resiko_teridentifikasi')->select('id','departmen_pemilik_resiko','periode_penerapan')->get();
        return view('backend.pencatatanperistiwa.create', compact('penyebab','dampakterakhir','resiko'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'departemen'=>'required',
            // 'tahun'=>'required',
            'risiko'=>'required',
            // 'pernyataan_risiko'=>'required',
            // 'uraian'=>'required',
            'waktu'=>'required',
            'tempat'=>'required',
            'skor'=>'required',
            'pemicu'=>'required',
            'kode_penyebab'=>'required',
        ]);
        $data = DB::table('pencatatan_peristiwa_resiko')->insert([
            'departemen_id'=>$request->id_departemen,
            'id_manajemen'=>$request->id_manajemen,
            'id_risiko'=>$request->id_risiko,
            // tahun'=>$request->tahun,
            'resiko_id'=>$request->kode_risiko,
            // 'pernyataan'=>$request->pernyataan_risiko,
            'uraian'=>$request->uraian,
            'waktu'=>$request->waktu,
            'tempat'=>$request->tempat,
            'kriteria_id'=>$request->skor,
            'pemicu'=>$request->pemicu,
            'penyebab_id'=>$request->kode_penyebab,
            ]);
            
        return redirect('pencatatan-peristiwa')->with('status','Berhasil menambah data');
    }

    public function edit($id)
    {
        $data = DB::select("SELECT a.*,a.`uraian` AS uraianpencatatan,b.kode AS penyebab,c.nilai AS skor,c.nama AS dampak, d.`full_kode` AS full_kode, d.`pernyataan_risiko` AS pernyataan, d.`uraian_dampak` AS uraian,d.periode_penerapan as tahun, d.`faktur` AS faktur,e.`id_departemen` AS id_departemen, f.`nama` AS nama
                            FROM pencatatan_peristiwa_resiko a
                            JOIN penyebab b ON a.`penyebab_id` = b.`id`
                            JOIN kriteria_dampak c ON a.`kriteria_id` = c.`id`
                            JOIN resiko_teridentifikasi d ON a.`id_risiko` = d.`id`
                            JOIN pelaksanaan_manajemen_risiko e ON d.`faktur` = e.`faktur`
                            JOIN departemen f ON e.`id_departemen` = f.`id`
                            WHERE a.id = '$id'");
                            // dd($data);
        $dampakterakhir = DB::table('kriteria_dampak')->select('kriteria_dampak.*')->orderby('kriteria_dampak.id','desc')->get();
        $penyebab = DB::table('penyebab')->get();
        $resiko = DB::table('resiko_teridentifikasi')->select('id','full_kode','departmen_pemilik_resiko','periode_penerapan')->get();

        return view('backend.pencatatanperistiwa.update', compact('penyebab','dampakterakhir','resiko','data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'departemen'=>'required',
            // 'tahun'=>'required',
            // 'risiko'=>'required',
            // 'pernyataan_risiko'=>'required',
            // 'uraian'=>'required',
            'waktu'=>'required',
            'tempat'=>'required',
            'skor'=>'required',
            'pemicu'=>'required',
            'kode_penyebab'=>'required',
        ]);
        Pencatatanperistiwa::find($id)->update([
            'departemen_id'=>$request->id_departemen,
            'id_manajemen'=>$request->id_manajemen,
            'id_risiko'=>$request->id_risiko,
            'resiko_id'=>$request->kode_risiko,
            // tahun'=>$request->tahun,
            // 'resiko_id'=>$request->risiko,
            // 'pernyataan'=>$request->pernyataan_risiko,
            'uraian'=>$request->uraian,
            'waktu'=>$request->waktu,
            'tempat'=>$request->tempat,
            'kriteria_id'=>$request->skor,
            'pemicu'=>$request->pemicu,
            'penyebab_id'=>$request->kode_penyebab,
        ]);
        return redirect('pencatatan-peristiwa')->with('status','Berhasil merubah data');
    }

    public function destroy($id)
    {
        DB::table('pencatatan_peristiwa_resiko')->where('id',$id)->delete();
    }

    public function cari_pencatatan_manajemen(Request $request)
    {
        $dept = DB::table('resiko_teridentifikasi')->where("id",$request->depID)->get();
        return response()->json($dept);
    }
}
