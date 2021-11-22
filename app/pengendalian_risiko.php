<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengendalian_risiko extends Model
{
    protected $table = 'pengendalian_risiko';
    // protected $fillable = [
    //     'faktur','detail_respons_risiko','id_manajemen','id_departemen','id_risiko','id_akar_masalah','kode_tindak_pengendalian','respons_risiko','kegiatan_pengendalian','id_klasifikasi_sub_unsur_spip','penanggung_jawab','indikator_keluaran','target_waktu','status_pelaksanaan','id_peta_besaran_risiko','target_durasi',
    // ];
    protected $guarded = [];
}
