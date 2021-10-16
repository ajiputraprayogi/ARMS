@extends('layouts.base')
@section('title')
Pengendalian Risiko | Dashboard
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/customjs/backend/loading.css')}}">
<style>
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow: 0px 0px 0px 0px #000;
    box-shadow: 0px 0px 0px 0px #000;
}

legend.scheduler-border {
    width: inherit;
    padding: 0 10px;
    border-bottom: none;
    font-size: 15px;
}
</style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Edit Pengendalian Risiko</h3>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-body">
            <div class="loading-div" id="panel">
                @foreach($data as $row)
                @php
                $data_manajemen_risiko = DB::table('pelaksanaan_manajemen_risiko')
                ->select(DB::raw('pelaksanaan_manajemen_risiko.*,departemen.nama'))
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->where('pelaksanaan_manajemen_risiko.id',$row->id_manajemen)
                ->get();

                $dataresiko = DB::table('resiko_teridentifikasi')
                ->where('id',$row->id_risiko)
                ->get();

                $dataakarselect = DB::table('analisa_masalah')
                ->where('id',$row->id_akar_masalah)
                ->get();
                @endphp
                <form class="form-horizontal" action="{{url('/pengendalian/'.$row->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Departemen Pemilik
                                Risiko*</label>
                            <div class="col-sm-9">
                                <select name="departemen" class="form" id="cari_departemen_manajemen"
                                    style="width: 100%;">
                                    @foreach($data_manajemen_risiko as $dmr)
                                    <option value="{{$dmr->id}}-{{$dmr->id_departemen}}">{{$dmr->nama}} -
                                        ({{$dmr->priode_penerapan}})</option>
                                    @endforeach
                                </select>
                                <input type="hidden" value="{{$row->id_departemen}}" name="id_manajemen"
                                    id="id_manajemen">
                                <input type="hidden" value="{{$row->id_manajemen}}" name="id_departemen"
                                    id="id_departemen">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Periode Penerapan*</label>
                            <div class="col-sm-9">
                                <input type="text" name="priode_penerapan" id="priode_penerapan" class="form-control"
                                    @foreach($data_manajemen_risiko as $dmr) value="{{$dmr->priode_penerapan}}"
                                    @endforeach readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Risiko*</label>
                            <div class="col-sm-9">
                                <select name="risiko" class="form" id="cari_risiko" style="width: 100%;">
                                    @foreach($data_manajemen_risiko as $dmr)
                                    @php
                                    $dataresikoo = DB::table('resiko_teridentifikasi')
                                    ->where([['id_departmen',$dmr->id_departemen],['periode_penerapan',$dmr->priode_penerapan]])
                                    ->get();
                                    @endphp
                                    @foreach($dataresiko as $dtrs)
                                    <option value="{{$dtrs->id}}" @if($dtrs->
                                        id==$row->id_risiko) selected
                                        @endif>{{$dtrs->full_kode}}</option>
                                    @endforeach
                                    @endforeach
                                </select>
                                <input type="hidden" name="id_risiko" value="{{$row->id_risiko}}" id="id_risiko">
                                <input type="hidden" name="id_konteks" id="id_konteks">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Pernyataan Risiko*</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="pernyataan" name="pernyataan" col="3"
                                    readonly>@foreach($dataresiko as $dtr) {{$dtr->pernyataan_risiko}} @endforeach</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Analisis Akar
                                Masalah*</label>
                            <div class="col-sm-9">
                                <select name="departemen" class="form" id="cari_akar_masalah" style="width: 100%;">
                                    @foreach($dataresiko as $dtrs)
                                    @php
                                    $dataakar = DB::table('analisa_masalah')
                                    ->where('kode_risiko',$dtrs->full_kode)
                                    ->get();
                                    @endphp
                                    @foreach($dataakar as $dtakr)
                                    <option value="{{$dtakr->id}}" @if($dtakr->
                                        id==$row->id_akar_masalah) selected
                                        @endif>{{$dtakr->kode_analisis}}</option>
                                    @endforeach
                                    @endforeach
                                </select>
                                <input type="hidden" name="id_akar_masalah" value="{{$row->id_akar_masalah}}" id="id_akar_masalah" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Kode Tindak
                                Pengendalian*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$row->kode_tindak_pengendalian}}"
                                    name="kode_tindak_pengendalian" id="kode_analisis" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Respons Risiko *</label>
                            <div class="col-sm-9">
                                @php
                                $newpic =', '.$row->respons_risiko;
                                $datarespon=explode(', ',$newpic);
                                @endphp
                                <label for="checkbox1"><input type="checkbox" class="checkbox-input"
                                        name="respons_risiko[]" @foreach($datarespon as $dres) @if($dres=='Mengurangi Frekuensi') checked @endif @endforeach value="Mengurangi Frekuensi" id="checkbox1"> Mengurangi
                                    Frekuensi</label><br>
                                <label for="checkbox2"><input type="checkbox" class="checkbox-input"
                                        name="respons_risiko[]" @foreach($datarespon as $dres) @if($dres=='Mengurangi Dampak') checked @endif @endforeach value="Mengurangi Dampak" id="checkbox2"> Mengurangi
                                    Dampak</label>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Akar Penyebab*</label>
                            <div class="col-sm-9">

                                <textarea class="form-control" name="akar_penyebab" id="akar_penyebab" rows="5"
                                    readonly>@foreach($dataakarselect as $dtaks) {{$dtaks->akar_masalah}} @endforeach</textarea>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Kegiatan Pengendalian*</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="kegiatan_pengendalian" id="kegiatan_pengendalian"
                                    rows="5" required>{{$row->kegiatan_pengendalian}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Klasifikasi Sub Unsur SPIP*</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="klasifikasi_sub_unsur_spip" id="" required>
                                    @foreach($klasifikasi as $item)
                                    <option value="{{$item->id}}" @if($row->id_klasifikasi_sub_unsur_spip==$item->id)
                                        selected @endif>{{$item->klasifikasi_sub_unsur_spip}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Penanggung Jawab*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="penanggung_jawab"
                                    value="{{$row->penanggung_jawab}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Indikator Keluaran*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="indikator_keluaran"
                                    value="{{$row->indikator_keluaran}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Target Waktu*</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="dob" value="{{$row->target_waktu}}"
                                    name="target_waktu" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Status Pelaksanaan*</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status_pelaksanaan" required>
                                    <option value="Belum Dilaksanakan" @if($row->status_pelaksanaan=='Belum
                                        Dilaksanakan') selected @endif>Belum Dilaksanakan</option>
                                    <option value="Dalam Proses Pelaksanaan" @if($row->status_pelaksanaan=='Dalam Proses
                                        Pelaksanaan') selected @endif>Dalam Proses Pelaksanaan</option>
                                    <option value="Selesai Dilaksanakan" @if($row->status_pelaksanaan=='Selesai
                                        Dilaksanakan') selected @endif>Selesai Dilaksanakan</option>
                                    <option value="Belum Terealisasi" @if($row->status_pelaksanaan=='Belum Terealisasi')
                                        selected @endif>Belum Terealisasi</option>
                                </select>
                            </div>
                        </div>

                        @foreach($skorrisiko as $item)
                                <input type="hidden" name="id_peta_besaran_risiko" value="{{$item->idb}}">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Skor yang melekat</legend>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Saat
                                    Ini<i class="bintang">*</i></label>
                                <div class="col-sm-9">
                                    <select class="form-control" disabled>
                                        <option value="{{$item->idp}}">{{$item->nilaip}} - {{$item->namap}}</option>
                                    </select>
                                    <input type="hidden" name="frekuensi_saat_ini" id="frekuensi_saat_ini">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Saat
                                    Ini<i class="bintang">*</i></label>
                                <div class="col-sm-9">
                                    <select class="form-control" disabled name="dampak_saat_ini" id="dampakk">\
                                        <option value="{{$item->idd}}">{{$item->nilaid}} - {{$item->namad}}</option>>
                                    </select>
                                    <input type="hidden" name="dampak_saat_ini" id="dampak_saat_ini">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center" for="email">Skor Besaran Saat
                                    Ini<i class="bintang">*</i></label>
                                <div class="col-sm-9">

                                    <input type="text" style="background-color: {{$item->kode_warna}};"
                                        name="besaran_saat_ini" id="besaran" value="{{$item->nilaib}}" class="box1"
                                        readonly>
                                    <input type="hidden" name="pr_saat_ini" id="pr_saat_ini">
                                </div>
                            </div>
                        </fieldset>
                        @endforeach
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger  btn-lg">Batal</button>
                        </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/customjs/backend/loading.js')}}"></script>
<script src="{{asset('assets/customjs/backend/pengendalian_risiko_input.js')}}"></script>
@endpush