@extends('layouts.base')
@section('title')
    Periode Pelaporan | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Periode Pelaporan</h3>
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
                        <a href="{{url('periodepelaporan/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Periode Pelaporan</a>
                    </div>
                </div>
                <div class="table-responsive rounded mb-3">
                    <table id="list-data" class="table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Nama Periode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach($data as $item)
                            <div class="modal fade" id="show{{$item->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Periode Pelaporan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" action="{{url('periodepelaporan')}}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Tanggal Mulai</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="tanggal_mulai" class="form-control" value="{{$item->tanggal_mulai}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Tanggal Selesai</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="tanggal_selesai" class="form-control" value="{{$item->tanggal_selesai}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Status</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="status" class="form-control" value="{{$item->status}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Nama Periode</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="nama_periode" class="form-control" value="{{$item->nama_periode}}" id="" readonly required>
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
    <!-- <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script> -->
    <script src="{{asset('assets/customjs/backend/periodepelaporan.js')}}"></script>
@endpush

