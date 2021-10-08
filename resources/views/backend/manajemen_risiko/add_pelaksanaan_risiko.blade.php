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
<link rel="stylesheet" href="{{asset('assets/customjs/backend/loading.css')}}">
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Tambah Data Pelaksanaan Manajemen Risiko</h3>
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
            <div class="loading-div" id="panel">
                <form class="form-horizontal" action="{{url('/pelaksanaan')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Departemen Pemilik
                                Risiko*</label>
                            <div class="col-sm-9">
                                <!-- Auto Kode Generate -->
                                <input type="" value="{{$finalkode}}" name="faktur" id="faktur"
                                    class="form-group form-control" required readonly>
                                <!-- Select2 -->
                                <select name="departemen" class="form-control" id="cari_departemen" style="width: 100%;"
                                    data-placeholder="Search ...">
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
                            <label class="control-label col-sm-3 align-self-center" for="">Jabatan Pemilik
                                Risiko*</label>
                            <div class="col-sm-9">
                                <input type="" class="form-control" name="jabatan_pemilik_risiko" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Nama Koordinator Pengelola
                                Risiko*</label>
                            <div class="col-sm-9">
                                <input type="" class="form-control" name="nama_koordinator_pengelola_risiko"
                                    value="{{Auth::user()->name}}" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Jabatan Koordinator Pengelola
                                Risiko*</label>
                            <div class="col-sm-9">
                                <input type="" class="form-control" name="jabatan_koordinator_pengelola_risiko"
                                    value="{{Auth::user()->level}}" id="">
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
                            <label class="control-label col-sm-3 align-self-center" for="">Selera Risiko*</label>
                            <div class="col-sm-2">
                                <input type="number" min="1" max="25" class="form-control" name="selera_risiko" id="">
                            </div>
                        </div>
                        <div class="form-group">
                            <b>Konteks</b>
                        </div>
                        <div class="form-group">
                            <div class="text-right">
                                <button type="button" class="btn btn-sm btn-primary add-list" data-toggle="modal"
                                    data-target="#konteks"><i class="las la-plus mr-3"></i>Tambah Konteks</button>
                            </div>
                        </div>
                        <div class="table-responsive rounded mb-3">
                            <table id="" class="table mb-0 tbl-server-info data-tables">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>Kode Konteks</th>
                                        <th>Nama Konteks</th>
                                        <th>Jenis Konteks </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="ligth-body" id="bodykonteks">
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <b>Pemangku Kepentingan</b>
                        </div>
                        <div class="form-group">
                            <div class="text-right">
                                <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal"
                                    data-target="#pemangku"><i class="las la-plus mr-3"></i>Tambah Pemangku
                                    Kepentingan</button>
                            </div>
                        </div>
                        <div class="table-responsive rounded mb-3">
                            <table id="" class="table mb-0 tbl-server-info data-tables">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>No</th>
                                        <th>Nama Pemangku kepentingan</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="ligth-body" id="bodypemangku">
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
            <div class="modal fade" id="konteks" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Konteks</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="formaddkonteks" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Kode Konteks</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" value="{{$finalkode}}" name="faktur_konteks"
                                            id="faktur_konteks" class="form-group form-control" required readonly>
                                        <input type="text" name="kode_konteks" class="form-control" id="kode_konteks"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Nama Konteks</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_konteks" class="form-control" id="nama_konteks"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Jenis Konteks</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="id_jenis_konteks" id="id_jenis_konteks"
                                            required>
                                            @foreach($jeniskonteks as $data)
                                            <option value="{{$data->id}}">{{$data->konteks}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Detail Ancaman</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="detail_ancaman_konteks"
                                            id="detail_ancaman_konteks" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Indikator Kinerja Kegiatan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="indikator_kinerja_kegiatan_konteks"
                                            id="indikator_kinerja_kegiatan_konteks" rows="3" required></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="addkonteksbtn" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="edit_konteks" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="labelkonteks">Edit Konteks</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="formeditkonteks" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Kode Konteks</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="konteks_id" id="konteks_id"
                                            class="form-group form-control" required readonly>
                                        <input type="text" name="edit_kode_konteks" class="form-control"
                                            id="edit_kode_konteks" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Nama Konteks</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="edit_nama_konteks" class="form-control"
                                            id="edit_nama_konteks" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Jenis Konteks</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="edit_id_jenis_konteks"
                                            id="edit_id_jenis_konteks" required>
                                            @foreach($jeniskonteks as $data)
                                            <option value="{{$data->id}}">{{$data->konteks}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Detail Ancaman</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="edit_detail_ancaman_konteks"
                                            id="edit_detail_ancaman_konteks" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Indikator Kinerja Kegiatan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="edit_indikator_kinerja_kegiatan_konteks"
                                            id="edit_indikator_kinerja_kegiatan_konteks" rows="3" required></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="editkonteksbtn" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="pemangku" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Pemangku Kepentingan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="addpemangku" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Pemangku
                                        Kepentingan</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" value="{{$finalkode}}" name="faktur_pemangku"
                                            id="faktur_pemangku" class="form-group form-control" required readonly>
                                        <input type="text" name="pemangku_kepentingan" class="form-control" value=""
                                            id="pemangku_kepentingan" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="keterangan" id="keterangan" rows="4"
                                            required></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="addpemangkubtn" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="edit_pemangku" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="labelpemangku">Edit Pemangku Kepentingan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="editpemangku" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="pemangku_id" id="pemangku_id">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Pemangku
                                        Kepentingan</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" value="{{$finalkode}}" name="edit_faktur_pemangku"
                                            id="edit_faktur_pemangku" class="form-group form-control" required readonly>
                                        <input type="text" name="edit_pemangku_kepentingan" class="form-control" value=""
                                            id="edit_pemangku_kepentingan" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="edit_keterangan" id="edit_keterangan" rows="4"
                                            required></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="editpemangkubtn" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{asset('assets/plugins/select2/js/select2.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/customjs/backend/loading.js')}}"></script>
<!-- <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/departemen.js')}}"></script> -->
<script src="{{asset('assets/customjs/backend/add_pelaksanaan_risiko.js')}}"></script>

@endpush