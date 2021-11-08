<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\pelaporanpengelolaanrisiko;
use App\periodepelaporan;
use App\tembusan;
use DataTables;

class PelaporanpengelolaanrisikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = pelaporanpengelolaanrisiko::with(['tembusan.departemen', 'periodepelaporan', 'departemen'])->get();
        // dd($data);
        return view('backend.pelaporanpengelolaanrisiko.index',['data'=>$data]);
    }

    public function listdata(){
        // dd(Datatables::of(pelaporanpengelolaanrisiko::with('tembusan.departemen')->get())->make(true));
        return Datatables::of(pelaporanpengelolaanrisiko::with(['tembusan.departemen', 'periodepelaporan', 'departemen'])->get())->make(true);
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
            'file_laporan' => 'required|max:5096',
            'tembusan' => 'required',
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
        return view('backend.pelaporanpengelolaanrisiko.edit_pelaporanpengelolaanrisiko',['data'=>$data]);
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
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'status' => 'required',
            'nama_periode' => 'required',
        ]);
        pelaporanpengelolaanrisiko::find($id)->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
            'nama_periode' => $request->nama_periode,
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
    }
}
