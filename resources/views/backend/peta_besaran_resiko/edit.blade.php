@extends('layouts.base')
@section('title')
    Peta Besaran Risiko | ARMS
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Peta Besaran Risiko</h3>
            </div>
            <div class="card-body">
                @foreach($data as $dataku)
                <form class="form-horizontal" action="{{url('petabesaranresiko/'.$dataku->id)}}" method="post">

                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Kriteria Probabilitas</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="probabilitas">

                                <option selected value="{{$dataku->id_prob}}">{{$dataku->nilai_probabilitas}} - {{$dataku->nama_probabilitas}}</option>

                                @foreach($probabilitas as $data1)
                                    <option value="{{$data1->id}}">{{$data1->nilai}} - {{$data1->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Kriteria Dampak</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="dampak">

                                <option selected  value="{{$dataku->id_dampak}}">{{$dataku->nilai_damp}} - {{$dataku->nama_damp}}</option>

                                @foreach($dampak as $data2)
                                    <option value="{{$data2->id}}">{{$data2->nilai}} - {{$data2->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="email">Nilai Besaran Risiko</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control col-sm-2" name="nilai" value="{{$dataku->nilai_besaran}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="email">Kode Warna</label>
                        <div class="col-sm-9">
                            <input type="color" class="form-control col-sm-1" id="exampleInputcolor" value="{{$dataku->kode_warna}}" name="warna">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="email">Kategori</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="kategori" id="kategori" value="{{$dataku->kategori}}" required>
                                <option value="Sangat Rendah" {{ $dataku->kategori == 'Sangat Rendah' ? 'selected' : '' }}>Sangat Rendah</option>
                                <option value="Rendah" {{ $dataku->kategori == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="Sedang" {{ $dataku->kategori == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Tinggi" {{ $dataku->kategori == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                <option value="Sangat Tinggi" {{ $dataku->kategori == 'Sangat Tinggi' ? 'selected' : '' }}>Sangat Tinggi</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
   </div>
@endsection
@push('script')
    <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script>
@endpush

