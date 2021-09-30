<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resikoteridentifikasi extends Model
{
    protected $table = 'resiko_teridentifikasi';
    protected $fillable = [
        'pr','kode_risiko','id_departmen','kode_departemen','departmen_pemilik_resiko','periode_penerapan','id_konteks','konteks','kode_konteks','pernyataan_risiko','kategori_risiko','uraian_dampak','metode_spip','status_persetujuan','diajukan_oleh','diajukan_tanggal','persetujuan_oleh','tanggal_persetujua','ketrangan','besaran_awan','besaran_akhir','status',
    ];
}