@extends('layouts.base')
@section('title')
    Periode Pelaporan | ARMS
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Edit Periode Pelaporan</h3>
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
                <form class="form-horizontal" action="{{url('periodepelaporan/'.$data->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Tanggal Mulai</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_mulai" class="form-control" id="" value="{{$data->tanggal_mulai}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Tanggal Selesai</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_selesai" class="form-control" id="" value="{{$data->tanggal_selesai}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status" id="" value="{{$data->status}}">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Periode</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_periode" class="form-control" id="" value="{{$data->nama_periode}}" required>
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

