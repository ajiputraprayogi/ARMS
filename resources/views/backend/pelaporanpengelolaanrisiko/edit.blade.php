@extends('layouts.base')
@section('title')
    Pelaporan Pengelolaan Risiko | ARMS
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Edit Pelaporan Pengelolaan Risiko</h3>
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
                <form class="form-horizontal" action="{{url('pelaporan-pengelolaan-risiko/'.$data->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status" value="{{$data->status}}" id="">
                                <option value="diajukan" @if ($data->status == 'diajukan') selected @endif>Diajukan</option>
                                <option value="proses pemeriksaan" @if ($data->status == 'proses pemeriksaan') selected @endif>Proses Pemeriksaan</option>
                                <option value="laporan diterima" @if ($data->status == 'laporan diterima') selected @endif>Laporan Diterima</option>
                            </select>
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

