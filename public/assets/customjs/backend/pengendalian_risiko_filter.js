$(function() {
    $("#kode_risiko").select2({
        placeholder: "Semua Kode Risiko",
    });
    $('#departemen').select2({
        placeholder: "Semua Departemen",
        // ajax: {
        //     url: '/cari-departmen-filter',
        //     dataType: 'json',
        //     delay: 250,
        //     processResults: function(data) {
        //         return {
        //             results: $.map(data, function(item) {
        //                 return {
        //                     id: item.faktur,
        //                     text: item.namadep
        //                 }

        //             })
        //         }
        //     },
        //     cache: true
        // }
    });

    $('#departemen').on('select2:select', function (e) {
        // $('#departemen').empty().trigger("change");
        $('#kode_risiko').empty().trigger("change");
		var kode = $(this).val();
        // console.log(kode);
        var newkode = kode.split("-");
		$.ajax({
			type: 'GET',
			url: '/hasil-cari-departmen-pengendalian-filter/'+newkode[0],
			success: function (data) {
                $.each(data.detail,function(key, item){
                    $('#kode').val(item.kode);
                    $('#id').val(item.id);
                    $('#faktur').val(item.faktur);
                    $('#id_dep').val(item.id_departemen);
                    $('#kodedep').val(item.kodedep);
                    $('#namadep').val(item.namadep);
                    $('#selera_risiko').val(item.selera_risiko);
                    $('#tahun').val(item.priode_penerapan);
                    // $('#konteks').val(item.jk);
                });
                $.each(data.risiko, function (key, value) {
                    var newOption = new Option(value.full_kode,value.full_kode,false, false);
                    $('#kode_risiko').append(newOption).trigger('change');
                });
			},
            complete: function () {
                $('#kode_risiko').val(null).trigger('change');
            }
		});
	});
    $('#kode_risiko').on('select2:select', function (e) {
		var kode = $(this).val();
		$.ajax({
			type: 'GET',
			url: '/hasil-cari-konteks/' + kode,
			success: function (data) {
				return {
					results: $.map(data, function (item) {
                            $('#kode_risiko').val(item.full_kode);
							$('#id_konteks').val(item.idk);
                            $('#id_jenis_konteks').val(item.id_konteks);
                            $('#kode_konteks').val(item.kode_konteks);
                            $('#nama_konteks').val(item.namakonteks);
					})
				}
			},
		});
	});
})