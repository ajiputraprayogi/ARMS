@extends('layouts.base')
@section('title')
Toko Online | Analisa Risiko
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
            <h3 class="mb-3">Tambah Perubahan Besaran Risiko</h3>
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
                <form class="form-horizontal" action="{{url('perubahan-besaran-risiko')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Departemen Pemilik Resiko<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single text search-input" id="cari_departmen"
                                name="cari_departmen" style="width:100%;">
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Tahun<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="tahun" name="tahun" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Risiko<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single text search-input" id="cari_risiko"
                                name="cari_risiko" style="width:100%;">
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="full_kode" name="full_kode">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Pernyataan Risiko</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="pernyataan" name="pernyataan" col="3"
                                readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Selera Risiko</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="selera_risiko" name="selera_risiko" readonly>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Resiko Yang Direspons</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Saat
                                Ini</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="frekuensi_saat_ini"
                                    name="frekuensi_saat_ini" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Saat
                                Ini</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dampak_saat_ini" name="dampak_saat_ini"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Besaran Risiko Saat Ini
                                <i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input type="text" name="besaran_saat_ini" id="besaran_saat_ini" class="box1" readonly>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Level Risiko Aktual</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Residu<i
                                    class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="frekkini" id="carir" onchange="cariresiduotomatis()">
                                    <option selected disabled hidden>Skor Frekuensi Saat Ini</option>
                                    @foreach($frekuensi as $row)
                                    <option value="{{$row->id}}">{{$row->nilai}} - {{$row->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Residu<i
                                    class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="dampakini" id="dampakkr"
                                    onchange="cariresiduotomatis()">
                                    <option selected disabled hidden>Skor Dampak Saat Ini</option>
                                    @foreach($dampak as $row2)
                                    <option value="{{$row2->id}}">{{$row2->nilai}} - {{$row2->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Besaran Residu<i
                                    class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input type="text" name="besarankini" id="besarankini" class="box1" readonly>
                                <input type="hidden" name="warnabesarankini" id="warnabesarankini" readonly>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Deviasi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="width: 10%!important;" id="deviasi" name="deviasi"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Rekomendasi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="rekomendasi" name="rekomendasi" col="4"></textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
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