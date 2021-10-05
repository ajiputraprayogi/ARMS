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
                <form class="form-horizontal" action="{{url('/pelaksanaan')}}" method="post">
                    @csrf
                    <div class="form-group">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Departemen Pemilik Risiko*</label>
                        <div class="col-sm-9">
                            <!-- Auto Kode Generate -->
                            <input type="hidden" value="<?php 
                                $tgl=date("Y-m-d");
                                $min=date("-");
                                $fk=DB::table("pelaksanaan_manajemen_risiko")
                                ->select(DB::Raw("MAX(RIGHT(faktur,5)) as kd_max"));
                                if($fk->count()>0){
                                // $finalkode="DVN".$tgl."00001";
                                    foreach($fk->get() as $fak){
                                        $tmp=((int)$fak->kd_max)+1;
                                        $finalkode="FK".$tgl.$min.sprintf('%05s',$tmp);
                                    }
                                }else{
                                    $finalkode="FK".$tgl.$min."00001";
                                }
                                echo $finalkode; ?>" 
                            name="faktur" id="faktur" class="form-group form-control" required readonly>
                            <!-- Select2 -->
                            <select name="departemen" class="form" id="cari_departemen_manajemen" style="width: 100%;" data-placeholder="Search ...">
                            </select>
                            <input type="hidden" name="id_manajemen" id="id_manajemen">
                            <input type="hidden" name="id_departemen" id="id_departemen">
                            <input type="hidden" name="risiko" id="id_coba">
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
                            <select name="risiko" class="form" id="cari_risiko" style="width: 100%;" data-placeholder="Search ...">
                            </select>
                            <input type="hidden" name="id_risiko" id="id_risiko">
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
                        <label class="control-label col-sm-3 align-self-center" for="">Analisis Akar Masalah*</label>
                        <div class="col-sm-9">
                            <!-- Auto Kode Generate -->
                            <input type="hidden" value="" name="faktur" id="faktur" class="form-group form-control" required readonly>
                            <!-- Select2 -->
                            <select name="departemen" class="form" id="cari_departemen" style="width: 100%;" data-placeholder="Search ...">
                            </select>
                            <input type="hidden" name="id_departemen" id="id_departemen">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Kode Tindak Pengendalian*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="nama_koordinator_pengelola_risiko" readonly id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Respons Risiko *</label>
                        <div class="col-sm-9">
                            <input type="checkbox" class="checkbox-input" id="checkbox1">
                            <label for="checkbox1">Mengurangi Frekuensi</label><br>
                            <input type="checkbox" class="checkbox-input" id="checkbox2">
                            <label for="checkbox2">Mengurangi Dampak</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Akar Penyebab*</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Kegiatan Pengendalian*</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Klasifikasi Sub Unsur SPIP*</label>
                        <div class="col-sm-9">
                        <select class="form-control" name="id_konteks" id="" required>
                            <option selected disabled value="">Pilih Klasifikasi Sub Unsur SPIP</option>
                            @foreach($klasifikasi as $item)
                            <option value="{{$item->id}}">{{$item->klasifikasi_sub_unsur_spip}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Penanggung Jawab*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="nama_koordinator_pengelola_risiko" value="" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Indikator Keluaran*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="nama_koordinator_pengelola_risiko" value="" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Target Waktu*</label>
                        <div class="col-sm-9">
                        <input type="date" class="form-control" id="dob" name="tanggal1"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Status Pelaksanaan*</label>
                        <div class="col-sm-9">
                        <select class="form-control" name="id_konteks" id="" required>
                            <option selected value="Belum Dilaksanakan">Belum Dilaksanakan</option>
                            <option value="Dalam Proses Pelaksanaan">Dalam Proses Pelaksanaan</option>
                            <option value="Selesai Dilaksanakan">Selesai Dilaksanakan</option>
                            <option value="Belum Terealisasi">Belum Terealisasi</option>
                        </select>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Skor Risiko Yang direspons</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Skor Frekuensi Saat Ini </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="id_konteks" id="" disabled required>
                                    @foreach($frekuensiterakhir as $item)
                                        <option value="{{$item->id}}">{{$item->nilai}} - {{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Skor Dampak Saat Ini</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="id_konteks" id="" disabled required>
                                    @foreach($dampakterakhir as $item)
                                        <option value="{{$item->id}}">{{$item->nilai}} - {{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="">Status Pelaksanaan*</label>
                            <div class="col-sm-1">
                                @foreach($risikoterakhir as $item)
                                    <div style="border: 0; padding: 10px; background-color: {{$item->pr}}; text-align: center;">{{$item->besaran_akhir}}</div>
                                @endforeach
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
@endsection
@push('script')
    <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/pengendalian_risiko.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

 