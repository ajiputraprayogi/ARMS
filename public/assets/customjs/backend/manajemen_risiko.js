function hapusdatamanajemenrisiko(kode){
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
                 url: '/pelaksanaan/'+kode,
                 data:{
                     'token':$('input[name=_token]').val(),
                 },
                 success: function(){
                     swalWithBootstrapButtons.fire(
                         'Deleted!',
                         'Data Berhasil Dihapus.',
                         'success'
                     )
                     location.reload();
                 }
             })
         }
     })
 }