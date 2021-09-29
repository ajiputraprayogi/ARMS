<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resikoteridentifikasi extends Model
{
    protected $table = 'resiko_teridentifikasi';
    protected $fillable = [
        'nama','kode_risiko'
    ];
}