@extends('layouts.base')
@section('title')
Toko Online | Analisa Risiko
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<style>
.bintang {
    color: red;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/customjs/backend/loading.css')}}">
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Edit Analisis Akar Masalah</h3>
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
                @foreach($datadetail as $rowdtl)
                @php
                $dataresiko = DB::table('resiko_teridentifikasi')
                ->where('full_kode',$rowdtl->kode_risiko)
                ->get();
                @endphp
                <form class="form-horizontal" action="{{url('analisa-akar-masalah/'.$rowdtl->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Departemen Pemilik Resiko<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single text search-input" id="cari_departmen"
                                name="cari_departmen" style="width:100%;">
                                @foreach($dataresiko as $dtr)
                                @php
                                $data_manajemen_risiko = DB::table('pelaksanaan_manajemen_risiko')
                                ->select(DB::raw('pelaksanaan_manajemen_risiko.*,departemen.nama'))
                                ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
                                ->where([['id_departemen',$dtr->id_departmen],['priode_penerapan',$dtr->periode_penerapan]])
                                ->get();
                                @endphp
                                @foreach($data_manajemen_risiko as $dmr)
                                <option value="{{$dmr->id}}-{{$dmr->id_departemen}}">{{$dmr->nama}} -
                                    ({{$dmr->priode_penerapan}})</option>
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_dep" id="id_dep">
                    <input type="hidden" name="kodedep" id="kodedep">
                    <input type="hidden" name="namadep" id="namadep">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Tahun<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="tahun" name="tahun" @foreach($dataresiko as
                                $dtr) value="{{$dtr->periode_penerapan }}" @endforeach readonly>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Risiko<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single text search-input" id="cari_risiko"
                                name="cari_risiko" style="width:100%;">
                                @foreach($data_manajemen_risiko as $dmr)
                                @php
                                $dataresiko = DB::table('resiko_teridentifikasi')
                                ->where([['id_departmen',$dmr->id_departemen],['periode_penerapan',$dmr->priode_penerapan]])
                                ->get();
                                @endphp

                                @foreach($dataresiko as $dtr)
                                <option value="{{$dtr->full_kode}}" @if($dtr->full_kode==$rowdtl->kode_risiko) selected
                                    @endif>{{$dtr->full_kode}}</option>
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="full_kode" name="full_kode">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Pernyataan Risiko</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="pernyataan" name="pernyataan" col="3"
                                readonly>@foreach($dataresiko as $dtr) {{$dtr->pernyataan_risiko}} @endforeach</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Kode Analisis</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kode_analisis" name="kode_analisis"
                                value="{{$rowdtl->kode_analisis}}" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <b>Why?</b>
                    </div>
                    <div class="form-group">
                        <div class="text-right">
                            <button type="button" class="btn btn-sm btn-primary add-list" data-toggle="modal"
                                data-target="#modaltambahwhy"><i class="las la-plus mr-3"></i>Tambah Why</button>
                        </div>
                    </div>
                    <div class="table-responsive rounded mb-3">
                        <table id="" class="table mb-0 tbl-server-info data-tables">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>Urutan</th>
                                    <th>Uraian Why</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body" id="bodywhy">
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Akar Penyebab<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <textarea id="w3review" name="penyebab" rows="4" cols="50"
                                class="form-control">{{$rowdtl->akar_masalah}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Kode Penyebab<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="kategori" onchange="generatekode()" id="carikat">
                                @foreach($data as $item)
                                <option value="{{$item->kode}}" @if($rowdtl->kategori_penyebab==$item->kode) selected
                                    @endif>{{$item->kode}} - {{$item->penyebab}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Tindak Pengendalian<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <textarea id="w3review" name="pengendalian" rows="4" cols="50"
                                class="form-control">{{$rowdtl->tindakan_pengendalian}}</textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltambahwhy" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Why</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formaddwhy" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Akar Penyebab</label>
                        <textarea name="akar_penyebab" id="akar_penyebab" class="form-control" rows="6"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="addakarpenyebab" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modaleditwhy" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelmodal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formeditwhy" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Akar Penyebab</label>
                        <input type="hidden" name="kode_why" id="kode_why" required readonly>
                        <textarea name="edit_akar_penyebab" id="edit_akar_penyebab" class="form-control"
                            rows="6"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="editakarpenyebab" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<!-- <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/customjs/backend/loading.js')}}"></script>
<script src="{{asset('assets/customjs/backend/analisa_akar.js')}}"></script>
@endpush