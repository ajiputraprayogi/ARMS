<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pemangku_kepentingan extends Model
{
    protected $table = 'pemangku_kepentingan';
    protected $fillable = [
        'pemangku_kepentingan','keterangan'
    ];
}
