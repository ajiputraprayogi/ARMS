<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tujuanpelaporan extends Model
{
    protected $table = 'tujuanpelaporan';
    protected $guarded = [];

    /**
     * Mendapatkan data departemen.
     */
    public function departemen()
    {
        return $this->hasOne(departemen::class, 'id', 'id_departemen');
    }
}
