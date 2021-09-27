<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class metode extends Model
{
    protected $table = 'metode_pencapaian_tujuan';
    protected $fillable = [
        'metode'
    ];
}
