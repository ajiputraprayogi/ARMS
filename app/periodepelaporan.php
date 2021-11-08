<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class periodepelaporan extends Model
{
    protected $table = 'periode_pelaporans';
    protected $fillable = [
        'tanggal_mulai', 'tanggal_selesai', 'status', 'nama_periode'
    ];
}
