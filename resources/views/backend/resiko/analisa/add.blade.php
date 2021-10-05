@extends('layouts.base')
@section('title')
Toko Online | Analisa Risiko
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
                    <label class="control-label col-sm-3 align-self-center" for="email">Kode Risiko<i
                            class="bintang">*</i></label>
                    <div class="col-sm-9">
                        <select class="js-example-basic-single text search-input" id="cari_kode" name="kode"
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
                        <input type="text" class="form-control" id="" name="pernyataan">
                    </div>
                </div>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Skor yang melekat</legend>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Saat Ini<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frekkini" id="cario">
                                <option selected disabled value="">Skor Frekuensi Saat Ini</option>
                                @foreach($frekuensi as $row)
                                <option value="{{$row->id}}">{{$row->nilai}} - {{$row->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Saat Ini<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="dampakini" id="dampakk" class="dampakk">
                                <option selected disabled value="">Skor Dampak Saat Ini</option>
                                @foreach($dampak as $row2)
                                <option value="{{$row2->id}}">{{$row2->nilai}} - {{$row2->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="text" name="besaran" id="besaran">
                </fieldset>
                <div class="form-group">
                    <b>Sudah Ada Pengendalian??</b><span> <input type="checkbox" onclick="hide('my-list')" id="hide"></label></span>
                </div>
                <fieldset class="scheduler-border" id="my-list">
                    <legend class="scheduler-border">Skor yang melekat</legend>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Uraian Pengendaliank<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <textarea id="w3review" name="urpen" rows="4" cols="50" class="form-control">
                        </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Apakah Memadai ??<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="pengajuan" id="">
                                <option value="diajukan">Memadai</option>
                                <option value="diajukan">Belum Memadai</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Skor Residu Setelah Pengendalian</legend>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Saat Ini<i
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
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Saat Ini<i
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
                </fieldset>
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
<script type="text/javascript">
function hide(id)
{
  if (hide == true) {
    document.getElementById(id).style.display = 'block';
    is_hide = false;
  }
  else {
    document.getElementById(id).style.display = 'none';
    hide = true;
  }
}
</script>
<!-- <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script> -->
<!-- <script src="{{asset('assets/customjs/backend/analisa_risiko.js')}}"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).on('change', function (e) {
        // $('#tahun').empty().trigger("change");
        // $('#dampakk').empty().trigger("change");
		var frek = $('#cario').val();
        console.log(frek);
        var damp = $('#dampakk').val();
                console.log(damp);
        $.ajax({
			type: 'GET',    
			url: '/hasil-cario/'+frek+'/'+damp,
			success: function (data) {
				return {
					results: $.map(data, function (item) {
                        // $('#besaran').append('<option>' + data.nilai + '</option>')
					    $('#besaran').val(item.nilai);
                        $('#besaran').empty().trigger("change");
					})
				}
                
			},
		});
});
        // $(document).ready(function(){
		// 	$("#cario").change(function(){
		// 		var aid = $("#cario").val();
        //         console.log(aid);
		// 		$.ajax({
		// 			url: 'cario',
		// 			method: 'post',
		// 			data: 'aid=' + aid
		// 		}).done(function(books){
		// 			console.log(books);
		// 			books = JSON.parse(books);
		// 			$('#books').empty();
		// 			books.forEach(function(book){
		// 				$('#books').append('<option>' + book.name + '</option>')
		// 			})
		// 		})
		// 	})
		// })

</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush