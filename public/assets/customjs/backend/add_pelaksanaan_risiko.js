const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
    },
    buttonsStyling: true
})

$(function () {

    //=====================================================================================
    // getdepartemen();
    // $('#cari_departemen').select2({
    //     placeholder: "Pilih Departemen",
    // });
    $('#nama_koordinator_pengelola_risiko').select2({
        placeholder: "Pilih Pengelola",
    });
    $('#cari_departemen').select2({
        placeholder: "Pilih Departemen",
        // ajax: {
        //     url: '/cari_departemen',
        //     dataType: 'json',
        //     delay: 250,
        //     processResults: function (data) {
        //         return {
        //             results: $.map(data.departemen, function (item) {
        //                 return {
        //                     id: item.id,
        //                     text: item.nama
        //                 }

        //             })
        //         }
        //     },
        //     cache: true
        // }
    });

    //=====================================================================================
    getdatakonteks()
    getdatapemangku()
});
// ===================================================================================
// function getdepartemen(){
//     $('#panel').loading('toggle');
//     var url = '/cari_departemen';
//     var newOption = [];
//     $.ajax({
//         type: "GET",
//         dataType: "json",
//         url: url,
//         success: function(data){
//             $.each(data, function(key, value){
//                 var newOption = new Option(value.nama,value.id, false, false);
//                 $('#cari_departemen').append(newOption).trigger('change');
//             });
//         },
//         complete: function(){
//             $('#cari_departemen').val(null).trigger('change');
//             $('#panel').loading('stop');
//         }
//     });
// }
//=====================================================================================
$('#cari_departemen').on('select2:select', function (e) {
    $('#panel').loading('toggle');
    $('#nama_koordinator_pengelola_risiko').empty().trigger("change");
    // $('#id_koordinator').empty().trigger("change");
    var kode = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/cari_departemen_hasil/' + kode,
        success: function (data) {
            $.each(data.departemen, function(key, item){
                $('#id_departemen').val(item.id);
            });
            $.each(data.pengelola, function(key, item){
                var newOption = new Option(item.nama,item.id, false, false);
                $('#nama_koordinator_pengelola_risiko').append(newOption).trigger('change');
            });
        },
        complete: function () {
            $('#nama_koordinator_pengelola_risiko').val(null).trigger('change');
            $('#id_koordinator').val(null).trigger('change');
            $('#panel').loading('stop');
        }
    });
});
// ====================================================================================
$('#nama_koordinator_pengelola_risiko').on('select2:select', function(e){
    $('#panel').loading('toggle');
    var kode = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/cari_departemen_hasil/' + kode,
        success:function(data){
            $.each(data.departemen, function(key, item){
                $('#id_koordinator').val(item.id);
            });
        },
        complete: function(){
            $('#panel').loading('stop');
        }
    })
});
//=====================================================================================
$('#addkonteksbtn').on('click', function (e) {
    if ($('#kode_konteks').val() == '' || $('#nama_konteks').val() == '' || $('#id_jenis_konteks').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
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
                    getdatakonteks();
                }
            });
        });
    }
});

//=====================================================================================
$('#editkonteksbtn').on('click', function (e) {
    if ($('#edit_kode_konteks').val() == '' || $('#edit_nama_konteks').val() == '' || $('#edit_id_jenis_konteks').val() == '' || $('#edit_detail_ancaman_konteks').val() == '' || $('#edit_indikator_kinerja_kegiatan_konteks').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formeditkonteks').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/konteks/'+$('#konteks_id').val(),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    swalWithBootstrapButtons.fire({
                        title: 'Info',
                        text: 'Data Berhasil diperbarui',
                        confirmButtonText: 'OK'
                    });
                }, complete: function () {
                    $('#edit_kode_konteks').val('');
                    $('#edit_nama_konteks').val('');
                    $('#edit_id_jenis_konteks').val('');
                    $('#edit_detail_ancaman_konteks').val('');
                    $('#edit_indikator_kinerja_kegiatan_konteks').val('');
                    $('#edit_konteks').modal('hide');
                    $('#panel').loading('stop');
                    getdatakonteks();
                }
            });
        });
    }
});

//=====================================================================================
function getdatakonteks() {
    $('#panel').loading('toggle');
    var kode = $('#faktur').val();
    $('#bodykonteks').html('');
    $.ajax({
        type: 'GET',
        url: '/cari-data-konteks/' + kode,
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data, function (key, value) {
                no += 1;
                rows = rows + '<tr>';
                rows = rows + '<td>' + value.kode + '</td>';
                rows = rows + '<td>' + value.nama + '</td>';
                rows = rows + '<td>' + value.konteks + '</td>';
                rows = rows + '<td class="text-center"><button type="button" onclick="viewdatakonteks(' + value.id + ')" class="btn m-1 btn-info btn-sm"><i class="ri-eye-line mr-0"></i></button><button type="button" onclick="editdatakonteks(' + value.id + ')" class="btn m-1 btn-success btn-sm"><i class="ri-pencil-line mr-0"></i></button><button type="button" onclick="hapusdatakonteks(' + value.id + ')" class="btn btn-danger btn-sm m-0"><i class="ri-delete-bin-line mr-0"></i></button></td>';
                rows = rows + '</tr>';
            });
            $('#bodykonteks').html(rows);
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}

//=====================================================================================
function getdatapemangku() {
    $('#panel').loading('toggle');
    var kode = $('#faktur').val();
    $('#bodypemangku').html('');
    $.ajax({
        type: 'GET',
        url: '/cari-data-pemangku/' + kode,
        success: function (data) {
            var rows_pemangku = '';
            var no = 0;
            $.each(data, function (key, value) {
                no += 1;
                rows_pemangku = rows_pemangku + '<tr>';
                rows_pemangku = rows_pemangku + '<td class="text-center">' + no + '</td>';
                rows_pemangku = rows_pemangku + '<td>' + value.pemangku_kepentingan + '</td>';
                rows_pemangku = rows_pemangku + '<td>' + value.keterangan + '</td>';
                rows_pemangku = rows_pemangku + '<td>' + value.kelompok_pemangku_kepentingan + '</td>';
                rows_pemangku = rows_pemangku + '<td class="text-center"><button type="button" onclick="viewdatapemangku(' + value.id + ')" class="btn m-1 btn-info btn-sm"><i class="ri-eye-line mr-0"></i></button><button type="button" onclick="editdatapemangku(' + value.id + ')" class="btn m-1 btn-success btn-sm"><i class="ri-pencil-line mr-0"></i></button><button type="button" onclick="hapusdatapemangku(' + value.id + ')" class="btn btn-danger btn-sm m-1"><i class="ri-delete-bin-line mr-0"></i></button></td>';
                rows_pemangku = rows_pemangku + '</tr>';
            });
            $('#bodypemangku').html(rows_pemangku);
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}

//=====================================================================================
function editdatakonteks(kode) {
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/cari-data-konteks/' + kode+'/edit',
        success: function (data) {
            $.each(data, function (key, value) {
                $('#konteks_id').val(value.id);
                $('#edit_kode_konteks').val(value.kode);
                $('#edit_nama_konteks').val(value.nama);
                $('#edit_id_jenis_konteks').val(value.id_konteks);
                $('#edit_detail_ancaman_konteks').val(value.detail_ancaman);
                $('#edit_indikator_kinerja_kegiatan_konteks').val(value.indikator_kinerja_kegiatan);
            });
        }, complete: function () {
            $('#labelkonteks').html('Edit Konteks');
            $('#editkonteksbtn').show();
            $('#edit_kode_konteks').attr('readonly', false);
            $('#edit_nama_konteks').attr('readonly', false);
            $('#edit_id_jenis_konteks').attr('readonly', false);
            $('#edit_detail_ancaman_konteks').attr('readonly', false);
            $('#edit_indikator_kinerja_kegiatan_konteks').attr('readonly', false);
            $('#edit_konteks').modal('show');
            $('#panel').loading('stop');
        }
    });
}

//=====================================================================================
function viewdatakonteks(kode) {
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/cari-data-konteks/' + kode+'/edit',
        success: function (data) {
            $.each(data, function (key, value) {
                $('#konteks_id').val(value.id);
                $('#edit_kode_konteks').val(value.kode);
                $('#edit_nama_konteks').val(value.nama);
                $('#edit_id_jenis_konteks').val(value.id_konteks);
                $('#edit_detail_ancaman_konteks').val(value.detail_ancaman);
                $('#edit_indikator_kinerja_kegiatan_konteks').val(value.indikator_kinerja_kegiatan);
            });
        }, complete: function () {
            $('#labelkonteks').html('View Konteks');
            $('#editkonteksbtn').hide();
            $('#edit_kode_konteks').attr('readonly', true);
            $('#edit_nama_konteks').attr('readonly', true);
            $('#edit_id_jenis_konteks').attr('readonly', true);
            $('#edit_detail_ancaman_konteks').attr('readonly', true);
            $('#edit_indikator_kinerja_kegiatan_konteks').attr('readonly', true);
            $('#edit_konteks').modal('show');
            $('#panel').loading('stop');
        }
    });
}

//=====================================================================================
function editdatapemangku(kode) {
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/cari-data-pemangku/' + kode+'/edit',
        success: function (data) {
            $.each(data, function (key, value) {
                $('#pemangku_id').val(value.id);
                $('#edit_pemangku_kepentingan').val(value.pemangku_kepentingan);
                $('#edit_keterangan').val(value.keterangan);
                $('#edit_kelompok_pemangku_kepentingan').val(value.kelompok_pemangku_kepentingan);
                $('#labelpemangku').html('Edit Pemangku Kepentingan');
            });
        }, complete: function () {
            $('#editpemangkubtn').show();
            $('#edit_pemangku_kepentingan').attr('readonly', false);
            $('#edit_keterangan').attr('readonly', false);
            $('#edit_kelompok_pemangku_kepentingan').attr('readonly', false);
            $('#edit_pemangku').modal('show');
            $('#panel').loading('stop');
        }
    });
}

//=====================================================================================
function viewdatapemangku(kode) {
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/cari-data-pemangku/' + kode+'/edit',
        success: function (data) {
            $.each(data, function (key, value) {
                $('#pemangku_id').val(value.id);
                $('#edit_pemangku_kepentingan').val(value.pemangku_kepentingan);
                $('#edit_keterangan').val(value.keterangan);
                $('#edit_kelompok_pemangku_kepentingan').val(value.kelompok_pemangku_kepentingan);
                $('#labelpemangku').html('View Pemangku Kepentingan');
            });
        }, complete: function () {
            $('#editpemangkubtn').hide();
            $('#edit_pemangku_kepentingan').attr('readonly', true);
            $('#edit_keterangan').attr('readonly', true);
            $('#edit_kelompok_pemangku_kepentingan').attr('readonly', true);
            $('#edit_pemangku').modal('show');
            $('#panel').loading('stop');
        }
    });
}

//=====================================================================================
function hapusdatakonteks(kode) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger',
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
    }).then((result) => {
        if (result.value) {
            $('#panel').loading('toggle');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: 'DELETE',
                url: '/konteks/' + kode,
                data: {
                    'token': $('input[name=_token]').val(),
                },
                success: function () {
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

//=====================================================================================
function hapusdatapemangku(kode) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger',
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
    }).then((result) => {
        if (result.value) {
            $('#panel').loading('toggle');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: 'DELETE',
                url: '/pemangkukepentingan/' + kode,
                data: {
                    'token': $('input[name=_token]').val(),
                },
                success: function () {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Data Berhasil Dihapus.',
                        'success'
                    );
                    getdatapemangku();
                    $('#panel').loading('stop');
                }
            })
        }
    })
}

//=====================================================================================
$('#addpemangkubtn').on('click', function (e) {
    if ($('#pemangku_kepentingan').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Detail tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#addpemangku').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/pemangkukepentingan',
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
                    $('#pemangku_kepentingan').val('');
                    $('#keterangan').val('');
                    $('#kelompok_pemangku_kepentingan').val('');
                    $('#pemangku').modal('hide');
                    $('#panel').loading('stop');
                    getdatapemangku()
                }
            });
        });
    }
});

//=====================================================================================
$('#editpemangkubtn').on('click', function (e) {
    if ($('#edit_pemangku_kepentingan').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#editpemangku').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/pemangkukepentingan/'+$('#pemangku_id').val(),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    swalWithBootstrapButtons.fire({
                        title: 'Info',
                        text: 'Data Berhasil diperbarui',
                        confirmButtonText: 'OK'
                    });
                }, complete: function () {
                    $('#pemangku_id').val('');
                    $('#edit_pemangku_kepentingan').val('');
                    $('#edit_keterangan').val('');
                    $('#edit_pemangku').modal('hide');
                    $('#panel').loading('stop');
                    getdatapemangku();
                }
            });
        });
    }
});
