<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pencatatanperistiwa extends Model
{
    protected $table = 'pencatatan_peristiwa_resiko';
    protected $fillable = [
        'departemen_id','tahun','resiko_id','pernyataan','uraian','waktu','tempat','kriteria_id','pemicu','penyebab_id'
    ];
}
