@extends('layouts.base')
@section('title')
    Pemantauan Tindak Pengendalian Risiko | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
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
            /* Or auto */
            padding: 0 10px;
            /* To give a bit of padding on the left and right */
            border-bottom: none;
            font-size: 15px;
        }
    </style>
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Pemantauan Tindak Pengendalian Risiko</h3>
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
                <form class="form-horizontal" action="{{url('/pemantauan-efektivitas')}}" method="post">
                    @csrf
                    <div class="form-group">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Unit Pemilik Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <!-- Select2 -->
                            <select name="departemen" class="form" id="cari_departemen_manajemen" style="width: 100%;">
                            </select>
                            <input type="hidden" name="id_manajemen" id="id_manajemen">
                            <input type="hidden" name="faktur" id="faktur">
                            <input type="hidden" name="id_departemen" id="id_departemen">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Tahun<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" name="priode_penerapan" id="priode_penerapan" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <!-- Select2 -->
                            <select name="risiko" class="form" id="cari_risiko" style="width: 100%;">
                            </select>
                            <input type="hidden" name="id_risiko" id="id_risiko">
                            <input type="hidden" name="id_konteks" id="id_konteks">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Pernyataan Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="pernyataan_risiko" id="pernyataan_risiko" readonly>
                            <!-- <label id="pernyataan_risiko" for=""></label> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Kode Tindak Pengendalian <i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <!-- Auto Kode Generate -->
                            <!-- Select2 -->
                            <select name="kode_tindak_pengendalian" class="form" id="cari_akar_masalah" style="width: 100%;">
                            </select>
                            <input type="hidden" name="id_pengendalian" id="id_pengendalian" required>
                            <!-- <input type="hidden" name="id_departemen" id="id_departemen"> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Kegiatan Pengendalian<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="kegiatan_pengendalian" id="kegiatan_pengendalian" rows="5" required></textarea>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Skor Resiko Yang Direspons</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi yang direspon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="frekuensi_saat_ini"
                                    name="frekuensi_saat_ini" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor dampak yang direspons</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dampak_saat_ini" name="dampak_saat_ini"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Besaran risiko yang direspons </label>
                            <div class="col-sm-9">
                                <input type="text" name="besaran_saat_ini" id="besaran_saat_ini" class="box1" readonly>
                                <input type="hidden" name="pr_saat_ini" id="pr_saat_ini">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Skor Risiko Aktual</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Aktual</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="frekuensi_akhir"
                                    name="frekuensi_akhir" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Aktual </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dampak_akhir" name="dampak_akhir"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Besaran risiko aktual</label>
                            <div class="col-sm-9">
                                <input type="text" name="besaran_akhir" id="besaran_akhir" class="box1" readonly>
                                <input type="hidden" name="pr_akhir" id="pr_akhir">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Keterangan (Usulan/Komentar)</i></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="5"></textarea>
                        </div>
                    </div>
                    <!-- <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Level Risiko Aktual</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Residu<i
                                    class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="frekkini" id="carir" onchange="cariresiduotomatis()">
                                    <option selected disabled hidden>Skor Frekuensi Saat Ini</option>
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
                    </fieldset> -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                        <button type="reset" onclick="history.go(-1)" class="btn btn-danger  btn-lg">Batal</button>
                    </div>
                </form>
            </div>
        </div>
   </div>
@endsection
@push('script')
    <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
    <!-- <script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script> -->
    <script src="{{asset('assets/customjs/backend/pemantauan_efektivitas.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

