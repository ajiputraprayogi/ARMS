const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
    },
    buttonsStyling: true
})

$(function () {
    getdatawhy();
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
                })
            }
        },
        complete: function () {
            $('#panel').loading('stop');
            generatekode();
        }
    });
});

//==================================================================================================
function generatekode() {
    $('#panel').loading('toggle');
    $('#kode_analisis').val('');
    var getkategori = $("#carikat option:selected").text();
    newgetkategori = getkategori.split(" - ");

    var newresiko = $('#cari_risiko').find(':selected').text();
    var newkode = newresiko + '.' + newgetkategori[0];
    $.ajax({
        type: 'GET',
        url: '/analisa-akar-masalah/carikode/' + newkode,
        success: function (data) {
            $('#kode_analisis').val(data);

        },
        complete: function () {
            $('#panel').loading('stop');
        }
    });
}

//=====================================================================================
$('#addakarpenyebab').on('click', function (e) {
    if ($('#akar_penyebab').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formaddwhy').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/analisa-akar-masalah/tambah-why',
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
                    $('#akar_penyebab').val('');
                    $('#modaltambahwhy').modal('hide');
                    $('#panel').loading('stop');
                    getdatawhy();
                }
            });
        });
    }
});

//=====================================================================================
function getdatawhy() {
    $('#panel').loading('toggle');
    $('#bodywhy').html('');
    $.ajax({
        type: 'GET',
        url: '/analisa-akar-masalah/data-why',
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data, function (key, value) {
                no += 1;
                rows = rows + '<tr>';
                rows = rows + '<td>' +no + '</td>';
                rows = rows + '<td>' + value.uraian + '</td>';
                rows = rows + '<td class="text-center"><button type="button" onclick="viewwhy(' + value.id + ')" class="btn m-1 btn-info btn-sm"><i class="ri-eye-line mr-0"></i></button><button type="button" onclick="editwhy(' + value.id + ')" class="btn m-1 btn-success btn-sm"><i class="ri-pencil-line mr-0"></i></button><button type="button" onclick="hapuswhy(' + value.id + ')" class="btn btn-danger btn-sm m-1"><i class="ri-delete-bin-line mr-0"></i></button></td>';
                rows = rows + '</tr>';
            });
            $('#bodywhy').html(rows);
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}

//=====================================================================================
function hapuswhy(kode) {
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
                url: '/analisa-akar-masalah/hapus-why/' + kode,
                data: {
                    'token': $('input[name=_token]').val(),
                },
                success: function () {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Data Berhasil Dihapus.',
                        'success'
                    );
                    getdatawhy();
                    $('#panel').loading('stop');
                }
            })
        }
    })
}

//==================================================================================================
function editwhy(kode) {
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/analisa-akar-masalah/show-why/' + kode,
        success: function (data) {
            $.each(data, function (key, value) {
                $('#kode_why').val(value.id);
                $('#edit_akar_penyebab').val(value.uraian);
                $('#labelmodal').html('Edit Why');
            });
        }, complete: function () {
            $('#editakarpenyebab').show();
            $('#edit_akar_penyebab').attr('readonly', false);
            $('#modaleditwhy').modal('show');
            $('#panel').loading('stop');
        }
    });
}

//==================================================================================================
function viewwhy(kode) {
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/analisa-akar-masalah/show-why/' + kode,
        success: function (data) {
            $.each(data, function (key, value) {
                $('#kode_why').val(value.id);
                $('#edit_akar_penyebab').val(value.uraian);
                $('#labelmodal').html('View Why');
            });
        }, complete: function () {
            $('#editakarpenyebab').hide();
            $('#edit_akar_penyebab').attr('readonly', true);
            $('#modaleditwhy').modal('show');
            $('#panel').loading('stop');
        }
    });
}

//=====================================================================================
$('#editakarpenyebab').on('click', function (e) {
    if ($('#edit_akar_penyebab').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formeditwhy').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/analisa-akar-masalah/update-why',
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
                    $('#edit_akar_penyebab').val('');
                    $('#modaleditwhy').modal('hide');
                    $('#panel').loading('stop');
                    getdatawhy();
                }
            });
        });
    }
});
