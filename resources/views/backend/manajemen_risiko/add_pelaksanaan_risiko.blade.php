@extends('layouts.base')
@section('title')
    Detail Pelaksanaan Manajemen Risiko | Dashboard
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
                <h3 class="mb-3">Detail Pelaksanaan Manajemen Risiko</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Departemen Pemilik Risiko*</label>
                        <div class="col-sm-9">
                            <select name="departemen" class="form" id="cari_departemen" style="width: 100%;" data-placeholder="Search ...">
                            </select>
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
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
                    <table id="list-data-konteks" class="table mb-0 tbl-server-info">
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
                            <div class="modal fade" id="konteks" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Konteks</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="{{url('konteks')}}" method="post">
                                                @csrf
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Kode Konteks</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="kode" class="form-control" value="" id="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Nama Konteks</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="nama" class="form-control" value="" id="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Jenis Konteks</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="id_konteks" id="" required>
                                                            <option selected disabled value="">Pilih Jenis Konteks</option>
                                                            @foreach($jeniskonteks as $data)
                                                                <option value="{{$data->id}}">{{$data->konteks}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3" for="">Detail Ancaman</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="detail_ancaman" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3" for="">Indikator Kinerja Kegiatan</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="indikator_kinerja_kegiatan" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            @foreach($konteks as $data)
                            <div class="modal fade" id="konteks{{$data->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Konteks</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="{{url('konteks/'.$data->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Kode Konteks</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="kode" class="form-control" value="{{$data->kode}}" id="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Nama Konteks</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="nama" class="form-control" value="{{$data->nama}}" id="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Jenis Konteks</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="id_konteks" id="" required>
                                                            <option value="{{$data->idjk}}">{{$data->konteks}}</option>
                                                            @foreach($jeniskonteks as $datajk)
                                                                <option value="{{$datajk->id}}">{{$datajk->konteks}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3" for="">Detail Ancaman</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="detail_ancaman" id="exampleFormControlTextarea1" rows="3" required>{{$data->detail_ancaman}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3" for="">Indikator Kinerja Kegiatan</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="indikator_kinerja_kegiatan" id="exampleFormControlTextarea1" rows="3" required>{{$data->indikator_kinerja_kegiatan}}</textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="showkonteks{{$data->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Konteks</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Kode Konteks</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="kode" class="form-control" value="{{$data->kode}}" id="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Nama Konteks</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="nama" class="form-control" value="{{$data->nama}}" id="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Jenis Konteks</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="id_konteks" id="" required>
                                                            <option value="{{$data->idjk}}">{{$data->konteks}}</option>
                                                            @foreach($jeniskonteks as $datajk)
                                                                <option value="{{$datajk->id}}">{{$datajk->konteks}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3" for="">Detail Ancaman</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="detail_ancaman" id="exampleFormControlTextarea1" rows="3" required>{{$data->detail_ancaman}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3" for="">Indikator Kinerja Kegiatan</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="indikator_kinerja_kegiatan" id="exampleFormControlTextarea1" rows="3" required>{{$data->indikator_kinerja_kegiatan}}</textarea>
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
                <div class="form-group">
                    <b>Pemangku Kepentingan</b>
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
                    <table id="list-data-pemangku" class="table mb-0 tbl-server-info">
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
                            <div class="modal fade" id="pemangku" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Pemangku Kepentingan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="{{url('pemangkukepentingan')}}" method="post">
                                                @csrf
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center" for="">Pemangku Kepentingan</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pemangku_kepentingan" class="form-control" value="" id="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3" for="">Keterangan</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="4" required></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table>
                </div>
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

 