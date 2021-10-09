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
            <form class="form-horizontal" action="{{url('analisa-risiko')}}" method="post">
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
                <input type="hidden" name="full_kode" id="full_kode">
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center" for="email">Pernyataan Risiko</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="pernyataan" name="pernyataan">
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
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Besaran Saat Ini<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" name="besaran" id="besaran" class="box1" readonly>
                        </div>
                    </div>
                    <!-- <div class="box1" style="background-color: '+data['kode_warna']+';"></div> -->
                    <input type="" name="warna" id="warna">
                    <input type="" name="nilpro" id="nilpro">
                    <input type="" name="nildam" id="nildam">
                    <input type="" name="nampro" id="nampro">
                    <input type="" name="namdam" id="namdam">
                    <input type="" name="idpro" id="idpro">
                    <input type="" name="iddam" id="iddam">
                </fieldset>
                <div class="form-group">
                    <b>Sudah Ada Pengendalian??</b><span> <input value="Sudah" name="sudah_ada_pengendalian" type="checkbox" onclick="hide('my-list')"
                            id="hide"></label></span>
                </div>
                <!-- <fieldset class="scheduler-border" id="my-list">
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
                </fieldset> -->
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Pengendalian Yang Ada</legend>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="email">Uraian Pengendalian</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="uraian_pengendalian" id="uraian_pengendalian" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="email">Apakah Memadai</label>
                            <div class="col-sm-9">
                                <select name="apakah_memadai" class="form-control" id="apakah_memadai">
                                    <option value="Memadai">Memadai</option>
                                    <option value="Belum Memadai">Belum Memadai</option>
                                </select>
                            </div>
                        </div>
                </fieldset>
                <!-- <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Skor Residu Setelah Pengendalian</legend>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Saat Ini<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frekkini" id="fresidu">
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
                            <select class="form-control" name="dampakini" id="dresidu" class="dampakk">
                                <option selected disabled value="">Skor Dampak Saat Ini</option>
                                @foreach($dampak as $row2)
                                <option value="{{$row2->id}}">{{$row2->nilai}} - {{$row2->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Besaran Saat Ini<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" name="besaran" id="besaran_residu" class="box1" readonly>
                        </div>
                    </div>
                    <input type="hidden" name="warna_residu" id="warna_residu">
                    <input type="hidden" name="nilpro2" id="nilpro2">
                    <input type="hidden" name="nildam2" id="nildam2">
                    <input type="hidden" name="nampro2" id="nampro2">
                    <input type="hidden" name="namdam2" id="namdam">
                </fieldset> -->
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Skor Residu Setelah Pengendalian</legend>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Frekuensi Residu<i class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frekkini" id="carir">
                                <option selected disabled value="">Skor Frekuensi Saat Ini</option>
                                @foreach($frekuensi as $row)
                                <option value="{{$row->id}}">{{$row->nilai}} - {{$row->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Dampak Residu<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="dampakini" id="dampakkr">
                                <option selected disabled value="">Skor Dampak Saat Ini</option>
                                @foreach($dampak as $row2)
                                <option value="{{$row2->id}}">{{$row2->nilai}} - {{$row2->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="email">Skor Besaran Residu<i
                                class="bintang">*</i></label>
                        <div class="col-sm-9">
                            <input type="text" name="besarankini" id="" class="box1" readonly>
                        </div>
                        <input type="" name="warna" id="warnar">
                        <input type="" name="nilpro" id="nilpror">
                        <input type="" name="nildam" id="nildamr">
                        <input type="" name="nampro" id="nampror">
                        <input type="" name="namdam" id="namdamr">
                        <input type="" name="idpro" id="idpror">
                        <input type="" name="iddam" id="iddamr">
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
function hide(id) {
    if (hide == true) {
        document.getElementById(id).style.display = 'block';
        is_hide = false;
    } else {
        document.getElementById(id).style.display = 'none';
        hide = true;
    }
}
</script>
<!-- <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script> -->
<script src="{{asset('assets/customjs/backend/analisa_risiko.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).on('change', function(e) {
    // $('#tahun').empty().trigger("change");
    // $('#dampakk').empty().trigger("change");

    var frek = $('#cario').val();
    console.log(frek);
    var damp = $('#dampakk').val();
    console.log(damp);
    $.ajax({
        type: 'GET',
        url: '/hasil-cario/' + frek + '/' + damp,
        success: function(data) {
            return {
                results: $.map(data, function(item) {
                    // $('#besaran').append('<option>' + data.nilai + '</option>')
                    $('#besaran').val(item.nilai)
                    $('#warna').val(item.kode_warna)
                    $('#idpro').val(item.idpro)
                    $('#iddam').val(item.iddam)
                    $('#nilpro').val(item.nilpro)
                    $('#nildam').val(item.nildam)
                    $('#nampro').val(item.nampro)
                    $('#namdam').val(item.namdam)
                    $('#fresidu').val(item.idpro)
                    $('#dresidu').val(item.iddam)
                    $('#besaran_residu').val(item.nilai);

                })
                // $('#besaran').empty().trigger("change");
            }

        },

    });

});
$(document).on('change', function(e) {
    // $('#tahun').empty().trigger("change");
    // $('#dampakk').empty().trigger("change");

    var frek = $('#carir').val();
    console.log(frek);
    var damp = $('#dampakkr').val();
    console.log(damp);
    $.ajax({
        type: 'GET',
        url: '/hasil-cari-residu/' + frek + '/' + damp,
        success: function(data) {
            return {
                results: $.map(data, function(item) {
                    // $('#besaran').append('<option>' + data.nilai + '</option>')
                    $('#besarankini').val(item.nilai)
                    $('#warnar').val(item.kode_warna)
                    $('#idpror').val(item.idpro)
                    $('#iddamr').val(item.iddam)
                    $('#nilpror').val(item.nilpro)
                    $('#nildamr').val(item.nildam)
                    $('#nampror').val(item.nampro)
                    $('#namdamr').val(item.namdam)
                    $('#fresidur').val(item.idpro)
                    $('#dresidur').val(item.iddam)
                    $('#besaran_residur').val(item.nilai);

                })
                // $('#besaran').empty().trigger("change");
            }

        },

    });

});

// $(document).on('change', function(e) {
//     // $('#tahun').empty().trigger("change");
//     // $('#dampakk').empty().trigger("change");

//     var frek = $('#fresidu').val();
//     console.log(frek);
//     var damp = $('#dresidu').val();
//     console.log(damp);
//     $.ajax({
//         type: 'GET',
//         url: '/hasil-cari-residu/' + frek + '/' + damp,
//         success: function(data) {
//             return {
//                 results: $.map(data, function(item) {
//                     // $('#besaran').append('<option>' + data.nilai + '</option>')
//                     $('#besaran_residu').val(item.nilai);
//                     $('#warna_residu').val(item.kode_warna)
//                     $('#nilpro2').val(item.nilpro)
//                     $('#nildam2').val(item.nildam)
//                     $('#nampro2').val(item.nampro)
//                     $('#namdam2').val(item.namdam)
//                 })
//                 // $('#besaran').empty().trigger("change");
//             }

//         },

//     });

// });
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