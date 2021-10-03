@extends('layouts.base')
@section('title')
    Edit Detail Pelaksanaan Manajemen Risiko | Dashboard
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
                <h3 class="mb-3">Edit Detail Pelaksanaan Manajemen Risiko</h3>
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
                        <label class="control-label col-sm-3 align-self-center" for="">Departemen Pemilik Risiko*</label>
                        <div class="col-sm-9">
                            <!-- Auto Kode Generate -->
                            <input type="hidden" value="{{$row->faktur}}" name="faktur" id="faktur" class="form-group form-control" required readonly>
                            <!-- Select2 -->
                            <select name="departemen" value="{{$row->nama}}" class="form" id="cari_departemen" style="width: 100%;" data-placeholder="Search ...">
                            </select>
                            <input type="hidden" value="{{$row->id_departemen}}" name="id_departemen" id="id_departemen">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Pemilik Risiko*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{$row->nama_pemilik_risiko}}" name="nama_pemilik_risiko" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Jabatan Pemilik Risiko*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" value="{{$row->jabatan_pemilik_risiko}}" name="jabatan_pemilik_risiko" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Koordinator Pengelola Risiko*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="nama_koordinator_pengelola_risiko" value="{{$row->nama_koordinator_pengelola_risiko}}" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Jabatan Koordinator Pengelola Risiko*</label>
                        <div class="col-sm-9">
                            <input type="" class="form-control" name="jabatan_koordinator_pengelola_risiko" value="{{$row->jabatan_koordinator_pengelola_risiko}}" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Periode Penerapan*</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="priode_penerapan" id="">
                                <!-- <option selected disabled value="">Pilih Tahun</option> -->
                                <option value="{{$row->priode_penerapan}}">{{$row->priode_penerapan}}</option>
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
                            <input type="number" min="1" max="25" class="form-control" value="{{$row->selera_risiko}}" name="selera_risiko" id="">
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
                                    @foreach($konteks as $data)
                                    <tbody class="ligth-body">
                                            <th class="text-center">{{$data->kode}}</th>
                                            <th>{{$data->nama}}</th>
                                            <th>{{$data->konteks}}</th>
                                            <th class="text-center">
                                                <div class="d-flex align-items-center list-action">
                                                    <a class="badge badge-info mr-2" data-toggle="modal" data-target="#showkonteks{{$data->id}}" title="View" data-original-title="View"><i class="ri-eye-line mr-0"></i></a>
                                                    <a class="badge bg-success mr-2" data-toggle="modal" data-target="#konteks{{$data->id}}" title="Edit" data-original-title="View"><i class="ri-pencil-line mr-0"></i></a>
                                                    <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapusdatakonteks({{$data->id}})"><i class="ri-delete-bin-line mr-0"></i></a>
                                                </div>
                                            </th>
                                    </tbody>
                                    @endforeach
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
                                    @foreach($pemangku_kepentingan as $data)
                                    <tbody class="ligth-body">
                                        <th class="text-center">{{$no++}}</th>
                                        <th>{{$data->pemangku_kepentingan}}</th>
                                        <th>{{$data->keterangan}}</th>
                                        <th>
                                            <div class="d-flex align-items-center list-action">
                                                <a class="badge badge-info mr-2" data-toggle="modal" data-target="#showpemangku{{$data->id}}" title="View" data-original-title="View"><i class="ri-eye-line mr-0"></i></a>
                                                <a class="badge bg-success mr-2" data-toggle="modal" data-target="#pemangku{{$data->id}}" title="View" data-original-title="View"><i class="ri-pencil-line mr-0"></i></a>
                                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="hapusdatapemangkupelaksanaan({{$data->id}})"><i class="ri-delete-bin-line mr-0"></i></a>
                                            </div>
                                        </th>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                        <button type="reset" onclick="history.go(-1)" class="btn btn-danger  btn-lg">Batal</button>
                    </div>
                </form>
            @endforeach
            <!-- Modal Konteks -->
                <!-- Tambah Konteks -->
                @foreach($manajemenrisiko as $item)
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
                                <form class="form-horizontal" action="{{url('simpan-edit-konteks-pelaksanaan/'.$item->faktur)}}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="">Kode Konteks</label>
                                        <div class="col-sm-9">
                                        <!-- Auto Generate Kode -->
                                            <input type="hidden" value="{{$item->faktur}}" name="faktur_konteks" id="faktur_konteks" class="form-group form-control" required readonly>
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
                @endforeach
                <!-- End Tambah Konteks -->
                <!-- Edit Konteks -->
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
                                <form class="form-horizontal" action="{{url('simpan-edit-edit-konteks-pelaksanaan/'.$data->id)}}" method="post">
                                    @csrf
                                    @foreach($manajemenrisiko as $item) <input type="hidden" name="faktur" value="{{$item->faktur}}"> @endforeach
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
                @endforeach
                <!-- End Edit Konteks -->
                <!-- Show Konteks -->
                @foreach($konteks as $data)
                <div class="modal fade" id="showkonteks{{$data->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Lihat Konteks</h5>
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
                                            <input type="text" name="kode" class="form-control" value="{{$data->kode}}" id="" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="">Nama Konteks</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nama" class="form-control" value="{{$data->nama}}" id="" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="">Jenis Konteks</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="id_konteks" id="" readonly required>
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
                                            <textarea class="form-control" name="detail_ancaman" id="exampleFormControlTextarea1" rows="3" readonly required>{{$data->detail_ancaman}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3" for="">Indikator Kinerja Kegiatan</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="indikator_kinerja_kegiatan" id="exampleFormControlTextarea1" rows="3" readonly required>{{$data->indikator_kinerja_kegiatan}}</textarea>
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
                <!-- End Show Konteks -->
            <!-- End Modal Konteks -->
            <!-- Modal Pemangku -->
                <!-- Tambah Pemangku -->
                @foreach($manajemenrisiko as $item)
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
                                <form class="form-horizontal" action="{{url('simpan-edit-pemangku-pelaksanaan/'.$item->faktur)}}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="">Pemangku Kepentingan</label>
                                        <div class="col-sm-9">
                                        <!-- Auto Generate Kode -->
                                            <input type="hidden" value="{{$item->faktur}}" name="faktur_pemangku" id="faktur_pemangku" class="form-group form-control" required readonly>
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
                @endforeach
                <!-- End Tambah Pemangku -->
                <!-- Edit Pemangku -->
                    @foreach($pemangku_kepentingan as $data)
                    <div class="modal fade" id="pemangku{{$data->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Pemangku Kepentingan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" action="{{url('simpan-edit-edit-pemangku-pelaksanaan/'.$data->id)}}" method="post">
                                        @foreach($manajemenrisiko as $item)<input type="hidden" name="faktur" readonly value="{{$item->faktur}}">@endforeach
                                        @csrf
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center" for="">Pemangku Kepentingan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pemangku_kepentingan" class="form-control" value="{{$data->pemangku_kepentingan}}" id="" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3" for="">Keterangan</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="4" required>{{$data->keterangan}}</textarea>
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
                    @endforeach
                <!-- End Edit Pemangku -->
                <!-- Show Pemangku -->
                    @foreach($pemangku_kepentingan as $data)
                    <div class="modal fade" id="showpemangku{{$data->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Pemangku Kepentingan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" action="" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center" for="">Pemangku Kepentingan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pemangku_kepentingan" class="form-control" value="{{$data->pemangku_kepentingan}}" id="" readonly required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3" for="">Keterangan</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="4" readonly required>{{$data->keterangan}}</textarea>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <!-- End Show Pemangku -->
            <!-- End Modal Pemangku -->
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

 