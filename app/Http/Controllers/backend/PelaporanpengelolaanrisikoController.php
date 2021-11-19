<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\pelaporanpengelolaanrisiko;
use App\periodepelaporan;
use App\tembusan;
use App\tujuanpelaporan;
use App\departemen;
use DataTables;
use Auth;

class PelaporanpengelolaanrisikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id_departemen = Auth::user()->id_departemen;

        if($request->periodepelaporan){
            if($request->periodepelaporan != 'Semua Departemen'){
                $active_periode = $request->periodepelaporan;
            } else{
                $active_periode = 'Semua Periode';
            }
        } else {
            $active_periode = 'Semua Periode';
        }

        if($request->departemen){
            if($request->departemen!='Semua Departemen'){
                $active_departemen = $request->departemen;
            }else{
                $active_departemen = 'Semua Departemen';
            }
        } else {
            $active_departemen = 'Semua Unit Kerja';
        }

        if($request->status){
            if($request->status!='Semua Status'){
                $active_status = $request->status;
            }else{
                $active_status = 'Semua Status';
            }
        } else {
            $active_status = 'Semua Status';
        }
        // dd($active_periode, $active_departemen, $active_status);

        $periodepelaporan = periodepelaporan::all();
        $departemen = departemen::all();

        // $data = pelaporanpengelolaanrisiko::with(['tembusan.departemen', 'periodepelaporan', 'departemen', 'tujuanpelaporan.departemen'])->where('id_unit_kerja', $id_departemen)->orWhereHas('tembusan', function($q) use($id_departemen ){
        //     $q->where('id_departemen', '=', $id_departemen);
        // })->orWhereHas('tujuanpelaporan', function($q) use($id_departemen ){
        //     $q->where('id_departemen', '=', $id_departemen);
        // })->paginate(50);

        if ($active_periode != 'Semua Periode'){
            if ($active_status != 'Semua Status'){
                $data = pelaporanpengelolaanrisiko::with(['tembusan.departemen', 'periodepelaporan', 'departemen', 'tujuanpelaporan.departemen'])->whereHas('tembusan', function($q) use($id_departemen ){
                    $q->where('id_departemen', '=', $id_departemen);
                })->orWhereHas('tujuanpelaporan', function($q) use($id_departemen ){
                    $q->where('id_departemen', '=', $id_departemen);
                })->where('id_periode_pelaporan', '=', $active_periode)->where('status', '=', $active_status)->paginate(50);
                // dd($data);
            } else {
                $data = pelaporanpengelolaanrisiko::with(['tembusan.departemen', 'periodepelaporan', 'departemen', 'tujuanpelaporan.departemen'])->where('id_unit_kerja', $id_departemen)->orWhereHas('tembusan', function($q) use($id_departemen ){
                    $q->where('id_departemen', '=', $id_departemen);
                })->orWhereHas('tujuanpelaporan', function($q) use($id_departemen ){
                    $q->where('id_departemen', '=', $id_departemen);
                })->paginate(50);
            }
        } else {
            $data = pelaporanpengelolaanrisiko::with(['tembusan.departemen', 'periodepelaporan', 'departemen', 'tujuanpelaporan.departemen'])->where('id_unit_kerja', $id_departemen)->orWhereHas('tembusan', function($q) use($id_departemen ){
                $q->where('id_departemen', '=', $id_departemen);
            })->orWhereHas('tujuanpelaporan', function($q) use($id_departemen ){
                $q->where('id_departemen', '=', $id_departemen);
            })->paginate(50);
        }

        // dd($data);
        return view('backend.pelaporanpengelolaanrisiko.index',[
            'data'=>$data,
            'periode'=>$periodepelaporan,
            'departemen'=>$departemen,
            'active_periode' => $active_periode,
            'active_departemen' => $active_departemen,
            'active_status' => $active_status,
        ]);
    }

    public function listdata(){ // tidak terpakai
        $id_departemen = Auth::user()->id_departemen;
        // dd(Datatables::of(pelaporanpengelolaanrisiko::with(['tembusan.departemen', 'periodepelaporan', 'departemen', 'tujuanpelaporan.departemen'])->where('id_unit_kerja', $id_departemen)->orWhereHas('tembusan', function($q) use($id_departemen ){
        //     $q->where('id_departemen', '=', $id_departemen);
        // })->orWhereHas('tujuanpelaporan', function($q) use($id_departemen ){
        //     $q->where('id_departemen', '=', $id_departemen);
        // })->get())->make(true));

        return Datatables::of(pelaporanpengelolaanrisiko::with(['tembusan.departemen', 'periodepelaporan', 'departemen', 'tujuanpelaporan.departemen'])->where('id_unit_kerja', $id_departemen)->orWhereHas('tembusan', function($q) use($id_departemen ){
            $q->where('id_departemen', '=', $id_departemen);
        })->orWhereHas('tujuanpelaporan', function($q) use($id_departemen ){
            $q->where('id_departemen', '=', $id_departemen);
        })->get())->make(true);
    }

    public function cariatasan($id)
    {
        $dep = departemen::find($id);
        $id_dep=[];
        $id_atasan = [];
        $i_limit=1;
        array_push($id_atasan,$dep->id_atasan);
        //dd(count($id_atasan));

        for ($i=0; $i <$i_limit ; $i++) {
            for ($j=0; $j < count($id_atasan) ; $j++) {
                $data = departemen::find($id_atasan[$j]);
                if($data->id_atasan != null){
                    array_push($id_atasan, $data->id_atasan);
                    $i_limit++;
                }else{
                    $i_limit=$i;
                }
            }
        }
        $filtered_atasan = departemen::whereIn('id', $id_atasan)->get();
        // dd($filtered_atasan);
        return response()->json([
            'data_atasan' => $filtered_atasan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode_pelaporan = periodepelaporan::where('status', '=', 'aktif')->get();
        return view('backend.pelaporanpengelolaanrisiko.add', [
            'periode_pelaporan' => $periode_pelaporan
        ]);
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
            'periode_pelaporan' => 'required',
            'departemen' => 'required',
            'status' => 'required',
            'file_laporan' => 'required|max:10240',
            'tembusan' => '',
            'tujuanpelaporan' => 'required',
        ]);
        // dd($request);
        if ($request->hasFile('file_laporan')) {
            $originame = $request->file('file_laporan')->getClientOriginalName();
            $file_laporan = time() . '_' . preg_replace('/\s+/', '_', $originame);
            $request->file('file_laporan')->move('pelaporan', $file_laporan);
        }
        // $file_laporan = 'CV_TAUFIK.pdf';

        $add_pelaporan = pelaporanpengelolaanrisiko::create([
            'id_periode_pelaporan' => $request->periode_pelaporan,
            'id_unit_kerja' => $request->departemen,
            'status' => $request->status,
            'file' => $file_laporan
        ]);

        foreach ($request->tembusan as $tembusan){
            tembusan::create([
                'id_pelaporan'  => $add_pelaporan->id,
                'id_departemen' => $tembusan
            ]);
        }

        foreach ($request->tujuanpelaporan as $tujuanpelaporan){
            tujuanpelaporan::create([
                'id_pelaporan'  => $add_pelaporan->id,
                'id_departemen' => $tujuanpelaporan
            ]);
        }

        return redirect('pelaporan-pengelolaan-risiko')->with('status','Sukses menyimpan data');
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
        $data=pelaporanpengelolaanrisiko::find($id);
        return view('backend.pelaporanpengelolaanrisiko.edit',['data'=>$data]);
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
            'status' => 'required',
        ]);
        pelaporanpengelolaanrisiko::find($id)->update([
            'status' => $request->status,
        ]);
        return redirect('pelaporan-pengelolaan-risiko')->with('status','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelaporan = pelaporanpengelolaanrisiko::find($id);
        if ($pelaporan->file != null){
            unlink('pelaporan/' . $pelaporan->file);
        }
        pelaporanpengelolaanrisiko::destroy($id);
        tembusan::where('id_pelaporan', $id)->delete();
        tujuanpelaporan::where('id_pelaporan', $id)->delete();
    }
}
