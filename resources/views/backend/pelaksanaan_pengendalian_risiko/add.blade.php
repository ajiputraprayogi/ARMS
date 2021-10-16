@extends('layouts.base')
@section('title')
    Pengendalian Risiko | Dashboard
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
                <h3 class="mb-3">Pengendalian Risiko</h3>
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
                <form class="form-horizontal" action="{{url('/pelaksanaan-pengendalian')}}" method="post">
                    @csrf
                    <div class="form-group">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Departemen Pemilik Risiko*</label>
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
                        <label class="control-label col-sm-3 align-self-center" for="">Periode Penerapan*</label>
                        <div class="col-sm-9">
                            <input type="text" name="priode_penerapan" id="priode_penerapan" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Risiko*</label>
                        <div class="col-sm-9">
                            <!-- Select2 -->
                            <select name="risiko" class="form" id="cari_risiko" style="width: 100%;">
                            </select>
                            <input type="hidden" name="id_risiko" id="id_risiko">
                            <input type="hidden" name="id_konteks" id="id_konteks">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Pernyataan Risiko*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="pernyataan_risiko" id="pernyataan_risiko" readonly>
                            <!-- <label id="pernyataan_risiko" for=""></label> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Kode Tindak Pengendalian *</label>
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
                        <label class="control-label col-sm-3" for="">Kegiatan Pengendalian*</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="kegiatan_pengendalian" id="kegiatan_pengendalian" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Penanggung Jawab*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="penanggung_jawab" value="" id="penanggung_jawab">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Indikator Keluaran*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="indikator_keluaran" value="" id="indikator_keluaran">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Target Waktu*</label>
                        <div class="col-sm-9">
                        <input type="date" class="form-control" id="target_waktu" name="target_waktu"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Realisasi Waktu*</label>
                        <div class="col-sm-9">
                        <input type="date" class="form-control" id="dob" name="realisasi_waktu"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Update Status Tindak Pengendalian Menjadi*</label>
                        <div class="col-sm-9">
                        <select class="form-control" name="status_pelaksanaan" id="" required>
                            <option selected value="Belum Dilaksanakan" selected>Belum Dilaksanakan</option>
                            <option value="Dalam Proses Pelaksanaan">Dalam Proses Pelaksanaan</option>
                            <option value="Selesai Dilaksanakan">Selesai Dilaksanakan</option>
                            <option value="Belum Terealisasi">Belum Terealisasi</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Hambatan/Kendala*</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="hambatan" id="exampleFormControlTextarea1" rows="5" required></textarea>
                        </div>
                    </div>
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
    <script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/pelaksanaan_pengendalian_risiko.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

 