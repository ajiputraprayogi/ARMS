@extends('layouts.base')
@section('title')
    Peta Besaran Risiko | Dashboard
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Peta Besaran Risiko</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Kriteria Probabilitas</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="client" id="">
                                <option selected disabled value="">Pilih Kriteria Probabilitas</option>
                                <option value="">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Kriteria Dampak</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="client" id="">
                                <option selected disabled value="">Pilih Kriteria Dampak</option>
                                <option value="">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="email">Nilai Besaran Risiko</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control col-sm-2" id="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="email">Kode Warna</label>
                        <div class="col-sm-9">
                            <input type="color" class="form-control col-sm-1" id="exampleInputcolor" value="#32BDEA">
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="form-group">
                            <button class="btn btn-primary">Simpan</button>
                            <button class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
   </div>
@endsection
@push('script')
    <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script>
@endpush

 