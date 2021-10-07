const swalWithBootstrapButtons = Swal.mixin({
    customClass:{
        confirmButton: 'btn btn-success',
        cancelButton:'btn btn-danger',
    },
    buttonsStyling: true
})

$(function () {
    
    //=====================================================================================
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

    //=====================================================================================
    getdatakonteks()
});

//=====================================================================================
$('#cari_departemen').on('select2:select', function (e) {
    var kode = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/cari_departemen_hasil/' + kode,
        success: function (data) {
            return {
                results: $.map(data, function (item) {
                    $('#id_departemen').val(item.id);
                })
            }
        },
    });
});

//=====================================================================================
$('#addkonteksbtn').on('click', function (e) {
    if ($('#kode_konteks').val() == '' || $('#nama_konteks').val() == '' || $('#id_jenis_konteks').val() == '' || $('#detail_ancaman_konteks').val() == '' || $('#indikator_kinerja_kegiatan').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Detail permintaan tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formaddkonteks').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/konteks',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    swalWithBootstrapButtons.fire({
                        title: 'Info',
                        text: 'Data Berhasil disimpan',
                        confirmButtonText: 'OK'
                    });
                }, complete: function () {
                    $('#kode_konteks').val('');
                    $('#nama_konteks').val('');
                    $('#id_jenis_konteks').val('');
                    $('#detail_ancaman_konteks').val('');
                    $('#indikator_kinerja_kegiatan').val('');
                    $('#konteks').modal('hide');
                    $('#panel').loading('stop');
                }
            });
        });
    }
});

//=====================================================================================
function getdatakonteks(){
    $('#panel').loading('toggle');
    var kode = $('#faktur').val();
    $('#tubuhnya').html('');
    $.ajax({
        type: 'GET',
        url: '/cari-data-konteks/' + kode,
        success: function (data) {
            var rows ='';
            var no=0;
            var subtotal=0;
                $.each(data,function(key, value){
                    no +=1;
                    rows = rows + '<tr>';
                    rows = rows + '<td>' +value.kode+'</td>';
                    rows = rows + '<td>'+value.nama+'</td>';
                    rows = rows + '<td>'+value.konteks+'</td>';
                    rows = rows + '<td class="text-center"><button type="button" onclick="hapusdatakonteks(' + value.id + ')" class="btn btn-danger btn-sm m-0"><i class="ri-delete-bin-line mr-0"></i></button></td>';
                    rows = rows + '</tr>';
                    subtotal+=parseInt(value.subtotal);
            });
            $('#bodykonteks').html(rows);
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}

//=====================================================================================
function hapusdatakonteks(kode){
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
            $('#panel').loading('toggle');
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: 'DELETE',
                url: '/konteks/'+kode,
                data:{
                    'token':$('input[name=_token]').val(),
                },
                success: function(){
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Data Berhasil Dihapus.',
                        'success'
                    );
                    getdatakonteks();
                    $('#panel').loading('stop');
                }
            })
        }
    })
}