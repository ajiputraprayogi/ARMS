$(function(){
    $('#list-data').DataTable({
        order: [[0, "asc"]],
        searching: false, paging: false, info: false,
        ajax: 'data-periodepelaporan',

        columns:[
            {data: 'tanggal_mulai', name: 'tanggal_mulai'},
            {data: 'tanggal_selesai', name: 'tanggal_selesai'},
            {data: 'status', name: 'status'},
            {data: 'nama_periode', name: 'nama_periode'},
            {
                render: function(data, type, row){
                    return '<div class="d-flex align-items-center list-action"><a class="badge badge-info mr-2" data-toggle="modal" data-target="#show'+row['id']+'" title="View" data-original-title="View"><i class="ri-eye-line mr-0"></i></a><a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"href="/periodepelaporan/'+row['id']+'/edit"><i class="ri-pencil-line mr-0"></i></a><a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="hapusdata('+row['id']+')"><i class="ri-delete-bin-line mr-0"></i></a></div>'
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
                url: 'periodepelaporan/'+kode,
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
