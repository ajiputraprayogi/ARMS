$('#cari_departemen_manajemen').select2({
    ajax:{
        url:'/cari_departemen_manajemen',
        dataType:'json',
        delay:250,
        processResults: function (data){
            return {
                results : $.map(data, function (item){
                    return {
                        id: item.id+'-'+item.id_departemen,
                        text: item.nama+' - ('+item.priode_penerapan+')',
                    }

                })
            }
        },
        cache: true
    }
});
$('#cari_departemen_manajemen').on('select2:select',function(e){
    var kode = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/cari_departemen_manajemen_hasil/'+kode,
        success:function (data){
        return {
            results : $.map(data, function (item){
                $('#id_manajemen').val(item.id)
                $('#id_departemen').val(item.id_departemen)
                $('#priode_penerapan').val(item.priode_penerapan)
                $('#id_coba').val(item.faktur);
            })
        }
    },
    });
});
$('#cari_risiko').select2({
    ajax:{
        url:'/cari_risiko',
        dataType:'json',
        delay:250,
        processResults: function (data){
            return {
                results : $.map(data, function (item){
                    return {
                        id: item.id,
                        text: item.kode_risiko,
                    }

                })
            }
        },
        cache: true
    }
});
$('#cari_risiko').on('select2:select',function(e){
    var kode = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/cari_risiko_hasil/'+kode,
        success:function (data){
        return {
            results : $.map(data, function (item){
                $('#id_risiko').val(item.id)
                $('#pernyataan_risiko').val(item.pernyataan_risiko)
            })
        }
    },
    });
});