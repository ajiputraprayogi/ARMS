@extends('layouts.base')
@section('title')
Edit Detail Pelaksanaan Manajemen Risiko | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/customjs/backend/loading.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Edit Data Pelaksanaan Manajemen Risiko</h3>
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
            @foreach($data as $row)
            <form class="form-horizontal" action="{{url('/simpan-edit-pelaksanaan/'.$row->id)}}" method="post">
                @csrf
                <div class="form-group">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Departemen Pemilik
                            Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <!-- Auto Kode Generate -->
                            <input type="hidden" value="{{$row->faktur}}" name="faktur" id="faktur"
                                class="form-group form-control" required readonly>
                            <!-- Select2 -->
                            @php
                                $datadep = DB::table('departemen')
                                ->whereIn('id',$id_atasan)
                                ->get();
                            @endphp
                            <select name="departemen" value="{{$row->nama}}" class="form" id="cari_departemen"
                                style="width: 100%;">
                                @foreach ($datadep as $rowdep)
                                    <option value="{{$rowdep->id}}"@if($rowdep->id==$row->id_departemen) selected @endif>{{$rowdep->nama}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" value="{{$row->id_departemen}}" name="id_departemen"
                                id="id_departemen">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Pemilik Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{$row->nama_pemilik_risiko}}"
                                name="nama_pemilik_risiko" id="">
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Jabatan Pemilik Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" value="{{$row->jabatan_pemilik_risiko}}"
                                name="jabatan_pemilik_risiko" id="">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Koordinator Pengelola
                            Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="nama_koordinator_pengelola_risiko"
                                value="{{$row->nama_koordinator_pengelola_risiko}}" id="">
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Koordinator Pengelola
                            Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            {{-- <input type="" class="form-control" name="nama_koordinator_pengelola_risiko"
                                 id=""> --}}
                            @php
                                $datakor = DB::table('departemen')
                                ->where('id_atasan',$row->id_departemen)
                                ->get();
                            @endphp
                            <select name="nama_koordinator_pengelola_risiko" value="{{$row->nama}}" class="form-control" id="nama_koordinator_pengelola_risiko" style="width: 100%;">
                                @foreach ($datakor as $rowkor)
                                    <option value="{{$rowkor->id}}"@if($rowkor->id==$row->id_koordinator) selected @endif>{{$rowkor->nama}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id_koordinator" value="{{$row->id_koordinator}}" id="id_koordinator">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Jabatan Koordinator Pengelola
                            Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="jabatan_koordinator_pengelola_risiko"
                                value="{{$row->jabatan_koordinator_pengelola_risiko}}" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Tahun Penerapan<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="priode_penerapan" id="">
                                <!-- <option selected disabled value="">Pilih Tahun</option> -->
                                <!-- <option value="{{$row->priode_penerapan}}">{{$row->priode_penerapan}}</option> -->
                                @php
                                $tahun=date('Y')-5;
                                $maxtahun=date('Y')+5;
                                @endphp
                                @for($i=$tahun; $i<=$maxtahun; $i++) <option value="{{$i}}" @if($row->
                                    priode_penerapan==$i) selected @endif>{{$i}}</option>
                                    @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="">Priode Penerapan<i class="bintang">*</i></label>
                            <div class="col-sm-9">
                                @if($row->priode_penerapan_awal=='0000-00-00')
                                    <input placeholder="Pilih Priode Penerapan" class="form-control" id="tanggal" name="priode_penerapan_awal_akhir"/>
                                @else
                                    <input placeholder="Pilih Priode Penerapan" class="form-control" id="tanggal" name="priode_penerapan_awal_akhir" value="{{date('d-m-Y', strtotime($row->priode_penerapan_awal))}} to {{date('d-m-Y', strtotime($row->priode_penerapan_akhir))}}"/>
                                @endif
                            </div>
                        </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Selera Risiko<i class="bintang">*</i></label>
                        <div class="col-sm-2">
                            <input type="number" min="1" max="25" class="form-control" value="{{$row->selera_risiko}}"
                                name="selera_risiko" id="">
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
                            <button type="button" class="btn btn-sm btn-primary add-list" data-toggle="modal"
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
                                    <th>Kelompok Pemangku Kepentingan</th>
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
                                    <label class="control-label col-sm-3 align-self-center" for="">Kode Konteks<i class="bintang">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="hidden" value="{{$row->faktur}}" name="faktur_konteks"
                                            id="faktur_konteks" class="form-group form-control" required readonly>
                                        <input type="text" name="kode_konteks" class="form-control" id="kode_konteks"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Nama Konteks<i class="bintang">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_konteks" class="form-control" id="nama_konteks"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Jenis Konteks<i class="bintang">*</i></label>
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
                                            id="detail_ancaman_konteks" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Indikator Kinerja Kegiatan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="indikator_kinerja_kegiatan_konteks"
                                            id="indikator_kinerja_kegiatan_konteks" rows="3"></textarea>
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
                                    <label class="control-label col-sm-3 align-self-center" for="">Kode Konteks<i class="bintang">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="konteks_id" id="konteks_id"
                                            class="form-group form-control" required readonly>
                                        <input type="text" name="edit_kode_konteks" class="form-control"
                                            id="edit_kode_konteks" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Nama Konteks<i class="bintang">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="edit_nama_konteks" class="form-control"
                                            id="edit_nama_konteks" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Jenis Konteks<i class="bintang">*</i></label>
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
                                            id="edit_detail_ancaman_konteks" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Indikator Kinerja Kegiatan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="edit_indikator_kinerja_kegiatan_konteks"
                                            id="edit_indikator_kinerja_kegiatan_konteks" rows="3"></textarea>
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
                                        <input type="hidden" value="{{$row->faktur}}" name="faktur_pemangku"
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
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Kelompok Pemangku Kepentingan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="kelompok_pemangku_kepentingan" id="kelompok_pemangku_kepentingan" required>
                                            <option value="" selected disabled hidden>- Pilih Kelompok -</option>
                                            <option value="internal">Internal</option>
                                            <option value="eksternal">Eksternal</option>
                                        </select>
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
                                        <input type="hidden" value="{{$row->faktur}}" name="edit_faktur_pemangku"
                                            id="edit_faktur_pemangku" class="form-group form-control" required readonly>
                                        <input type="text" name="edit_pemangku_kepentingan" class="form-control"
                                            value="" id="edit_pemangku_kepentingan" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="edit_keterangan" id="edit_keterangan"
                                            rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="">Kelompok Pemangku Kepentingan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="edit_kelompok_pemangku_kepentingan" id="edit_kelompok_pemangku_kepentingan" required>
                                            <option value="internal">Internal</option>
                                            <option value="eksternal">Eksternal</option>
                                        </select>
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
            @endforeach
        </div>
    </div>
</div>
@endsection
@push('script')
<!-- <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
<script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script>
<script src="{{asset('assets/customjs/backend/departemen.js')}}"></script> -->
<script src="{{asset('assets/plugins/select2/js/select2.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/customjs/backend/loading.js')}}"></script>
<script src="{{asset('assets/customjs/backend/add_pelaksanaan_risiko.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(function() {
    flatpickr("#tanggal", {
        enableTime: false,
        dateFormat: "d-m-Y",
        mode: "range"
    });
    });
</script>
@endpush
