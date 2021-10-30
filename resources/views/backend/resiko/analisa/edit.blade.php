@extends('layouts.base')
@section('title')
Analisis Risiko | ARMS
@endsection
@section('css')
<style>
.bintang {
    color: red;
}

fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow: 0px 0px 0px 0px #000;
    box-shadow: 0px 0px 0px 0px #000;
}

legend.scheduler-border {
    width: inherit;
    /* Or auto */
    padding: 0 10px;
    /* To give a bit of padding on the left and right */
    border-bottom: none;
    font-size: 15px;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/customjs/backend/loading.css')}}">
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Edit Analisis Risiko</h3>
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
            
            @foreach($data as $rowdtl)
            @php
            $data_manajemen_risiko = DB::table('pelaksanaan_manajemen_risiko')
            ->select(DB::raw('pelaksanaan_manajemen_risiko.*,departemen.nama'))
            ->leftjoin('departemen','departemen.id','=','pelaksanaan_manajemen_risiko.id_departemen')
            ->where('pelaksanaan_manajemen_risiko.id',$rowdtl->id_pelaksanaan_manajemen_risiko)
            ->get();

            $dataresikoselected = DB::table('resiko_teridentifikasi')
            ->where('full_kode',$rowdtl->kode_risiko)
            ->get();
            @endphp
            <form class="form-horizontal" action="{{url('analisa-risiko/'.$rowdtl->id)}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Departemen Pemilik Risiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single text search-input" id="cari_departmen" name="departmen"
                            style="width:100%;">
                            @foreach($data_manajemen_risiko as $dmr)
                            <option value="{{$dmr->id}}-{{$dmr->id_departemen}}">{{$dmr->nama}} -
                                ({{$dmr->priode_penerapan}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <input type="hidden" name="id" id="id" @foreach($data_manajemen_risiko as $dmr) value="{{$dmr->id}}" @endforeach>
                <input type="hidden" name="id_dep" id="id_dep" @foreach($data_manajemen_risiko as $dmr) value="{{$dmr->id_departemen}}" @endforeach>
                <input type="hidden" name="selera_risiko" id="selera_risiko" @foreach($data_manajemen_risiko as $dmr) value="{{$dmr->selera_risiko}}" @endforeach>
                <input type="hidden" name="kodedep" id="kodedep">
                <input type="hidden" name="namadep" id="namadep">
                
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Tahun<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tahun" name="tahun" @foreach($data_manajemen_risiko
                            as $dmr) value="{{$dmr->priode_penerapan}}" @endforeach readonly>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Kode Risiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single text search-input" id="cari_kode" name="kode"
                            style="width:100%;">
                            @foreach($data_manajemen_risiko as $dmr)
                           
                            @foreach($dataresikoselected as $dtr)
                            <option value="{{$dtr->id}}" @if($dtr->full_kode==$rowdtl->kode_risiko) selected
                                @endif>{{$dtr->full_kode}}</option>
                            @endforeach
                            @endforeach
                        </select>

                    </div>
                </div>
                
                <input type="hidden" name="full_kode" id="full_kode" @foreach($dataresikoselected as $dtr) value="{{$dtr->full_kode}}" @endforeach>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Pernyataan Risiko</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="pernyataan" name="pernyataan" readonly
                            row="3">@foreach($dataresikoselected as $dtr) {{$dtr->pernyataan_risiko}} @endforeach</textarea>
                    </div>
                </div>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Skor yang melekat</legend>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Saat Ini<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frekkini" id="cario" onchange="caribesaran()">
                                @foreach($frekuensi as $row)
                                <option value="{{$row->id}}" @if($row->id==$rowdtl->id_prob) selected
                                    @endif>{{$row->nilai}} - {{$row->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Saat Ini<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="dampakini" id="dampakk" onchange="caribesaran()"
                                class="dampakk">
                                @foreach($dampak as $row2)
                                <option value="{{$row2->id}}" @if($row2->id==$rowdtl->id_dampak) selected
                                    @endif>{{$row2->nilai}} - {{$row2->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Besaran Saat Ini<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" name="besaran" value="{{$rowdtl->besaran_melekat}}"
                                style="background-color:{{$rowdtl->pr}};" id="besaran" class="box1" readonly>
                        </div>
                    </div>
                    @php
                    $proval = explode(' - ',$rowdtl->frekuensi_melekat);
                    $dampakval = explode(' - ',$rowdtl->dampak_melekat);
                    @endphp
                    <input type="hidden" name="warna" id="warna" value="{{$rowdtl->pr}}">
                    <input type="hidden" name="nilpro" id="nilpro" value="{{$proval[0]}}">
                    <input type="hidden" name="nildam" id="nildam" value="{{$dampakval[0]}}">
                    <input type="hidden" name="nampro" id="nampro" value="{{$proval[1]}}">
                    <input type="hidden" name="namdam" id="namdam" value="{{$dampakval[1]}}">
                    <input type="hidden" name="idpro" id="idpro" value="{{$rowdtl->id_prob}}">
                    <input type="hidden" name="iddam" id="iddam" value="{{$rowdtl->id_dampak}}">
                </fieldset>
                <div class="form-group">
                    <b>Sudah Ada Pengendalian??</b><span> <input value="Sudah" name="sudah_ada_pengendalian"
                            id="sudah_ada_pengendalian" type="checkbox" @if($rowdtl->sudah_ada_pengendalian=='Sudah')
                        checked @endif></label></span>
                </div>
                <fieldset class="scheduler-border" id="input_pengendalian_div" @if($rowdtl->
                    sudah_ada_pengendalian!='Sudah') style="display:none;" @endif>
                    <legend class="scheduler-border">Pengendalian Yang Ada</legend>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="email">Uraian Pengendalian</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="uraian_pengendalian" id="uraian_pengendalian" rows="4"
                                required>{{$rowdtl->uraian_pengendalian}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="email">Apakah Memadai</label>
                        <div class="col-sm-9">
                            <select name="apakah_memadai" class="form-control" id="apakah_memadai">
                                <option value="Memadai" @if($rowdtl->apakah_memadai=='Memadai') selected @endif>Memadai
                                </option>
                                <option value="Belum Memadai" @if($rowdtl->apakah_memadai=='Belum Memadai') selected
                                    @endif>Belum Memadai</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Skor Residu Setelah Pengendalian</legend>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Residu<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frekkini" id="carir"
                                @if($rowdtl->sudah_ada_pengendalian!='Sudah') readonly @endif
                                onchange="cariresiduotomatis()">
                                @foreach($frekuensi as $row)
                                <option value="{{$row->id}}" @if($row->id==$rowdtl->id_prob_residu) selected
                                    @endif>{{$row->nilai}} - {{$row->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Residu<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="dampakini" id="dampakkr" onchange="cariresiduotomatis()"
                                @if($rowdtl->sudah_ada_pengendalian!='Sudah') readonly @endif>
                                @foreach($dampak as $row2)
                                <option value="{{$row2->id}}" @if($row2->id==$rowdtl->id_dampak_residu) selected
                                    @endif>{{$row2->nilai}} - {{$row2->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Besaran Residu<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" name="besarankini" id="besarankini" value="{{$rowdtl->besaran_residu}}"
                                style="background-color:{{$rowdtl->pr_residu}};" class="box1" readonly>
                        </div>
                        @php
                        $proval_residu = explode(' - ',$rowdtl->frekuensi_residu);
                        $dampakval_residu = explode(' - ',$rowdtl->dampak_residu);
                        @endphp
                        <input type="hidden" name="warnar" id="warnar" value="{{$rowdtl->pr_residu}}">
                        <input type="hidden" name="nilpror" id="nilpror" value="{{$proval_residu[0]}}">
                        <input type="hidden" name="nildamr" id="nildamr" value="{{$dampakval_residu[0]}}">
                        <input type="hidden" name="nampror" id="nampror" value="{{$proval_residu[1]}}">
                        <input type="hidden" name="namdamr" id="namdamr" value="{{$dampakval_residu[1]}}">
                        <input type="hidden" name="idpror" id="idpror" value="{{$rowdtl->id_prob_residu}}">
                        <input type="hidden" name="iddamr" id="iddamr" value="{{$rowdtl->id_dampak_residu}}">
                    </div>
                </fieldset>
                <div class="text-right">
                    <div class="form-group">
                        <button class="btn btn-primary">Simpan</button>
                        <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Batal</button>
                    </div>
                </div>
            </form>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/customjs/backend/analisa_risiko.js')}}"></script>
<script src="{{asset('assets/customjs/backend/loading.js')}}"></script>

@endpush