$(function(){
    $('#list-data-pemangku').DataTable({
        order: [[0, "asc"]],
        searching: false, paging: false, info: false,
        ajax: '/data-pemangkukepentingan',

        columns:[
            {
                data: 'id', render: function(data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            // {data: 'gambar_produk', name: 'gambar_produk'},
            {data: 'pemangku_kepentingan', name: 'pemangku_kepentingan'},
            {data: 'keterangan', name: 'keterangan'},
            {
                render: function(data, type, row){
                    // return '<button class="btn btn-danger" onclick="hapusdata('+row['id']+')"><i class="fa fa-trash"></i></button> <a href="/client/'+row['id']+'/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>'
                    // return '<div class="d-flex align-items-center list-action"><a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"href="/produk/'+row['id']+'/edit"><i class="ri-pencil-line mr-0"></i></a><a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="hapusdata('+row['id']+')"><i class="ri-delete-bin-line mr-0"></i></a></div>'
                    return '<div class="d-flex align-items-center list-action"></div>'
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
                url: 'produk/'+kode,
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