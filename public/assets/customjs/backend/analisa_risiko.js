$(function () {
    $("#cari_kode").select2({
        placeholder: "Pilih Kode Risiko",
    });
    $('#cari_departmen').select2({
        placeholder: 'Cari Departmen',
        ajax: {
            url: '/cari-analisa-departmen',
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

//====================================================================================================
$('#cari_departmen').on('select2:select', function (e) {
    $('#cari_kode').empty().trigger("change");
    var kode = $(this).val();
    var newkode = kode.split("-");
    $.ajax({
        type: 'GET',
        url: '/hasil-cari-analisa departmen/' + newkode[0] + '/' + newkode[1],
        success: function (data) {
            $.each(data.detail, function (key, item) {
                $('#kode').val(item.kode);
                $('#id').val(item.id);
                $('#id_dep').val(item.id_departemen);
                $('#kodedep').val(item.kodedep);
                $('#namadep').val(item.namadep);
                $('#tahun').val(item.priode_penerapan);
            });
            $.each(data.resiko, function (key, value) {
                var newOption = new Option(value.full_kode, value.id, false, false);
                $('#cari_kode').append(newOption).trigger('change');
            });
        },
        complete: function () {
            $('#cari_kode').val(null).trigger('change');
        }
    });
});

//====================================================================================================
$('#cari_kode').on('select2:select', function (e) {
    var kode = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/hasil-cari-kode/' + kode,
        success: function (data) {
            return {
                results: $.map(data, function (item) {
                    $('#pernyataan').val(item.pernyataan_risiko);
                    $('#full_kode').val(item.full_kode);
                })
            }
        },
    });
});

//====================================================================================================
function caribesaran() {
    var frek = $('#cario').val();
    var damp = $('#dampakk').val();
    $.ajax({
        type: 'GET',
        url: '/hasil-cario/' + frek + '/' + damp,
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

//====================================================================================================
function cariresiduotomatis() {
    if($('#sudah_ada_pengendalian').is(':checked')){
        var frek = $('#carir').val();
        var damp = $('#dampakkr').val();
    }else{
        $('#carir').val($('#cario').val());
        $('#dampakkr').val($('#dampakk').val());
        var frek = $('#cario').val();
        var damp = $('#dampakk').val();
    }
    $.ajax({
        type: 'GET',
        url: '/hasil-cari-residu/' + frek + '/' + damp,
        success: function(data) {
            return {
                results: $.map(data, function(item) {
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
                    $('#besarankini').css("background-color", item.kode_warna);

                })
            }

        },

    });
}

//====================================================================================================
$("#sudah_ada_pengendalian").on('click',function() {
    if($('#sudah_ada_pengendalian').is(':checked')){
        $('#input_pengendalian_div').show();
        $('#carir').attr('readonly',false);
        $('#dampakkr').attr('readonly',false);
    }else{
        $('#input_pengendalian_div').hide();
        $('#carir').attr('readonly',true);
        $('#dampakkr').attr('readonly',true);
    }
});
