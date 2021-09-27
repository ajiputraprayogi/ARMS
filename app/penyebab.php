<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penyebab extends Model
{
    protected $table = 'penyebab';
    protected $fillable = [
        'kode','penyebab'
    ];
}
