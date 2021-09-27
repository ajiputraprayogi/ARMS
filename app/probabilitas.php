<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class probabilitas extends Model
{
    protected $table = 'kriteria_probabilitas';
    protected $fillable = [
        'nilai','nama','uraian'
    ];
}
