@extends('layouts.base')
@section('title')
    Unit Kerja | ARMS
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Unit Kerja</h3>
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
                        <label class="control-label col-sm-3 align-self-center" for="">Kode Unit Kerja</label>
                        <div class="col-sm-9">
                            <input type="text" name="kode" class="form-control" id="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Unit Kerja</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" id="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Mengelola Risiko</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="mengelola_risiko" id="">
                                <option value="">Pilih Mengelola Risiko</option>
                                @foreach($data as $row)
                                            <option value="
                                                @if($row->id_atasan=='')
                                                    {{$row->id}}
                                                @else
                                                    {{$row->id}},{{$row->id_atasan}}
                                                @endif">{{$row->nama}}</option>
                                @endforeach
                            </select>
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

