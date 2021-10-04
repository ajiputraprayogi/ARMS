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
            <h3 class="mb-3">Tambah Analisis Akar Masalah</h3>
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
                    <label class="control-label col-sm-3 align-self-center" for="email">Departemen Pemilik Resiko<i
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
                    <label class="control-label col-sm-3 align-self-center" for="email">Tahun<i
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
                    <label class="control-label col-sm-3 align-self-center" for="email">Risiko<i
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
                    <label class="control-label col-sm-3 align-self-center" for="email">Pernyataan Risiko</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="pernyataan" name="pernyataan" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Kode Analisis</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_analisis" name="kode_analisis" readonly>
                    </div>
                </div>
                <div class="form-group">
                                <b>Why?</b>
                            </div>
                            
                            <div class="form-group">
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary add-list" data-toggle="modal" data-target=""><i class="las la-plus mr-3"></i>Tambah Why</button>
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
                                            <th>Urutan</th>
                                            <th>Uraian Why</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody class="ligth-body">
                                            <th class="text-center"></th>
                                            <th></th>
                                            <!-- <th class="text-center">
                                                <div class="d-flex align-items-center list-action">
                                                    <a class="badge badge-info mr-2" data-toggle="modal" data-target="#showkonteks" title="View" data-original-title="View"><i class="ri-eye-line mr-0"></i></a>
                                                    <a class="badge bg-success mr-2" data-toggle="modal" data-target="#konteks" title="Edit" data-original-title="View"><i class="ri-pencil-line mr-0"></i></a>
                                                    <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapusdatakonteks()"><i class="ri-delete-bin-line mr-0"></i></a>
                                                </div>
                                            </th> -->
                                    </tbody>
                                </table>
                            </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Akar Penyebab<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <textarea id="w3review" name="penyebab" rows="4" cols="50" class="form-control">
                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Kode Penyebab<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="kategori" id="carikat">
                            <option selected value="">MY-Dana(Money)</option>
                            
                            
                            <!-- $kodekat = DB::table('kategori_resiko')->where('id', '=', $cari)->get(); -->
                        </select>
                        <input type="hidden" id="kodekat" name="kodekat">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Tindak Pengendalian<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <textarea id="w3review" name="pengendalian" rows="4" cols="50" class="form-control">
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
<script src="{{asset('assets/customjs/backend/resiko_teridentifikasi.js')}}"></script>
<!-- <script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
					})
				}
                
			},
		});
	});
</script>
@endpush