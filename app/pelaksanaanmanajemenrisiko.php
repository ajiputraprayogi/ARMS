<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelaksanaanmanajemenrisiko extends Model
{
    protected $table = 'pelaksanaan_manajemen_risiko';
    protected $fillable = [
        'faktur','id_departemen','nama_pemilik_risiko','jabatan_pemilik_risiko','nama_koordinator_pemilik_risiko','jabatan_koordinator_pemilik_risiko','priode_penerapan','priode_penerapan_awal','priode_penerapan_akhir','selera_risiko'
    ];
}
