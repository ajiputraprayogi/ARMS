@extends('layouts.base')
@section('title')
    Departemen | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Departemen</h3>
            </div>
            <div class="card-body p-0 mt-lg-2 mt-0">
                @if (session('status'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text"><b>Info!</b> {{ session('status') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                @endif
                <div class="form-group">
                    <div class="text-right">
                        <a href="{{url('departemen/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Departemen</a>
                    </div>
                </div>
                <div class="table-responsive rounded mb-3">
                    <table id="list-data" class="table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <!-- <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th> -->
                                <th>Kode Departemen </th>
                                <th>Nama Departemen</th>
                                <th>Mengelola Risiko</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach($data as $item)
                            <tr>
                                <td>{{$item->kode}}</td>
                                <td>{{$item->nama}}</td>
                                @if($item->namadep=='')
                                <td>Tidak Ada</td>
                                @else
                                <td>{{$item->namadep}}</td>
                                @endif
                                <td>
                                <a class="btn btn-success btn-sm m-1"
                                    href="{{url('/departemen/'.$item->id.'/edit')}}">
                                    <i class="ri-pencil-line mr-0"></i>
                                </a>
                                <button class="btn btn-sm btn-danger m-1" data-toggle="tooltip" data-placement="top"
                                    title="" data-original-title="Delete" onclick="hapusdata({{$item->id}})"><i
                                        class="ri-delete-bin-line mr-0"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="show{{$item->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Departemen</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="{{url('departemen')}}" method="post">
                                                @csrf
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Kode Departemen</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="kode" class="form-control" value="{{$item->kode}}" id="" readonly required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Nama Departemen</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="nama" class="form-control" value="{{$item->nama}}" id="" readonly required>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
    <!-- <script src="{{asset('assets/customjs/backend/departemen.js')}}"></script> -->
@endpush

