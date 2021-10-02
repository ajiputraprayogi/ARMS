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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Tambah Risiko Baru</h3>
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
            <form class="form-horizontal" action="{{url('resiko-teridentifikasi')}}" method="post">
                @csrf
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Departemen Pemilik Reesiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single text search-input" id="cari_departmen" name="departmen"
                            style="width:100%;">
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="id_dep" id="id_dep">
                <input type="hidden" name="kodedep" id="kodedep">
                <input type="hidden" name="namadep" id="namadep">
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Periode Penerapan<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <!-- <select class="form-control" name="client" id="">
                            <option selected disabled value="">Pilih Tahun</option>
                        </select> -->
                        <input type="text" class="form-control" id="tahun" name="tahun" readonly>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Konteks<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single text search-input" id="cari_konteks" name="konteks"
                            style="width:100%;">
                        </select>

                    </div>
                </div>
                <input type="hidden" id="id_jenis_konteks" name="id_jenis_konteks">
                <input type="hidden" id="id_konteks" name="id_konteks">
                <input type="hidden" name="kode_konteks" id="kode_konteks">
                <input type="hidden" name="namakonteks" id="nama_konteks">
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Kode Risiko</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="" name="kode_risiko" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Pernyataan Risiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <textarea id="w3review" name="pernyataan" rows="4" cols="50" class="form-control">
                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Kategori Risiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="kategori" id="">
                            <option selected value="">Kategori Risiko</option>
                            @foreach($data as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->resiko}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Uraian Dampak<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <textarea id="w3review" name="dampak" rows="4" cols="50" class="form-control">
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
                        <select class="form-control" name="metode" id="">
                            <option selected value="">Metode Pencapaian</option>
                            @foreach($data2 as $spip)
                            <option value="{{$spip->metode}}">{{$spip->metode}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group" align="center">
                    <b>Pengajuan dan Persetujuan</b>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Status Persetujuan<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="pengajuan" id="">
                            <option selected disabled value="">Status Persetujuan</option>
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
                        <input type="text" class="form-control" name="diajukan">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Diajukan Pada<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <div class="md-form md-outline input-with-post-icon datepicker">
                            <input placeholder="Select date" type="date" id="example" class="form-control"
                                value="{{$hariini}}" name="tanggal_pengajuan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Disetujui/Ditolak Oleh<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="disetujui_oleh">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Disetujui/Ditolak Pada<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <div class="md-form md-outline input-with-post-icon datepicker">
                            <input placeholder="Select date" type="date" id="example" class="form-control"
                                name="tanggal_persetujuan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Keterangan
                        Persetujuan/Penolakan<i class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <textarea id="w3review" name="keterangan" rows="4" cols="50" class="form-control">
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
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
<!-- <script src="{{asset('assets/customjs/backend/resiko_teridentifikasi.js')}}"></script> -->
<!-- <script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(function() {
    $("#cari_konteks").select2({
        placeholder: "Pilih Konteks",
    });
    $('#cari_departmen').select2({
        placeholder: 'Cari Departmen',
        ajax: {
            url: '/cari-departmen',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            id: item.id+'-'+item.id_departemen,
                            text: item.namadep + " - (" + item.priode_penerapan + ")"
                        }

                    })
                }
            },
            cache: true
        }
    });

    $('#cari_departmen').on('select2:select', function (e) {
        $('#cari_konteks').empty().trigger("change");
		var kode = $(this).val();
        var newkode = kode.split("-");
		$.ajax({
			type: 'GET',
			url: '/hasil-cari-departmen/'+newkode[0]+'/'+newkode[1],
			success: function (data) {
                $.each(data.detail,function(key, item){
                    $('#kode').val(item.kode);
                    $('#id').val(item.id);
                    $('#id_dep').val(item.id_departemen);
                    $('#kodedep').val(item.kodedep);
                    $('#namadep').val(item.namadep);
                    $('#tahun').val(item.priode_penerapan);
                    $('#cari_konteks').val(item.jk);
                });
                $.each(data.resiko, function (key, value) {
                    var newOption = new Option(value.nama+'-'+value.kode,value.id,false, false);
                    $('#cari_konteks').append(newOption).trigger('change');
                });
			},
            complete: function () {
                $('#cari_konteks').val(null).trigger('change');
            }
		});
	});
})
</script>
@endpush