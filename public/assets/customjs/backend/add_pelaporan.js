$('#cari_departemen').select2({
    ajax: {
        url: '/cari_departemen',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
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

$('#cari_tembusan').select2({
    ajax: {
        url: '/cari_departemen',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
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

$('#cari_tujuanpelaporan').select2({
    ajax: {
        url: '/cari_departemen',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
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
