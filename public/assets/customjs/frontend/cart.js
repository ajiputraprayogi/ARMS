$(function(){
    $('#list-data').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "asc"]],
        ajax: 'data-produk',

        columns:[
            // {data: 'gambar_produk', name: 'gambar_produk'},
            {   
                 render: function(data, type, row, meta){
                    // return '<div class="d-flex align-items-center"><img src="/img/produk/'+ row.gambar_produk +'" class="img-fluid rounded avatar-50 mr-3" alt="image"><div>'+ row.nama_produk +'<p class="mb-0"><small>'+ row.deskripsi_produk +'</small></p></div></div>'
                    return '<td class="product-thumbnail"><img src="/img/produk/'+ row.gambar_produk +'" alt="Image" class="img-fluid"></td>'
                },
                // data: 'gambar_produk', render: function(data, type, row, meta){
                //     return ''
                // }
            },
            {
                // data: 'nama_produk', name: 'nama_produk'
                render: function(data, type, row, meta){
                    return '<td class="product-name"><h2 class="h5 text-black">'+ row.nama_produk +'</h2></td>'
                },
                 
            },
            {data: 'harga_produk', name: 'harga_produk'},
            {
                render: function(data, type, row, meta){
                    return '<td><div class="input-group mb-3" style="max-width: 120px;"><div class="input-group-prepend"><button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button></div><input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1"><div class="input-group-append"><button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button></div></div></td>'
                },
            },
            {data: 'harga_produk', name: 'harga_produk'},
            {
                render: function(data, type, row){
                    // return '<button class="btn btn-danger" onclick="hapusdata('+row['id']+')"><i class="fa fa-trash"></i></button> <a href="/client/'+row['id']+'/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>'
                    return '<div class="d-flex align-items-center list-action"><a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"href="/produk/'+row['id']+'/edit"><i class="ri-pencil-line mr-0"></i></a><a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="hapusdata('+row['id']+')"><i class="ri-delete-bin-line mr-0"></i></a></div>'
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