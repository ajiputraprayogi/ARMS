<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class selectedmetodespip extends Model
{
    protected $table = 'selected_metode_spip';
    protected $guarded = [];

    /**
     * Mendapatkan data departemen.
     */
    public function metode()
    {
        return $this->hasOne(metode::class, 'id', 'id_metode_spip');
    }
}
