$('#cari_klasifikasi').select2({
    ajax: {
        url: '/cari_klasifikasi',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data.klasifikasi, function (item) {
                    return {
                        id: item.id,
                        text: item.klasifikasi_sub_unsur_spip
                    }

                })
            }
        },
        cache: true
    }
});

$('#edit_klasifikasi').select2({
    ajax: {
        url: '/cari_klasifikasi',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data.klasifikasi, function (item) {
                    return {
                        id: item.id,
                        text: item.klasifikasi_sub_unsur_spip
                    }

                })
            }
        },
        cache: true
    }
});
