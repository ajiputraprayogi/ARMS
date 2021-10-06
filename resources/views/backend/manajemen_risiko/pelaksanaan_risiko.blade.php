@extends('layouts.base')
@section('title')
    Daftar Pelaksanaan Manajemen Risiko | Dashboard
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Daftar Pelaksanaan Manajemen Risiko</h3>
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
                    <div class="col-md-9">
                        <label for="">Tahun</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="dob" name="tanggal1"/>
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
            <div class="card-body p-0 mt-lg-2 mt-0">
                <div class="form-group">
                    <div class="text-right">
                        <a href="{{url('pelaksanaan/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Pelaksanaan Baru</a>
                    </div>
                </div>
                <div class="table-responsive rounded mb-3">
                    <table id="" class="table mb-0 tbl-server-info data-tables">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <!-- <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th> -->
                                <th>Departemen</th>
                                <th>Tahun</th>
                                <th>Jumlah Konteks</th>
                                <th>Jumlah Risiko</th>
                                <th>Selera Risiko</th>
                                <th>PIC</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @foreach($data as $row)
                        <tbody class="ligth-body">
                            <th>{{$row->nama}}</th>
                            <th class="text-center">{{$row->priode_penerapan}}</th>
                            <th class="text-center">{{$row->totalkonteks}}</th>
                            <th class="text-center">{{$row->totalrisiko}}</th>
                            <th class="text-center">{{$row->selera_risiko}}</th>
                            <th>{{$row->nama_pemilik_risiko}}</th>
                            <th class="text-center">
                                <a class="badge badge-info mr-2" data-toggle="modal" data-target="#showpemangku{{$row->id}}" title="View" data-original-title="View"><i class="ri-eye-line mr-0"></i></a>
                                <a class="badge bg-success mr-2" href="{{url('edit-pelaksanaan/'.$row->faktur)}}" title="View" data-original-title="View"><i class="ri-pencil-line mr-0"></i></a>
                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="hapusdatamanajemenrisiko({{$row->id}})"><i class="ri-delete-bin-line mr-0"></i><input type="hidden" name="faktur" value="{{$row->faktur}}"></a>
                                <!-- <a class="badge bg-warning mr-2" data-original-title="Delete" href="{{''}}"><i class="ri-delete-bin-line mr-0"></i></a> -->
                            </th>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/manajemen_risiko.js')}}"></script>
@endpush

