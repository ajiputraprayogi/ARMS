const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
    },
    buttonsStyling: true
})

$(function () {
    //==================================================================================================
    $("#cari_risiko").select2({
        placeholder: "Pilih Kode Risiko",
    });

    //==================================================================================================
    $('#cari_departmen').select2({
        placeholder: 'Cari Departmen',
        ajax: {
            url: '/cari-analisa-akar-departmen',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id + '-' + item.id_departemen,
                            text: item.namadep + " - (" + item.priode_penerapan + ")"
                        }

                    })
                }
            },
            cache: true
        }
    });
})

//==================================================================================================
$('#cari_departmen').on('select2:select', function (e) {

    $('#panel').loading('toggle');
    $('#cari_risiko').empty().trigger("change");
    var kode = $(this).val();
    var newkode = kode.split("-");
    $.ajax({
        type: 'GET',
        url: '/hasil-cari-analisa-akar-departmen/' + newkode[0] + '/' + newkode[1],
        success: function (data) {
            $.each(data.detail, function (key, item) {
                $('#kode').val(item.kode);
                $('#id').val(item.id);
                $('#id_dep').val(item.id_departemen);
                $('#kodedep').val(item.kodedep);
                $('#namadep').val(item.namadep);
                $('#tahun').val(item.priode_penerapan);
                $('#selera_risiko').val(item.selera_risiko);
            });
            $.each(data.resiko, function (key, value) {
                var newOption = new Option(value.full_kode,value.full_kode, false, false);
                $('#cari_risiko').append(newOption).trigger('change');
            });
        },
        complete: function () {
            $('#cari_risiko').val(null).trigger('change');
            $('#panel').loading('stop');
        }
    });
});

//==================================================================================================
$('#cari_risiko').on('select2:select', function (e) {

    $('#panel').loading('toggle');
    var kode = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/hasil-cari-akar-kode/' + kode,
        success: function (data) {
            return {
                results: $.map(data, function (item) {
                    $('#pernyataan').val(item.pernyataan_risiko);
                    $('#full_kode').val(item.full_kode);
                    $('#frekuensi_saat_ini').val(item.frekuensi_akhir);
                    $('#dampak_saat_ini').val(item.dampak_akhir);
                    $('#besaran_saat_ini').val(item.besaran_akhir);
                    $('#besaran_saat_ini').css("background-color", item.pr_akhir);
                })
            }
        },
        complete: function () {
            hitungdevisiasi();
            hitungdevisiasiselerarisiko();
            $('#panel').loading('stop');
        }
    });
});

//====================================================================================================
function cariresiduotomatis() {
    var frek = $('#carir').val();
    var damp = $('#dampakkr').val();
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/hasil-cari-residu/' + frek + '/' + damp,
        success: function(data) {
            return {
                results: $.map(data, function(item) {
                    $('#besarankini').val(item.nilai)
                    $('#besarankini').css("background-color", item.kode_warna);
                    $('#warnabesarankini').val(item.kode_warna);
                })
            }
        },
        complete: function () {
            hitungdevisiasi();
            hitungdevisiasiselerarisiko();
            $('#panel').loading('stop');
        }
    });
}

//====================================================================================================
function hitungdevisiasi(){
    if($('#besarankini').val()!='' && $('#besaran_saat_ini').val()!=''){
        $('#deviasi').val(parseInt($('#besaran_saat_ini').val())-parseInt($('#besarankini').val()));
    }
}
function hitungdevisiasiselerarisiko(){
    if($('#besarankini').val()!='' && $('#selera_risiko').val()!=''){
        $('#deviasi_selera_risiko').val(parseInt($('#selera_risiko').val())-parseInt($('#besarankini').val()));
    }
}