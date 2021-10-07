$(function(){
    $('#list-data').DataTable({
        order: [[0, "asc"]],
        searching: false, paging: false, info: false,
        ajax: 'data-analisaakarmasalah',

        columns:[
            // {data: 'gambar_produk', name: 'gambar_produk'},
            
            {data: 'kode_risiko', name: 'kode_risiko'},
            {data: 'kategori_penyebab', name: 'kategori_penyebab'},
            {data: 'akar_masalah', name: 'akar_masalah'},
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
$(function() {
    $("#cari_risiko").select2({
        placeholder: "Pilih Kode Risiko",
    });
    $('#cari_departmen').select2({
        placeholder: 'Cari Departmen',
        ajax: {
            url: '/cari-analisa-akar-departmen',
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
        $('#cari_risiko').empty().trigger("change");
		var kode = $(this).val();
        // console.log(kode);
        var newkode = kode.split("-");
		$.ajax({
			type: 'GET',
			url: '/hasil-cari-analisa-akar-departmen/'+newkode[0]+'/'+newkode[1],
			success: function (data) {
                $.each(data.detail,function(key, item){
                    $('#kode').val(item.kode);
                    $('#id').val(item.id);
                    $('#id_dep').val(item.id_departemen);
                    $('#kodedep').val(item.kodedep);
                    $('#namadep').val(item.namadep);
                    $('#tahun').val(item.priode_penerapan);

                    // $('#cari_kode').val(item.jk);
                });
                $.each(data.resiko, function (key, value) {
                    var newOption = new Option(value.full_kode,value.id,false, false);
                    $('#cari_risiko').append(newOption).trigger('change');
                });
			},
            complete: function () {
                $('#cari_risiko').val(null).trigger('change');
            }
		});
	});
    $('#cari_risiko').on('select2:select', function (e) {
		var kode = $(this).val();
		$.ajax({
			type: 'GET',
			url: '/hasil-cari-akar-kode/' + kode,
			success: function (data) {
				return {
					results: $.map(data, function (item) {
							$('#pernyataan').val(item.pernyataan_risiko);
                            $('#full_kode').val(item.full_kode);
                            $('#kode_analisis').val(item.full_kode);
                            // $('#id_jenis_konteks').val(item.id);
                            // $('#kode_konteks').val(item.kode_konteks);
                            // $('#nama_konteks').val(item.namakonteks);
					})
				}
			},
		});
	});
})
