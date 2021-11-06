<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departemen extends Model
{
    protected $table = 'departemen';
    protected $fillable = [
        'kode','nama','id_atasan','id_bawahan'
    ];
}
