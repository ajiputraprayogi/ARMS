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
                <form class="form-horizontal" action="{{url('departemen/'.$data->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Kode Departemen</label>
                        <div class="col-sm-9">
                            <input type="text" name="kode" class="form-control" value="{{$data->kode}}" id="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Departemen</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" value="{{$data->nama}}" id="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="">Mengelola Risiko</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="mengelola_risiko" id="">
                                <option value="">Pilih Mengelola Risiko</option>
                                @foreach($datadep as $row)
                                    @if($row->mengelola_risiko=='')
                                        @if($row->id!==$data->id)
                                            <option value="{{$row->id}}">{{$row->nama}}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            <!-- @foreach($datadep as $row)
                            @if($row->id!==$data->id)
                                @if($row->mengelola_risiko == '')
                                @php
                                $newpic =','.$data->mengelola_risiko;
                                $datarespon=explode(',',$newpic);
                                @endphp
                                    <div class="checkbox d-inline-block mr-3">
                                        <label for="{{$row->id}}"><input type="checkbox" class="checkbox-input" name="mengelola_risiko[]" @foreach($datarespon as $dres) @if($dres==$row->id) checked @endif @endforeach value="{{$row->id}}" id="{{$row->id}}">
                                         {{$row->nama}}</label>
                                    </div>
                                @else

                                @endif
                            @endif
                            @endforeach -->
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="form-group">
                        <button class="btn btn-primary">Edit</button>
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

 