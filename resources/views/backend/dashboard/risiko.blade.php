@extends('layouts.base')
@section('title')
ARMS | Dashboard
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
.rotate {
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  width: 1.5em;
}
.rotate div {
     -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
         margin-left: -10em;
         margin-right: -10em;
}
</style>
@endsection
@section('content')
@php
$total_selera_risiko =0;
@endphp
@foreach($selera_risiko as $row_selera_risiko)
@php
if($row_selera_risiko->besaran_akhir>$row_selera_risiko->selera_risiko){
    $total_selera_risiko+=1;
}
@endphp
@endforeach
<div class="col-lg-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Dashboard Risiko</h3>
            <form method="get">
                <div class="row">
                    <div class="col-md-4">
                        <label class="m-0">Departemen</label>
                        <div class="input-group mb-3">
                            <select class="form-control" name="departemen" id="departemen">
                                <option value="semua">Semua Departemen</option>
                                @foreach($data_departemen as $row_departemen)
                                <option value="{{$row_departemen->id}}" @if(request()->get('departemen'))
                                    @if(request()->get('departemen')==$row_departemen->id) selected @endif
                                    @endif>{{$row_departemen->nama}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-prepend" style="border-radius:10p;">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                <a href="{{url('/dashboard-risiko')}}" class="btn btn-primary"
                                    style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                        class="fas fa-sync"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div class="card-body p-0 mt-lg-2 mt-0">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title">Identifikasi Risiko</h4>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Populasi Risiko</h5>
                            <h3>{{$populasi_risiko}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Usulan Risiko Baru</h5>
                            <h3>{{$usulan_risiko_baru}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Total Risiko Di Atas Selera Risiko</h5>
                            <h3>{{$total_selera_risiko}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Total Risiko Termitigasi</h5>
                            <h3>{{$risiko_termitigasi}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sebaran Risiko Per Departemen</h5>
                            <div class="table-responsive" style="height: 600px;overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Deparetemen</th>
                                            <th scope="col" class="text-center">Jumlah Risiko</th>
                                            <th scope="col" class="text-center">Melewati Batas Risiko</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($resiko_deparetemen as $row_resiko_deparetemen)
                                        @php
                                        $melewati_risiko = DB::table('resiko_teridentifikasi')
                                        ->select(DB::raw('resiko_teridentifikasi.*,pelaksanaan_manajemen_risiko.selera_risiko'))
                                        ->leftjoin('pelaksanaan_manajemen_risiko','pelaksanaan_manajemen_risiko.faktur','=','resiko_teridentifikasi.faktur')
                                        ->where('resiko_teridentifikasi.id_departmen',$row_resiko_deparetemen->id)
                                        ->get();
                                        $hasil=0;
                                        foreach($melewati_risiko as $row_melewati_risiko){
                                            if($row_melewati_risiko->besaran_akhir>$row_melewati_risiko->selera_risiko){
                                                $hasil+=1;
                                            }
                                        }
                                        @endphp
                                        <tr>
                                            <td>{{$row_resiko_deparetemen->nama}}</td>
                                            <td class="text-center">{{$row_resiko_deparetemen->total}}</td>
                                            <td class="text-center">{{$hasil}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sebaran Risiko Berdasarkan Besaran Risiko</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2" rowspan="2" class="text-center">Peta Risiko</th>
                                            <th class="text-center" colspan="{{count($skor_dampak)}}">Skor Dampak</th>
                                        </tr>
                                        <tr>
                                            @foreach($skor_dampak as $row_skor_dampak)
                                            <th class="text-center">{{$row_skor_dampak->nilai}} - {{$row_skor_dampak->nama}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach($peta_risiko as $row_peta_risiko)
                                        <tr>
                                            @if($no==1)
                                            <td rowspan="{{count($peta_risiko)}}" class="rotate" width="5%">
                                                <div>Skor Frekuensi</div>
                                            </td>
                                            @endif
                                            <td>{{$row_peta_risiko->nilai}} - {{$row_peta_risiko->nama}}</td>
                                            @foreach($skor_dampak as $row_skor_dampak)
                                            @php
                                            $frekuensi_akhir = $row_peta_risiko->nilai.' - '.$row_peta_risiko->nama;
                                            $dampak_akhir = $row_skor_dampak->nilai.' - '.$row_skor_dampak->nama;
                                            $cari_nilai = DB::table('besaran_resiko')->where([['id_prob',$row_peta_risiko->id],['id_dampak',$row_skor_dampak->id]])->first();
                                            if(request()->get('departemen')){
                                                if(request()->get('departemen')!='semua'){
                                                    $hitung_risikonya = DB::table('resiko_teridentifikasi')
                                                    ->where([['id_departmen',request()->get('departemen')],['frekuensi_akhir',$frekuensi_akhir],['dampak_akhir',$dampak_akhir]])
                                                    ->count();
                                                }else{
                                                    $hitung_risikonya = DB::table('resiko_teridentifikasi')
                                                    ->where([['frekuensi_akhir',$frekuensi_akhir],['dampak_akhir',$dampak_akhir]])
                                                    ->count();
                                                }
                                            }else{
                                                $hitung_risikonya = DB::table('resiko_teridentifikasi')
                                                ->where([['frekuensi_akhir',$frekuensi_akhir],['dampak_akhir',$dampak_akhir]])
                                                ->count();
                                            }
                                            @endphp

                                            <td style="background:{{$cari_nilai->kode_warna}};">
                                            <div class="row">
                                                <div class="col-md-12 text-left font-weight-bold">
                                            {{$hitung_risikonya}}
                                                </div>
                                                <div class="col-md-12 text-right font-weight-bold">
                                            {{$cari_nilai->nilai}}</div>
                                            </div>
                                            </td>
                                            @endforeach
                                        </tr>
                                        @php $no+=1; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
$(function() {
    flatpickr("#tanggal", {
        enableTime: false,
        dateFormat: "d-m-Y",
        mode: "range"
    });
});
</script>
@endpush
