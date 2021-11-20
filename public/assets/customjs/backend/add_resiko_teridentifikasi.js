$('#cari_metode').select2({
    ajax: {
        url: '/cari_metode',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data.metode, function (item) {
                    return {
                        id: item.id,
                        text: item.metode
                    }

                })
            }
        },
        cache: true
    }
});

$('#edit_metode').select2({
    ajax: {
        url: '/cari_metode',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data.metode, function (item) {
                    return {
                        id: item.id,
                        text: item.metode
                    }

                })
            }
        },
        cache: true
    }
});
