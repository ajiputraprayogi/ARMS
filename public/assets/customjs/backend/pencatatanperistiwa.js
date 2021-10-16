
$(function() {
    $(".select").select2();
    $('#cari_departemen_manajemen').change(function(){
        var depID = $(this).val();
        if(depID){
            $.ajax({
            type:"GET",
            url:"/cari_pencatatan_manajemen?depID="+depID,
            success:function(res){
                $("#cari_resiko").empty().trigger("change") ;
                $("#priode_penerapan").empty();
                $("#pernyataan_risiko").empty();
                $("#cari_resiko").append('<option>---Pilih Risiko---</option>');
                $.each(res,function(key, item){
                    $('#cari_risiko').append('<option value="'+item.full_kode+'">'+item.full_kode+'</option>');
                    $('#priode_penerapan').val(item.periode_penerapan);
                    $('#pernyataan_risiko').val(item.pernyataan_risiko);
                    $('#uraian').val(item.uraian_dampak);

                });
            }
            });
        }else{
            $("#cari_resiko").empty();
            $("#priode_penerapan").empty();
            $("#pernyataan_risiko").empty();
        }
    });
})
