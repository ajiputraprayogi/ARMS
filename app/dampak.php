<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dampak extends Model
{
    protected $table = 'kriteria_dampak';
    protected $fillable = [
        'nilai','nama','uraian'
    ];
}
