<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resikoteridentifikasi extends Model
{
    protected $table = 'resiko_teridentifikasi';
    protected $fillable = [
        'faktur','pr','kode_risiko','number','full_kode','id_departmen','kode_departemen','departmen_pemilik_resiko','periode_penerapan','id_konteks','id_jenis_konteks','konteks','kode_konteks','pernyataan_risiko','id_kategori','kategori_risiko','uraian_dampak','metode_spip','status_persetujuan','diajukan_oleh','diajukan_tanggal','persetujuan_oleh','tanggal_persetujua','keterangan','besaran_awal','besaran_akhir','status',
    ];
}