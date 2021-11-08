@extends('layouts.base')
@section('title')
    Pelaporan Pengelolaan Risiko | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Pelaporan Pengelolaan Risiko</h3>
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
                        <a href="{{url('pelaporan-pengelolaan-risiko/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Pelaporan</a>
                    </div>
                </div>
                <div class="table-responsive rounded mb-3">
                    <table id="list-data" class="table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>Periode Pelaporan</th>
                                <th>Unit Kerja</th>
                                <th>Status</th>
                                <th>File</th>
                                <th>Tembusan</th>
                                <th>Action</th>
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
    <script src="{{asset('assets/customjs/backend/pelaporanpengelolaanrisiko.js')}}"></script>
@endpush

