<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jeniskonteks extends Model
{
    protected $table = 'jenis_konteks';
    protected $fillable = [
        'konteks'
    ];
}
