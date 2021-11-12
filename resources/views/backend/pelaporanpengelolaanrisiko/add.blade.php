@extends('layouts.base')
@section('title')
    Tambah Pelaporan Pengendalian Risiko | ARMS
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Tambah Pelaporan Pengendalian Risiko</h3>
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
                <form class="form-horizontal" action="{{url('pelaporan-pengelolaan-risiko')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Periode Pelaporan</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="periode_pelaporan" id="">
                                <option selected value="">-- Pilih Periode --</option>
                                @foreach ($periode_pelaporan as $periode)
                                    <option value="{{ $periode->id }}">{{ $periode->nama_periode }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Unit Kerja</label>
                        <div class="col-sm-9">
                            <!-- Select2 -->
                            <select name="departemen" class="form-control select2" id="cari_departemen" style="width: 100%;"
                                data-placeholder="Search ...">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status" id="">
                                <option selected value="">-- Pilih Status --</option>
                                <option value="diajukan">Diajukan</option>
                                <option value="proses pemeriksaan">Proses Pemeriksaan</option>
                                <option value="laporan diterima">Laporan Diterima</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">File</label>
                        <div class="col-sm-9">
                            <input type="file" name="file_laporan" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Kepada</label>
                        <div class="col-sm-9">
                            <!-- Select2 -->
                            <select name="tujuanpelaporan[]" multiple="multiple" class="form-control select2" id="cari_tujuanpelaporan" style="width: 100%;"
                                data-placeholder="Search ...">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Tembusan</label>
                        <div class="col-sm-9">
                            <!-- Select2 -->
                            <select name="tembusan[]" multiple="multiple" class="form-control select2" id="cari_tembusan" style="width: 100%;"
                                data-placeholder="Search ...">
                            </select>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="form-group">
                            <button class="btn btn-primary">Simpan</button>
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
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
<script src="{{asset('assets/customjs/backend/add_pelaporan.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush

