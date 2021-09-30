$(function(){
    $('#list-data').DataTable({
        order: [[0, "asc"]],
        searching: false, paging: false, info: false,
        ajax: 'data-resikoteridentifikasi',

        columns:[
            // {data: 'gambar_produk', name: 'gambar_produk'},
            // {data: 'nama', name: 'nama'},
            {
                render: function(data, type, row){
                    // return '<button class="btn btn-danger" onclick="hapusdata('+row['id']+')"><i class="fa fa-trash"></i></button> <a href="/client/'+row['id']+'/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>'
                    return '<div class="box1" style="background-color: '+row['pr']+';"></div>'
                },
                "className": "text-center",
                "orderable": false,
                "data": null,
            },
            {data: 'kode_risiko', name: 'kode_risiko'},
            {data: 'pernyataan_risiko', name: 'pernyataan_risiko'},
            {data: 'id_konteks', name: 'konteks'},
            {data: 'kategori_risiko', name: 'kategori_risiko'},
            {
                render: function(data, type, row){
                    // return '<button class="btn btn-danger" onclick="hapusdata('+row['id']+')"><i class="fa fa-trash"></i></button> <a href="/client/'+row['id']+'/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>'
                    return '<di><p>'+row['besaran_awal']+'</p></di>'
                },
                "className": "text-center",
                "orderable": false,
                "data": null,
            },
            {
                render: function(data, type, row){
                    // return '<button class="btn btn-danger" onclick="hapusdata('+row['id']+')"><i class="fa fa-trash"></i></button> <a href="/client/'+row['id']+'/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>'
                    return '<di><p>'+row['besaran_akhir']+'</p></di>'
                },
                "className": "text-center",
                "orderable": false,
                "data": null,
            },
            {
                render: function(data, type, row){
                    // return '<button class="btn btn-danger" onclick="hapusdata('+row['id']+')"><i class="fa fa-trash"></i></button> <a href="/client/'+row['id']+'/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>'
                    return '<di><p>'+row['status']+'</p></di>'
                },
                "className": "text-center",
                "orderable": false,
                "data": null,
            },
            {
                render: function(data, type, row){
                    // return '<button class="btn btn-danger" onclick="hapusdata('+row['id']+')"><i class="fa fa-trash"></i></button> <a href="/client/'+row['id']+'/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>'
                    return '<div class="d-flex align-items-center list-action"><a class="badge badge-info mr-2" data-toggle="modal" data-target="#show'+row['id']+'" title="View" data-original-title="View"><i class="ri-eye-line mr-0"></i></a><a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"href="/resiko-teridentifikasi/'+row['id']+'/edit"><i class="ri-pencil-line mr-0"></i></a><a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="hapusdata('+row['id']+')"><i class="ri-delete-bin-line mr-0"></i></a></div>'
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
function hapusdata(kode){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass:{
            confirmButton: 'btn btn-success',
            cancelButton:'btn btn-danger',
        },
        buttonsStyling: true
    })
    swalWithBootstrapButtons.fire({
        title: 'Hapus Data ?',
        text: "Data tidak dapat dipulihkan kembali!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result)=>{
        if(result.value){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: 'DELETE',
                url: 'resiko-teridentifikasi/'+kode,
                data:{
                    'token':$('input[name=_token]').val(),
                },
                success: function(){
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Data Berhasil Dihapus.',
                        'success'
                    )
                    $('#list-data').DataTable().ajax.reload();
                }
            })
        }
    })
}


// js cari departmen
$(document).ready(function () {
	$('#cari_departmen').select2({
		placeholder: 'Cari Departmen',
		ajax:{
			url:'/cari-departmen',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						return {
							id: item.id,
							text: item.namadep.concat(" - ").concat(item.priode_penerapan)
						}

					})
				}
			},
			cache: true
		}
	});
	//======================================================
	$('#cari_departmen').on('select2:select', function (e) {
        // $('#tahun').empty().trigger("change");
		var kode = $(this).val();
        // var newoption = [];
		$.ajax({
			type: 'GET',
			url: '/hasil-cari-departmen/' + kode,
			success: function (data) {
				return {
					results: $.map(data, function (item) {
							$('#kode').val(item.kode);
							$('#id').val(item.id);
                            $('#id_dep').val(item.id_departemen);
                            $('#kodedep').val(item.kodedep);
                            $('#namadep').val(item.namadep);
                            $('#tahun').val(item.priode_penerapan);
                            $('#cari_konteks').val(item.jk);
					})
				}
                
			},
		});
	});
})
// cari konteks
$(document).ready(function () {
	$('#cari_konteks').select2({
		placeholder: 'Cari Konteks',
		ajax:{
			url:'/cari-konteks',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						return {
							id: item.id,
							text: item.namakonteks
						}

					})
				}
			},
			cache: true
		}
	});
    $('#cari_konteks').on('select2:select', function (e) {
		var kode = $(this).val();
		$.ajax({
			type: 'GET',
			url: '/hasil-cari-konteks/' + kode,
			success: function (data) {
				return {
					results: $.map(data, function (item) {
							$('#id_konteks').val(item.id_konteks);
                            $('#id_jenis_konteks').val(item.id);
                            $('#kode_konteks').val(item.kode_konteks);
                            $('#nama_konteks').val(item.namakonteks);
					})
				}
			},
		});
	});
});