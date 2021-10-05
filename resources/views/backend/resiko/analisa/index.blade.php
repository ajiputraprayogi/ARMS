@extends('layouts.base')
@section('title')
ARMS | Analisa Risiko
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Daftar Analisa Risiko</h3>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Departemen</label>
                    <div class="form-group">
                        <select class="form-control" name="client" id="">
                            <option selected disabled value="">Pilih Departemen</option>
                            <option value="">...</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Konteks</label>
                    <div class="form-group">
                        <select class="form-control" name="client" id="">
                            <option selected disabled value="">Pilih Konteks</option>
                            <option value="">...</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="">Tahun</label>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" class="form-control" id="dob" name="tanggal1" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="">
                                <button type="submit" class="btn btn-primary">Reset Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @if (session('status'))
        <div class="alert text-white bg-success" role="alert">
            <div class="iq-alert-text"><b>Info!</b> {{ session('status') }}</div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ri-close-line"></i>
            </button>
        </div>
        @endif
        <div class="card-body p-0 mt-lg-2 mt-0">
            <div class="form-group">
                <div class="text-right">
                    <a href="{{url('analisa-risiko/create')}}" class="btn btn-primary add-list"><i
                            class="las la-plus mr-3"></i>Tambah Risiko Baru</a>
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
                            <th>Kode Risiko</th>
                            <th>Besaran Melekat</th>
                            <th>Beseran risiko Residu</th>
                            <th>Sudah Ada Pengendalian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
<script src="{{asset('assets/customjs/backend/analisa_risiko.js')}}"></script>
@endpush