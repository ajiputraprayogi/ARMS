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
@section('content')
<div class="col-md-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Tambah Analisis Risiko</h3>
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
                <form class="form-horizontal" action="{{url('analisa-risiko')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Departemen Pemilik Risiko<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single text search-input" id="cari_departmen"
                                name="departmen" style="width:100%;">
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_dep" id="id_dep">
                    <input type="hidden" name="kodedep" id="kodedep">
                    <input type="hidden" name="namadep" id="namadep">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Tahun<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="tahun" name="tahun" readonly>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Kode Risiko<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single text search-input" id="cari_kode" name="kode"
                                style="width:100%;">
                            </select>
                            <input type="hidden" name="id_analisis" id="id_risiko">
                        </div>
                    </div>
                    <input type="hidden" name="full_kode" id="full_kode">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Pernyataan Risiko</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="pernyataan" name="pernyataan" readonly
                                row="3"></textarea>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Skor yang melekat</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Saat
                                Ini<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="frekkini" id="cario" onchange="caribesaran()">
                                    <option selected disabled hidden>Skor Frekuensi Saat Ini</option>
                                    @foreach($frekuensi as $row)
                                    <option value="{{$row->id}}">{{$row->nilai}} - {{$row->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Saat Ini<i
                                    class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="dampakini" id="dampakk" onchange="caribesaran()"
                                    class="dampakk">
                                    <option selected disabled hidden>Skor Dampak Saat Ini</option>
                                    @foreach($dampak as $row2)
                                    <option value="{{$row2->id}}">{{$row2->nilai}} - {{$row2->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Besaran Saat Ini<i
                                    class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input type="text" name="besaran" id="besaran" class="box1" readonly>
                                <input type="hidden" name="idbesaranmelekat" id="idbesaranmelekat">
                            </div>
                        </div>
                        <input type="hidden" name="warna" id="warna">
                        <input type="hidden" name="nilpro" id="nilpro">
                        <input type="hidden" name="nildam" id="nildam">
                        <input type="hidden" name="nampro" id="nampro">
                        <input type="hidden" name="namdam" id="namdam">
                        <input type="hidden" name="idpro" id="idpro">
                        <input type="hidden" name="iddam" id="iddam">
                    </fieldset>
                    <div class="form-group">
                        <b>Sudah Ada Pengendalian??</b><span> <input value="Sudah" name="sudah_ada_pengendalian"
                                id="sudah_ada_pengendalian" type="checkbox"></label></span>
                    </div>
                    <fieldset class="scheduler-border" id="input_pengendalian_div" style="display:none;">
                        <legend class="scheduler-border">Pengendalian Yang Ada</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="email">Uraian Pengendalian</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="uraian_pengendalian" id="uraian_pengendalian"
                                    rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="email">Apakah Memadai</label>
                            <div class="col-sm-9">
                                <select name="apakah_memadai" class="form-control" id="apakah_memadai">
                                    <option value="Memadai">Memadai</option>
                                    <option value="Belum Memadai">Belum Memadai</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Skor Residu Setelah Pengendalian</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Residu<i
                                    class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="frekkini" id="carir" readonly
                                    onchange="cariresiduotomatis()">
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
                                    onchange="cariresiduotomatis()" readonly>
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
                                <input type="hidden" name="idbesaranresidu" id="idbesaranresidu">
                            </div>
                            <input type="hidden" name="warnar" id="warnar">
                            <input type="hidden" name="nilpror" id="nilpror">
                            <input type="hidden" name="nildamr" id="nildamr">
                            <input type="hidden" name="nampror" id="nampror">
                            <input type="hidden" name="namdamr" id="namdamr">
                            <input type="hidden" name="idpror" id="idpror">
                            <input type="hidden" name="iddamr" id="iddamr">
                        </div>
                    </fieldset>
                    <div class="text-right">
                        <div class="form-group">
                            <button class="btn btn-primary">Simpan</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/customjs/backend/loading.js')}}"></script>
<script src="{{asset('assets/customjs/backend/analisa_risiko.js')}}"></script>
@endpush