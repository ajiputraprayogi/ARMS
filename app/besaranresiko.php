<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class besaranresiko extends Model
{
    protected $table = 'besaran_resiko';
        protected $fillable = [
            'id_prob','id_dampak','kode_warna','nilai'
        ];
}
