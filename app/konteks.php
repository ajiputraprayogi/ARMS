<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class konteks extends Model
{
    protected $table = 'konteks';
    protected $fillable = [
        'kode','nama','id_konteks','detail_ancaman','indikator_kinerja_kegiatan'
    ];
}
