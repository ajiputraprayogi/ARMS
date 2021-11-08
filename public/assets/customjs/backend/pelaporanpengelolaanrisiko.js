$(function(){
    $('#list-data').DataTable({
        order: [[0, "asc"]],
        searching: false, paging: false, info: false,
        ajax: 'data-pelaporanpengelolaanrisiko',

        columns:[
            {data: 'periodepelaporan.nama_periode', name: 'periode_pelaporan'},
            {data: 'departemen.nama', name: 'unit_kerja'},
            {data: 'status', name: 'status', className: 'text-capitalize'},
            {
                render: function(data){
                    return '<a href="/pelaporan/' + data + '">' + data + '</a>';
                },
                data: 'file'
            },
            {data: 'tembusan[, ].departemen.nama', name: 'tembusan'},
            {
                render: function(data, type, row){
                    return '<div class="d-flex align-items-center list-action"><a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="hapusdata('+row['id']+')"><i class="ri-delete-bin-line mr-0"></i></a></div>'
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
                url: 'pelaporan-pengelolaan-risiko/'+kode,
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
