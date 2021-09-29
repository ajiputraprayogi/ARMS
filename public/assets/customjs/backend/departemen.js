$(function(){
    $('#list-data').DataTable({
        order: [[0, "asc"]],
        searching: false, paging: false, info: false,
        ajax: 'data-departemen',

        columns:[
            // {data: 'gambar_produk', name: 'gambar_produk'},
            {data: 'kode', name: 'kode'},
            {data: 'nama', name: 'nama'},
            {
                render: function(data, type, row){
                    // return '<button class="btn btn-danger" onclick="hapusdata('+row['id']+')"><i class="fa fa-trash"></i></button> <a href="/client/'+row['id']+'/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>'
                    return '<div class="d-flex align-items-center list-action"><a class="badge badge-info mr-2" data-toggle="modal" data-target="#show'+row['id']+'" title="View" data-original-title="View"><i class="ri-eye-line mr-0"></i></a><a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"href="/departemen/'+row['id']+'/edit"><i class="ri-pencil-line mr-0"></i></a><a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="hapusdata('+row['id']+')"><i class="ri-delete-bin-line mr-0"></i></a></div>'
                },
                "className": "text-center",
                "orderable": false,
                "data": null,
            },
        ],
        pageLength: 10,
        lengthMenu: [[5, 10, 20], [5, 10, 20]]
    })
})
function hapusdata(kode){
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
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: 'DELETE',
                url: 'departemen/'+kode,
                data:{
                    'token':$('input[name=_token]').val(),
                },
                success: function(){
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Data Berhasil Dihapus.',
                        'success'
                    )
                    $('#list-data').DataTable().ajax.reload();
                }
            })
        }
    })
}
$('#cari_departemen').select2({
    ajax:{
        url:'/cari_departemen',
        dataType:'json',
        delay:250,
        processResults: function (data){
            return {
                results : $.map(data, function (item){
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
$('#cari_departemen').on('select2:select',function(e){
    var kode = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/cari_departemen_hasil/'+kode,
        success:function (data){
        return {
            results : $.map(data, function (item){
                $('#id_departemen').val(item.id);
            })
        }
    },
    });
});