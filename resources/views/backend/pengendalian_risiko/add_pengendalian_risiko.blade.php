@extends('layouts.base')
@section('title')
    Pengendalian Risiko | Dashboard
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.css')}}"> 
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}"> 
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Pengendalian Risiko</h3>
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
                <form class="form-horizontal" action="{{url('/pelaksanaan')}}" method="post">
                    @csrf
                    <div class="form-group">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Departemen Pemilik Risiko*</label>
                        <div class="col-sm-9">
                            <!-- Auto Kode Generate -->
                            <input type="hidden" value="<?php 
                                $tgl=date("Y-m-d");
                                $min=date("-");
                                $fk=DB::table("pelaksanaan_manajemen_risiko")
                                ->select(DB::Raw("MAX(RIGHT(faktur,5)) as kd_max"));
                                if($fk->count()>0){
                                // $finalkode="DVN".$tgl."00001";
                                    foreach($fk->get() as $fak){
                                        $tmp=((int)$fak->kd_max)+1;
                                        $finalkode="FK".$tgl.$min.sprintf('%05s',$tmp);
                                    }
                                }else{
                                    $finalkode="FK".$tgl.$min."00001";
                                }
                                echo $finalkode; ?>" 
                            name="faktur" id="faktur" class="form-group form-control" required readonly>
                            <!-- Select2 -->
                            <select name="departemen" class="form" id="cari_departemen" style="width: 100%;" data-placeholder="Search ...">
                            </select>
                            <input type="hidden" name="id_departemen" id="id_departemen">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Periode Penerapan*</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="priode_penerapan" id="">
                                <option selected disabled value="">Pilih Tahun</option>
                                <?php 
                                    $tahun=date('Y'); for ($i=$tahun; $i<=date('Y') +5 ; $i++)
                                    echo "<option value='$i'>$i</option>
                                    "; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Risiko*</label>
                        <div class="col-sm-9">
                            <!-- Auto Kode Generate -->
                            <input type="hidden" value="" name="faktur" id="faktur" class="form-group form-control" required readonly>
                            <!-- Select2 -->
                            <select name="departemen" class="form" id="cari_departemen" style="width: 100%;" data-placeholder="Search ...">
                            </select>
                            <input type="hidden" name="id_departemen" id="id_departemen">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Pemilik Risiko*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_pemilik_risiko" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Jabatan Pemilik Risiko*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="jabatan_pemilik_risiko" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Koordinator Pengelola Risiko*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="nama_koordinator_pengelola_risiko" value="{{Auth::user()->name}}" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Jabatan Koordinator Pengelola Risiko*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="jabatan_koordinator_pengelola_risiko" value="{{Auth::user()->level}}" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Selera Risiko*</label>
                        <div class="col-sm-2">
                            <input type="number" min="1" max="25" class="form-control" name="selera_risiko" id="">
                        </div>
                    </div>
                            <div class="form-group">
                                <b>Konteks</b>
                            </div>
                            @if (session('statuskonteks'))
                            <div class="alert text-white bg-success" role="alert">
                                <div class="iq-alert-text"><b>Info!</b> {{ session('statuskonteks') }}</div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            @endif
                            <div class="form-group">
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary add-list" data-toggle="modal" data-target="#konteks"><i class="las la-plus mr-3"></i>Tambah Konteks</button>
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
                                            <th>Kode Konteks</th>
                                            <th>Nama Konteks</th>
                                            <th>Jenis Konteks </th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ligth-body">
                                            <th class="text-center"></th>
                                            <th></th>
                                            <th></th>
                                            <th class="text-center">
                                                <div class="d-flex align-items-center list-action">
                                                    -
                                                </div>
                                            </th>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <b>Pemangku Kepentingan</b>
                            </div>
                            @if (session('statuspemangku'))
                            <div class="alert text-white bg-success" role="alert">
                                <div class="iq-alert-text"><b>Info!</b> {{ session('statuspemangku') }}</div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            @endif
                            <div class="form-group">
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary add-list" data-toggle="modal" data-target="#pemangku"><i class="las la-plus mr-3"></i>Tambah Pemangku Kepentingan</button>
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
                                            <th>No</th>
                                            <th>Nama Pemangku kepentingan</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $no=1; ?>
                                    <tbody class="ligth-body">
                                        <th class="text-center"></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <div class="d-flex align-items-center list-action">
                                                -
                                            </div>
                                        </th>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                        <button type="reset" onclick="history.go(-1)" class="btn btn-danger  btn-lg">Batal</button>
                    </div>
                </form>
            </div>
        </div>
   </div>
@endsection
@push('script')
    <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/departemen.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

 