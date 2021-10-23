@extends('layouts.base')
@section('title')
    Pencatatan Peristiwa Risiko | ARMS
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
                <h3 class="mb-3">Pencatatan Peristiwa Risiko</h3>
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
                <form class="form-horizontal" action="{{url('/pencatatan-peristiwa')}}" method="post">
                    @csrf
                    <div class="form-group">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Departemen Pemilik Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <!-- Select2 -->
                            <select name="departemen" class="form select" id="cari_departemen_manajemen" style="width: 100%;">
                                <option selected>---Pilih Departemen---</option>
                                @foreach ($resiko as $item)
                                    <option  value="{{$item->id}}">{{$item->departmen_pemilik_resiko}} || {{$item->periode_penerapan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Tahun<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" name="tahun" id="priode_penerapan" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <!-- Select2 -->
                            <select name="risiko" class="form select" id="cari_risiko" style="width: 100%;">
                            </select>
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
                        <label class="control-label col-sm-3 align-self-center" for="">Uraian Peristiwa<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="uraian" id="uraian" rows="5" readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Waktu Kejadian<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                        <input type="date" class="form-control" name="waktu"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Tempat Kejadian<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="tempat" id="tempat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Skor Dampak<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                        <select class="form-control" name="skor" id="" required>
                            <option selected disabled value="">Pilih Skor Dampak</option>
                            @foreach($dampakterakhir as $item)
                            <option value="{{$item->id}}">{{ $item->nilai }} || {{$item->nama}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Pemicu Peristiwa<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="pemicu" id="exampleFormControlTextarea1" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Kode Penyebab<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                        <select class="form-control" name="kode_penyebab" id="" required>
                            <option selected disabled value="">Pilih Skor Dampak</option>
                            @foreach($penyebab as $item)
                            <option value="{{$item->id}}">{{ $item->kode }} || {{$item->penyebab}}</option>
                            @endforeach
                        </select>
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
    <script src="{{asset('assets/customjs/backend/pencatatanperistiwa.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

