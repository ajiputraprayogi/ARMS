@extends('layouts.base')
@section('title')
Pemantauan Risiko | ARMS
@endsection
@section('css')
<style>
.bintang {
    color: red;
}

fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow: 0px 0px 0px 0px #000;
    box-shadow: 0px 0px 0px 0px #000;
}

legend.scheduler-border {
    width: inherit;
    /* Or auto */
    padding: 0 10px;
    /* To give a bit of padding on the left and right */
    border-bottom: none;
    font-size: 15px;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/customjs/backend/loading.css')}}">
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Edit Pemantauan Risiko</h3>
        </div>
        <div class="card-body">
            <div class="loading-div" id="panel">
                @foreach($datadetail as $dtl)
                @php
                $data_manajemen_risiko = DB::table('pelaksanaan_manajemen_risiko')
                ->select(DB::raw('pelaksanaan_manajemen_risiko.*,departemen.nama'))
                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                ->where('pelaksanaan_manajemen_risiko.id',$dtl->id_pelaksanaan_manajemen_risiko)
                ->get();

                $dataresiko = DB::table('resiko_teridentifikasi')
                ->where('full_kode',$dtl->kode_resiko_teridentifikasi)
                ->get();
                @endphp
                <form class="form-horizontal" action="{{url('perubahan-besaran-risiko/'.$dtl->id)}}" method="post">
                <input type="hidden" name="_method" value="put">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Unit Pemilik Risiko<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single text search-input" id="cari_departmen"
                                name="cari_departmen" style="width:100%;">
                                @foreach($data_manajemen_risiko as $dmr)
                            <option value="{{$dmr->id}}-{{$dmr->id_departemen}}">{{$dmr->nama}} -
                                ({{$dmr->priode_penerapan}})</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" @foreach($data_manajemen_risiko as $dmr) value="{{$dmr->id}}" @endforeach>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Tahun<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="tahun" name="tahun" @foreach($data_manajemen_risiko as $dmr) value="{{$dmr->priode_penerapan}}" @endforeach readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Risiko<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single text search-input" id="cari_risiko"
                                name="cari_risiko" style="width:100%;">
                                @foreach($data_manajemen_risiko as $dmr)
                            @php
                            $dataresikoo = DB::table('resiko_teridentifikasi')
                            ->where([['id_departmen',$dmr->id_departemen],['periode_penerapan',$dmr->priode_penerapan]])
                            ->get();
                            @endphp
                            @foreach($dataresiko as $dtrs)
                            <option value="{{$dtrs->id}}" @if($dtrs->full_kode==$dtl->kode_resiko_teridentifikasi) selected
                                @endif>{{$dtrs->full_kode}}</option>
                            @endforeach
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="full_kode" name="full_kode" value="{{$dtl->kode_resiko_teridentifikasi}}">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Pernyataan Risiko</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="pernyataan" name="pernyataan" col="3"
                                readonly>@foreach($dataresiko as $dtr) {{$dtr->pernyataan_risiko}} @endforeach</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Selera Risiko</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="selera_risiko" name="selera_risiko" @foreach($data_manajemen_risiko as $dmr) value="{{$dmr->selera_risiko}}" @endforeach readonly>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Resiko Yang Direspons</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Saat
                                Ini</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="frekuensi_saat_ini"
                                    name="frekuensi_saat_ini" @foreach($datadetail as $dtr) value="{{$dtr->frekuensi_saat_ini}}" @endforeach readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Saat
                                Ini</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dampak_saat_ini" @foreach($datadetail as $dtr) value="{{$dtr->dampak_saat_ini}}" @endforeach name="dampak_saat_ini"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Besaran Risiko Saat Ini
                                <i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input type="text" name="besaran_saat_ini" id="besaran_saat_ini" class="box1" @foreach($datadetail as $dtr) style="background-color:{{$dtr->pr_saat_ini}};" value="{{$dtr->besaran_saat_ini}}" @endforeach readonly>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Level Risiko Aktual</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi<i
                                    class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="frekkini" id="carir" onchange="cariresiduotomatis()">
                                    <option selected disabled hidden>Pilih Skor</option>
                                    @foreach($frekuensi as $row)
                                    <option value="{{$row->id}}" @if($row->id==$dtl->id_frekuensi_aktual) selected @endif>{{$row->nilai}} - {{$row->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak<i
                                    class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="dampakini" id="dampakkr"
                                    onchange="cariresiduotomatis()">
                                    <option selected disabled hidden>Pilih Skor</option>
                                    @foreach($dampak as $row2)
                                    <option value="{{$row2->id}}" @if($row2->id==$dtl->id_dampak_aktual) selected @endif>{{$row2->nilai}} - {{$row2->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Besaran<i
                                    class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input type="text" name="besarankini" id="besarankini" value="{{$dtl->besaran_aktual}}" style="background-color:{{$dtl->warna_aktual}}" class="box1" readonly>
                                <input type="hidden" name="warnabesarankini" id="warnabesarankini" value="{{$dtl->warna_aktual}}" readonly>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Deviasi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="width: 10%!important;" value="{{$dtl->deviasi}}" id="deviasi" name="deviasi"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Rekomendasi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="rekomendasi" name="rekomendasi" col="4">{{$dtl->rekomendasi}}</textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<!-- <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/customjs/backend/loading.js')}}"></script>
<script src="{{asset('assets/customjs/backend/perubahan_besaran_risiko.js')}}"></script>
<!-- s -->
@endpush
