<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class analisarisiko extends Model
{
    protected $table = 'analisa_risiko';
    protected $fillable = [
        'nama','kode_risiko','besaran_risiko_melekat', 'besaran_risiko_residu'
    ];
}
