@extends('layouts.base')
@section('title')
Rencana Tindak Pengendalian Risiko | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/customjs/backend/loading.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            <h3 class="mb-3">Tambah Rencana Tindak Pengendalian</h3>
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
                <form class="form-horizontal" action="{{url('/pengendalian')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Unit Pemilik
                                Risiko<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select name="departemen" class="form" id="cari_departemen_manajemen"
                                    style="width: 100%;">
                                </select>
                                <input type="hidden" name="id_manajemen" id="id_manajemen">
                                <input type="hidden" name="faktur" id="faktur">
                                <input type="hidden" name="id_departemen" id="id_departemen">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Periode Penerapan<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input type="text" name="priode_penerapan" id="priode_penerapan" class="form-control"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Risiko<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select name="risiko" class="form" id="cari_risiko" style="width: 100%;">
                                </select>
                                <input type="hidden" name="id_risiko" id="id_risiko">
                                <input type="hidden" name="id_konteks" id="id_konteks">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Pernyataan Risiko<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pernyataan_risiko" id="pernyataan_risiko"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Analisis Akar
                                Masalah<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select name="departemen" class="form" id="cari_akar_masalah" style="width: 100%;">
                                </select>
                                <input type="hidden" name="id_akar_masalah" id="id_akar_masalah" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Kode Tindak
                                Pengendalian<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input type="" class="form-control" name="kode_tindak_pengendalian" id="kode_analisis"
                                    readonly id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Respons Risiko<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <label for="checkbox1"><input type="checkbox" class="checkbox-input"
                                        name="respons_risiko[]" value="Mengurangi Frekuensi" id="checkbox1"> Mengurangi
                                    Frekuensi</label><br>
                                <label for="checkbox2"><input type="checkbox" class="checkbox-input"
                                        name="respons_risiko[]" value="Mengurangi Dampak" id="checkbox2"> Mengurangi
                                    Dampak</label>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Detail Respons Risiko</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="detail_respons_risiko"
                                    id="detail_respons_risiko" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Akar Penyebab<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="akar_penyebab" id="akar_penyebab"
                                    rows="5" readonly></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Kegiatan Pengendalian<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="kegiatan_pengendalian"
                                    id="kegiatan_pengendalian" rows="5" required></textarea>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Klasifikasi Sub Unsur SPIP<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="klasifikasi_sub_unsur_spip" id="" required>
                                    @foreach($klasifikasi as $item)
                                    <option value="{{$item->id}}">{{$item->klasifikasi_sub_unsur_spip}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Klasifikasi Sub Unsur SPIP<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <!-- Select2 -->
                                <select name="klasifikasi[]" multiple="multiple" class="form-control select2" id="cari_klasifikasi" style="width: 100%;"
                                    data-placeholder="Search ...">
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Penanggung Jawab<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input type="" class="form-control" name="penanggung_jawab" value="" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Indikator Keluaran<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input type="" class="form-control" name="indikator_keluaran" value="" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Target Waktu<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <input placeholder="Pilih Target Waktu" class="form-control" id="tanggal" name="target_waktu" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Status Pelaksanaan<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status_pelaksanaan" id="" required readonly>
                                    <option selected value="Belum Dilaksanakan" selected>Belum Dilaksanakan</option>
                                </select>
                            </div>
                        </div>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Skor yang melekat</legend>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Saat
                                    Ini<i class="bintang">*</i></label>
                                <div class="col-sm-9">
                                    <select class="form-control" disabled name="" id="cario" onchange="caribesaran()">
                                    </select>
                                    <input type="hidden" name="frekuensi_saat_ini" id="frekuensi_saat_ini">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Saat
                                    Ini<i class="bintang">*</i></label>
                                <div class="col-sm-9">
                                    <select class="form-control" disabled name="dampak_saat_ini" id="dampakk"
                                        onchange="caribesaran()" class="dampakk">
                                    </select>
                                    <input type="hidden" name="dampak_saat_ini" id="dampak_saat_ini">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center" for="email">Skor Besaran Saat
                                    Ini<i class="bintang">*</i></label>
                                <div class="col-sm-9">
                                    <input type="text" name="besaran_saat_ini" id="besaran" class="box1" readonly>
                                    <input type="hidden" name="pr_saat_ini" id="pr_saat_ini">
                                </div>
                            </div>
                        </fieldset>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger  btn-lg">Batal</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/customjs/backend/loading.js')}}"></script>
<script src="{{asset('assets/customjs/backend/pengendalian_risiko_input.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="{{asset('assets/customjs/backend/add_pengendalian_risiko.js')}}"></script>

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
