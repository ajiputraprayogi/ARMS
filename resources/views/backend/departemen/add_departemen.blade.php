@extends('layouts.base')
@section('title')
    Departemen | ARMS
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Departemen</h3>
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
                <form class="form-horizontal" action="{{url('departemen')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Kode Departemen</label>
                        <div class="col-sm-9">
                            <input type="text" name="kode" class="form-control" id="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Departemen</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" id="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Mengelola Risiko</label>
                        <div class="col-sm-9">
                            @foreach($data as $row)
                                <div class="checkbox d-inline-block mr-3">
                                    <label for="{{$row->id}}"><input type="checkbox" class="checkbox-input" name="mengelola_risiko[]" value="{{$row->id}}" id="{{$row->id}}">
                                        {{$row->nama}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
@endsection
@push('script')
    <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script>
@endpush

 