<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategoriresiko extends Model
{
    protected $table = 'kategori_resiko';
    protected $fillable = [
        'kode','resiko'
    ];
}
