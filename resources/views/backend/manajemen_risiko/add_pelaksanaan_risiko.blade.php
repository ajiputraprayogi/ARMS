@extends('layouts.base')
@section('title')
    Toko Online | Dashboard
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Detail Pelaksanaan Manajemen Risiko</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Departemen Pemilik Risiko*</label>
                        <div class="iq-search-bar device-search col-sm-9">
                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                            <input type="text" class="text search-input" placeholder="Search here...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Nama Pemilik Risiko*</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Jabatan Pemilik Risiko*</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Nama Koordinator Pengelola Risiko*</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Jabatan Koordinator Pengelola Risiko*</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Periode Penerapan*</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="client" id="">
                                <option selected disabled value="">Pilih Tahun</option>
                                <option value="">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Selera Risiko*</label>
                        <div class="col-sm-2">
                            <input type="email" class="form-control" id="email">
                        </div>
                    </div>
                </form>
                <div class="form-group">
                    <b>Konteks</b>
                </div>
                <div class="form-group">
                    <div class="text-right">
                        <a href="{{url('pelaksanaan/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Konteks</a>
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
                                <th>Kode Konteks</th>
                                <th>Nama Konteks</th>
                                <th>Jenis Konteks </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <b>Pemangku Kepentingan</b>
                </div>
                <div class="form-group">
                    <div class="text-right">
                        <a href="{{url('pelaksanaan/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Pemangku Kepentingan</a>
                    </div>
                </div>
                <div class="table-responsive rounded mb-3">
                    <table id="list-data1" class="table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <!-- <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th> -->
                                <th>No</th>
                                <th>Nama Pemangku kepentingan</th>
                                <th>Keterangan</th>
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
    <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script>
@endpush

 