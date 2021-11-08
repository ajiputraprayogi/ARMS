<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tembusan extends Model
{
    protected $table = 'tembusan';
    protected $guarded = [];

    /**
     * Mendapatkan data departemen.
     */
    public function departemen()
    {
        return $this->hasOne(departemen::class, 'id', 'id_departemen');
    }
}
