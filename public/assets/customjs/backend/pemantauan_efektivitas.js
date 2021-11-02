$(function(){
    $('#list-data').DataTable({
        order: [[0, "asc"]],
        searching: false, paging: false, info: false,
        ajax: 'data-departemen',

        columns:[
            // {data: 'gambar_produk', name: 'gambar_produk'},
            {data: 'kode', name: 'kode'},
            {data: 'nama', name: 'nama'},
            {
                render: function(data, type, row){
                    // return '<button class="btn btn-danger" onclick="hapusdata('+row['id']+')"><i class="fa fa-trash"></i></button> <a href="/client/'+row['id']+'/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>'
                    return '<div class="d-flex align-items-center list-action"><a class="badge badge-info mr-2" data-toggle="modal" data-target="#show'+row['id']+'" title="View" data-original-title="View"><i class="ri-eye-line mr-0"></i></a><a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"href="/departemen/'+row['id']+'/edit"><i class="ri-pencil-line mr-0"></i></a><a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="hapusdata('+row['id']+')"><i class="ri-delete-bin-line mr-0"></i></a></div>'
                },
                "className": "text-center",
                "orderable": false,
                "data": null,
            },
        ],
        pageLength: 10,
        lengthMenu: [[5, 10, 20], [5, 10, 20]]
    })
})
$(function() {
    $("#cari_risiko").select2({
        placeholder: "Pilih Kode Risiko",
    });
    $('#cari_akar_masalah').select2({
        placeholder: "Pilih Kode Pengendalian",
    });
    $('#cari_departemen_manajemen').select2({
        placeholder: 'Cari Departmen',
        ajax: {
            url: '/cari_departemen_manajemen_pelaksanaan',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            id: item.id+'-'+item.faktur,
                            text: item.nama + " - (" + item.priode_penerapan + ")"
                        }

                    })
                }
            },
            cache: true
        }
    });

    $('#cari_departemen_manajemen').on('select2:select', function (e) {
        $('#cari_risiko').empty().trigger("change");
        $('#cari_akar_masalah').empty().trigger("change");
        $('kode_analisis').empty().trigger("change");
		var kode = $(this).val();
        // console.log(kode);
        var newkode = kode.split("-");
		$.ajax({
			type: 'GET',
			url: '/cari_departemen_manajemen_pelaksanaan_hasil/'+newkode[0]+'/'+newkode[1],
			success: function (data) {
                $.each(data.detail,function(key, item){
                    $('#id_manajemen').val(item.id)
                    $('#faktur').val(item.faktur)
                    $('#id_departemen').val(item.id_departemen)
                    $('#priode_penerapan').val(item.priode_penerapan)

                    // $('#cari_kode').val(item.jk);
                });
                
                $.each(data.resiko, function (key, value) {
                    var newOption = new Option(value.full_kode, value.id+'-'+value.faktur, false, false);
                    $('#cari_risiko').append(newOption).trigger('change');
                });
			},
            complete: function () {
                $('#cari_risiko').val(null).trigger('change');
                $('#id_risiko').val(null).trigger('change');
                $('#kode_analisis').val(null).trigger('change');
                $('#id_pengendalian').val(null).trigger('change');
                $('#pernyataan_risiko').val(null).trigger('change');
                $('#kegiatan_pengendalian').val(null).trigger('change');
                $('#frekuensi_saat_ini').val(null).trigger('change');
                $('#dampak_saat_ini').val(null).trigger('change');
                $('#besaran_saat_ini').val(null).trigger('change');
                $('#besaran_saat_ini').css("background-color",null).trigger('change');
                $('#pr_saat_ini').val(null).trigger('change');
                $('#frekuensi_akhir').val(null).trigger('change');
                $('#dampak_akhir').val(null).trigger('change');
                $('#besaran_akhir').val(null).trigger('change');
                $('#besaran_akhir').css("background-color",null).trigger('change');
                $('#pr_akhir').val(null).trigger('change');
            }
		});
	});
    $('#cari_risiko').on('select2:select', function (e) {
        $('#cari_akar_masalah').empty().trigger("change");
        var kode = $(this).val();
        var newkode = kode.split("-");
		$.ajax({
			type: 'GET',
			url: '/cari_risiko_pelaksanaan_hasil/' +newkode[0]+'/'+newkode[1],
			success: function (data) {
                $.each(data.detail,function(key, item){
                            $('#id_risiko').val(item.id)
                            $('#id_konteks').val(item.id_konteks)
                            $('#pernyataan_risiko').val(item.pernyataan_risiko)
                            $('#full_kode').val(item.full_kode);
                            $('#frekuensi_akhir').val(item.frekuensi_akhir)
                            $('#dampak_akhir').val(item.dampak_akhir)
                            $('#besaran_akhir').val(item.besaran_akhir)
                            $('#besaran_akhir').css("background-color",item.pr_akhir)
                            $('#pr_akhir').val(item.pr_akhir);
                            // $('#cario').append('<option value="">'+item.frekuensi_akhir+'</option>');
                            // $('#frekuensi_saat_ini').val(item.frekuensi_akhir);
                            // $('#dampakk').append('<option value="">'+item.dampak_akhir+'</option>');
                            // $('#dampak_akhir').val(item.dampak_akhir);
                            // $('#besaran_akhir').val(item.besaran_akhir);
                            // $('#besaran_akhir').css("background-color",item.pr_akhir);
                            // $('#pr_akhir').val(item.pr_akhir);
                            // $('#id_peta_besaran_risiko').val(item.idbes)
							// $('#pernyataan').val(item.pernyataan_risiko);
                            // $('#id_jenis_konteks').val(item.id);
                            // $('#kode_konteks').val(item.kode_konteks);
                            // $('#nama_konteks').val(item.namakonteks);
                });
                $.each(data.pengendalian, function (key, value) {
                    var newOption = new Option(value.kode_tindak_pengendalian,value.id,false, false);
                    $('#cari_akar_masalah').append(newOption).trigger('change');
                });
			},
            complete: function () {
                $('#cari_akar_masalah').val(null).trigger('change');
                $('#kode_analisis').val(null).trigger('change');
            }
		});
    });
    $('#cari_akar_masalah').on('select2:select', function (e) {
        var kode = $(this).val();
		$.ajax({
			type: 'GET',
			url: '/cari_pengendalian_hasil/' + kode,
			success: function (data) {
                $.each(data.pengendalian,function(key, item){
                    $('#id_pengendalian').val(item.id);
                    $('#kegiatan_pengendalian').val(item.kegiatan_pengendalian);
                    $('#frekuensi_saat_ini').val(item.frekuensi_saat_ini)
                    $('#dampak_saat_ini').val(item.dampak_saat_ini)
                    $('#besaran_saat_ini').val(item.besaran_saat_ini)
                    $('#besaran_saat_ini').css("background-color",item.pr_saat_ini)
                    $('#pr_saat_ini').val(item.pr_saat_ini)
                    // $('#penanggung_jawab').val(item.penanggung_jawab);
                    // $('#indikator_keluaran').val(item.indikator_keluaran);
                    // $('#target_waktu').val(item.target_waktu);
                });
			},
		});
	});
})
function caribesaran() {
    $('#carir').val($('#cario').val());
    $('#dampakkr').val($('#dampakk').val());
    var frek = $('#cario').val();
    var damp = $('#dampakk').val();
    $.ajax({
        type: 'GET',
        url: '/hasil-besaran-pengendalian/' + frek + '/' + damp,
        success: function (data) {
            return {
                results: $.map(data, function (item) {
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
                    $('#besaran').css("background-color", item.kode_warna);
                })
            }
        },
    });
    if($('#sudah_ada_pengendalian').is(':checked')){
    }else{
        cariresiduotomatis();
    }
}
// $('#cari_departemen_manajemen').select2({
//     ajax:{
//         url:'/cari_departemen_manajemen',
//         dataType:'json',
//         delay:250,
//         processResults: function (data){
//             return {
//                 results : $.map(data, function (item){
//                     return {
//                         id: item.id+'-'+item.id_departemen,
//                         text: item.nama+' - ('+item.priode_penerapan+')',
//                     }

//                 })
//             }
//         },
//         cache: true
//     }
// });
// $('#cari_departemen_manajemen').on('select2:select',function(e){
//     var kode = $(this).val();
//     $.ajax({
//         type: 'GET',
//         url: '/cari_departemen_manajemen_hasil/'+kode,
//         success:function (data){
//         return {
//             results : $.map(data, function (item){
//                 $('#id_manajemen').val(item.id)
//                 $('#id_departemen').val(item.id_departemen)
//                 $('#priode_penerapan').val(item.priode_penerapan)
//             })
//         }
//     },
//     });
// });
// $('#cari_risiko').select2({
//     ajax:{
//         url:'/cari_risiko',
//         dataType:'json',
//         delay:250,
//         processResults: function (data){
//             return {
//                 results : $.map(data, function (item){
//                     return {
//                         id: item.id,
//                         text: item.kode_risiko,
//                     }

//                 })
//             }
//         },
//         cache: true
//     }
// });
// $('#cari_risiko').on('select2:select',function(e){
//     var kode = $(this).val();
//     $.ajax({
//         type: 'GET',
//         url: '/cari_risiko_hasil/'+kode,
//         success:function (data){
//         return {
//             results : $.map(data, function (item){
//                 $('#id_risiko').val(item.id)
//                 $('#pernyataan_risiko').val(item.pernyataan_risiko)
//             })
//         }
//     },
//     });
// });