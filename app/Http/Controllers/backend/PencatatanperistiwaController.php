<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pencatatanperistiwa;

class PencatatanperistiwaController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT a.id AS id,a.waktu AS waktu,a.resiko_id AS resiko_id,b.kode AS penyebab,c.nilai AS skor,c.nama AS dampak, d.`full_kode` AS full_kode, d.`pernyataan_risiko` AS pernyataan, d.`uraian_dampak` AS uraian
                            FROM pencatatan_peristiwa_resiko a
                            JOIN penyebab b ON a.`penyebab_id` = b.`id`
                            JOIN kriteria_dampak c ON a.`kriteria_id` = c.`id`
                            JOIN resiko_teridentifikasi d ON a.`departemen_id` = d.`id`");
        $cari = DB::select("SELECT b.`departmen_pemilik_resiko` AS dept, b.`periode_penerapan` AS tahun FROM pencatatan_peristiwa_resiko a
                            JOIN resiko_teridentifikasi b ON a.`departemen_id` = b.`id`
                            GROUP BY b.`periode_penerapan`, a.departemen_id");
        return view('backend.pencatatanperistiwa.index',compact('data','cari'));
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
        DB::table('pencatatan_peristiwa_resiko')->insert([
            'departemen_id'=>$request->departemen,
            // tahun'=>$request->tahun,
            'resiko_id'=>$request->risiko,
            // 'pernyataan'=>$request->pernyataan_risiko,
            // 'uraian'=>$request->uraian,
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
        $data = DB::select("SELECT a.*,b.kode AS penyebab,c.nilai AS skor,c.nama AS dampak, d.`full_kode` AS full_kode, d.`pernyataan_risiko` AS pernyataan, d.`uraian_dampak` AS uraian,d.periode_penerapan as tahun
                            FROM pencatatan_peristiwa_resiko a
                            JOIN penyebab b ON a.`penyebab_id` = b.`id`
                            JOIN kriteria_dampak c ON a.`kriteria_id` = c.`id`
                            JOIN resiko_teridentifikasi d ON a.`departemen_id` = d.`id`
                            WHERE a.id = '$id'");
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
            'departemen_id'=>$request->departemen,
            // tahun'=>$request->tahun,
            'resiko_id'=>$request->risiko,
            // 'pernyataan'=>$request->pernyataan_risiko,
            // 'uraian'=>$request->uraian,
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