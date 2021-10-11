@extends('layouts.base')
@section('title')
Toko Online | Dashboard
@endsection
@section('css')
<style>
.bintang {
    color: red;
}
</style>
<style>
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
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Edit Risiko</h3>
        </div>
        <!-- <hr style="height:1px; box-shadow: 0px 10px 10px -10px #8c8c8c inset"> -->
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
            @foreach($res as $res)
            <form class="form-horizontal" action="{{url('resiko-teridentifikasi/'.$res->id)}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Departemen Pemilik Reesiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single text search-input" id="cari_departmen" name="departmen"
                            style="width:100%;">
                            <option value="{{$res->faktur}}-{{$res->id_departemen}}">{{$res->namadep}} -
                                    ({{$res->priode_penerapan}})</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id" id="id" value="{{$res->id_departmen}}">
                <input type="hidden" name="id_dep" id="id_dep" value="{{$res->id_departmen}}">
                <input type="hidden" name="kodedep" id="kodedep" value="{{$res->kode_departemen}}">
                <input type="hidden" name="namadep" id="namadep" value="{{$res->departmen_pemilik_resiko}}">
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Periode Penerapan<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <!-- <select class="form-control" name="client" id="">
                            <option selected disabled value="">Pilih Tahun</option>
                        </select> -->
                        <input type="text" class="form-control" id="tahun" name="tahun" readonly
                            value="{{$res->periode_penerapan}}">
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Konteks<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single text search-input" id="cari_konteks" name="konteks"
                            style="width:100%;">
                            <option value="{{$res->idkonteks}}">{{$res->kodekonteks}} -
                                    {{$res->namakonteks}}</option>
                        </select>

                    </div>
                </div>
                <input type="hidden" id="id_jenis_konteks" name="id_jenis_konteks" value="{{$res->id_jenis_konteks}}">
                <input type="hidden" id="id_konteks" name="id_konteks" value="{{$res->id_konteks}}">
                <input type="hidden" name="kode_konteks" id="kode_konteks" value="{{$res->kode_konteks}}">
                <input type="hidden" name="namakonteks" id="nama_konteks" value="{{$res->konteks}}">
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Kode Risiko</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$res->full_kode}}" id="kode_risiko" name="kode_risiko" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Pernyataan Risiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <textarea id="w3review" name="pernyataan" rows="4" cols="50" class="form-control">{{$res->pernyataan_risiko}}
                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Kategori Risiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="kategori" id="carikat">
                            <option value="{{$res->idkat}}">{{$res->namakat}}</option>
                            @foreach($data as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->resiko}}</option>
                            @endforeach

                            <!-- $kodekat = DB::table('kategori_resiko')->where('id', '=', $cari)->get(); -->
                        </select>
                        <input type="hidden" id="idkat" name="idkat" value="{{$res->idkat}}">
                        <input type="hidden" id="kodekat" name="kodekat" value="{{$res->kodekat}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Uraian Dampak<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <textarea id="w3review" name="dampak" rows="4" cols="50" class="form-control">{{$res->uraian_dampak}}
                        </textarea>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Selera Risiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email">
                    </div>
                </div> -->
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Metode Pencapaian SPIP<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="metode" >
                            <option selected value="{{$res->idmet}}">{{$res->metod}}</option>
                            @foreach($data2 as $spip)
                            <option value="{{$spip->id}}">{{$spip->metode}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Status Pemenuhan Selera Resiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="status" id="">
                            <option selected value="{{$res->status}}">{{$res->status}}</option>
                            <option value="Belum Memenuhi Selera Risiko">Belum Memenuhi Selera Risiko</option>
                            <option value="Memenuhi Selera Risiko">Memenuhi Selera Risiko</option>
                        </select>
                    </div>
                </div>
                @if($res->id_analisis == '')
                @else
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Skor Awal</legend>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Awal<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" disabled name="" id="cario" onchange="caribesaran()">
                                <option selected disabled value="{{$res->frekuensi_awal}}">{{$res->frekuensi_awal}}</option>
                                
                                <option value=""></option>
                                
                            </select>
                            <input type="hidden" name="frekuensi_saat_ini" id="frekuensi_saat_ini">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Awal <i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" disabled name="dampak_saat_ini" id="dampakk" onchange="caribesaran()" class="dampakk">
                                <option selected disabled value="{{$res->dampak_awal}}">{{$res->dampak_awal}}</option>
                                
                                <option value=""></option>
                                
                            </select>
                            <input type="hidden" name="dampak_saat_ini" id="dampak_saat_ini">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Besaran Risiko Awal <i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" name="besaran_saat_ini" id="besaran" style="background-color : {{$res->pr}}; " class="box1" value="{{$res->besaran_awal}}" readonly>
                            <input type="hidden" name="pr_saat_ini" id="pr_saat_ini">
                        </div>
                    </div>
                    <input type="hidden" name="warna" id="warna">
                    <input type="hidden" name="nilpro" id="nilpro">
                    <input type="hidden" name="nildam" id="nildam">
                    <input type="hidden" name="nampro" id="nampro">
                    <input type="hidden" name="namdam" id="namdam">
                    <input type="hidden" name="idpro" id="idpro">
                    <input type="hidden" name="iddam" id="iddam">
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Skor residu setelah pengendalian</legend>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Aktual<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" disabled name="" id="cario" onchange="caribesaran()">
                                <option selected disabled value="{{$res->frekuensi_akhir}}">{{$res->frekuensi_akhir}}</option>
                                
                                <option value=""></option>
                                
                            </select>
                            <input type="hidden" name="frekuensi_saat_ini" id="frekuensi_saat_ini">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Aktual<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" disabled name="dampak_saat_ini" id="dampakk" onchange="caribesaran()" class="dampakk">
                                <option selected disabled value="{{$res->dampak_akhir}}">{{$res->dampak_akhir}}</option>
                                
                                <option value=""></option>
                                
                            </select>
                            <input type="hidden" name="dampak_saat_ini" id="dampak_saat_ini">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Besaran risiko Aktual<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                        <input type="text" name="besaran_saat_ini" id="besaran" style="background-color : {{$res->pr_akhir}}; " class="box1" value="{{$res->besaran_akhir}}" readonly>
                            <input type="hidden" name="pr_saat_ini" id="pr_saat_ini">
                        </div>
                    </div>
                    <input type="hidden" name="warna" id="warna">
                    <input type="hidden" name="nilpro" id="nilpro">
                    <input type="hidden" name="nildam" id="nildam">
                    <input type="hidden" name="nampro" id="nampro">
                    <input type="hidden" name="namdam" id="namdam">
                    <input type="hidden" name="idpro" id="idpro">
                    <input type="hidden" name="iddam" id="iddam">
                </fieldset>
                @endif
                <div class="form-group" align="center">
                    <b>Pengajuan dan Persetujuan</b>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Status Persetujuan<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="pengajuan" id="">
                            <option selected value="{{$res->status_persetujuan}}">{{$res->status_persetujuan}}</option>
                            <option value="diajukan">Diajukan</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Diajukan Oleh<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="diajukan" value="{{$res->diajukan_oleh}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Diajukan Pada<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <div class="md-form md-outline input-with-post-icon datepicker">
                            <input placeholder="Select date" type="date" id="example" class="form-control"
                                name="tanggal_pengajuan" value="{{$res->diajukan_tanggal}}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Disetujui/Ditolak Oleh<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="disetujui_oleh"
                            value="{{$res->persetujuan_oleh}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Disetujui/Ditolak Pada<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <div class="md-form md-outline input-with-post-icon datepicker">
                            <input placeholder="Select date" type="date" id="example" class="form-control"
                                name="tanggal_persetujuan" value="{{$res->tanggal_persetujua}}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Keterangan
                        Persetujuan/Penolakan<i class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <textarea id="w3review" name="keterangan" rows="4" cols="50" class="form-control">{{$res->keterangan}}
                        </textarea>
                    </div>
                </div>
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
@endsection
@push('script')
<script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
<script src="{{asset('assets/customjs/backend/resiko_teridentifikasi.js')}}"></script>
<!-- <script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script> -->
<script>
    $('#carikat').on('change', function () {
        // $('#tahun').empty().trigger("change");
		var kode = $(this).val();
        console.log(kode);
		$.ajax({
			type: 'GET',
			url: '/hasil-cari-kat/' + kode,
			success: function (data) {
				return {
					results: $.map(data, function (item) {
							$('#kodekat').val(item.kode);
                            $('#idkat').val(item.id);
					})
				}
                
			},
		});
	});
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush