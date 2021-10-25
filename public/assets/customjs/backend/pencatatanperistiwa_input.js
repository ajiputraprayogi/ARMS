$(function () {
    $("#cari_risiko").select2({
        placeholder: "Pilih Kode Risiko",
    });
    $('#cari_akar_masalah').select2({
        placeholder: "Pilih Akar Masalah",
    });
    $('#cari_departemen_manajemen').select2({
        placeholder: 'Cari Departmen',
        ajax: {
            url: '/cari_departemen_manajemen',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id + '-' + item.faktur,
                            text: item.nama + " - (" + item.priode_penerapan + ")"
                        }

                    })
                }
            },
            cache: true
        }
    });
});

//==========================================================================================================
$('#cari_departemen_manajemen').on('select2:select', function (e) {
    $('#panel').loading('toggle');
    $('#cari_risiko').empty().trigger("change");
    $('#cari_akar_masalah').empty().trigger("change");
    $('kode_analisis').empty().trigger("change");
    var kode = $(this).val();
    var newkode = kode.split("-");
    $.ajax({
        type: 'GET',
        url: '/cari_departemen_manajemen_hasil/' + newkode[0] + '/' + newkode[1],
        success: function (data) {
            $.each(data.detail, function (key, item) {
                $('#id_manajemen').val(item.id);
                $('#faktur').val(item.faktur);
                $('#id_departemen').val(item.id_departemen);
                $('#priode_penerapan').val(item.priode_penerapan);
            });

            $.each(data.resiko, function (key, value) {
                var newOption = new Option(value.full_kode, value.id + '-' + value.full_kode, false, false);
                $('#cari_risiko').append(newOption).trigger('change');
            });
        },
        complete: function () {
            $('#cari_risiko').val(null).trigger('change');
            $('#kode_analisis').val(null).trigger('change');
            $('#panel').loading('stop');
        }
    });
});

//==========================================================================================================
$('#cari_risiko').on('select2:select', function (e) {
    $('#panel').loading('toggle');
    $('#cari_akar_masalah').empty().trigger("change");
    var kode = $(this).val();
    var newkode = kode.split("-");
    $.ajax({
        type: 'GET',
        url: '/cari_risiko_hasil/' + newkode[0] + '/' + newkode[1],
        success: function (data) {
            $.each(data.detail, function (key, item) {
                $('#id_risiko').val(item.id)
                $('#id_konteks').val(item.id_konteks)
                $('#pernyataan_risiko').val(item.pernyataan_risiko)
                // $('#uraian').val(item.uraian_dampak)
                $('#full_kode').val(item.full_kode);
                $('#kode_risiko').val(item.full_kode);
                $('#cario').append('<option value="">' + item.frekuensi_akhir + '</option>');
                $('#frekuensi_saat_ini').val(item.frekuensi_akhir);
                $('#dampakk').append('<option value="">' + item.dampak_akhir + '</option>');
                $('#dampak_saat_ini').val(item.dampak_akhir);
                $('#besaran').val(item.besaran_akhir);
                $('#besaran').css("background-color", item.pr_akhir);
                $('#pr_saat_ini').val(item.pr_akhir);
            });
            $.each(data.akarmasalah, function (key, value) {
                var newOption = new Option(value.kode_analisis, value.id, false, false);
                $('#cari_akar_masalah').append(newOption).trigger('change');
            });
        },
        complete: function () {
            $('#cari_akar_masalah').val(null).trigger('change');
            $('#kode_analisis').val(null).trigger('change');
            $('#panel').loading('stop');
        }
    });
});

//==========================================================================================================
$('#cari_akar_masalah').on('select2:select', function (e) {
    $('#panel').loading('toggle');
    var kode = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/cari_akar_masalah_hasil/' + kode,
        success: function (data) {
            $.each(data.akarmasalah, function (key, item) {
                $('#id_akar_masalah').val(item.id);
                $('#kode_analisis').val('PG.' + item.kode_analisis);
                $('#akar_penyebab').val(item.akar_masalah);
                //$('#kegiatan_pengendalian').val(item.tindakan_pengendalian);
            });
        },
        complete: function () {
            $('#panel').loading('stop');
        }
    });
});