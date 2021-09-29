<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class analisaakar extends Model
{
    protected $table = 'analisa_masalah';
    protected $fillable = [
        'nama','kode_risiko','kategori_penyebab', 'akar_masalah'
    ];
}
