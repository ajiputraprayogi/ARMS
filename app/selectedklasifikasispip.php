<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class selectedklasifikasispip extends Model
{
    protected $table = 'selected_klasifikasi_spip';
    protected $guarded = [];

    /**
     * Mendapatkan data departemen.
     */
    public function klasifikasi()
    {
        return $this->hasOne(klasifikasi_sub_unsur_spip::class, 'id', 'id_klasifikasi_spip');
    }
}
