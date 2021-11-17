$('#cari_departemen').select2({
    ajax: {
        url: '/cari_departemen',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data.departemen, function (item) {
                    $('#id_unit_kerja').val(item.id);
                    cariTujuanTembusan();
                    return {
                        id: item.id,
                        text: item.nama
                    }

                })
            }
        },
        cache: true
    }
});

$('#cari_tembusan').select2();
$('#cari_tujuanpelaporan').select2();

$('#cari_tembusan').select2({
    ajax: {
        url: '/cari_departemen',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data.departemen, function (item) {
                    return {
                        id: item.id,
                        text: item.nama
                    }

                })
            }
        },
        cache: true
    }
});

function cariTujuanTembusan(){
    $('#cari_tujuanpelaporan').select2({
        ajax: {
            url: '/cari-atasan/' + $('#id_unit_kerja').val(),
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data.data_atasan, function (item) {
                        return {
                            id: item.id,
                            text: item.nama
                        }

                    })
                }
            },
            cache: true
        }
    });
}
