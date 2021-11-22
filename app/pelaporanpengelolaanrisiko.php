<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelaporanpengelolaanrisiko extends Model
{
    protected $table = 'pelaporan_pengelolaan_risiko';
    // protected $fillable = [
    //     'status','id_unit_kerja','id_periode_pelaporan'
    // ];
    protected $guarded = [];

    /**
     * Mendapatkan data tembusan.
     */
    public function tembusan(){
        return $this->hasMany(tembusan::class, 'id_pelaporan', 'id');
    }

    /**
     * Mendapatkan data tembusan.
     */
    public function tujuanpelaporan(){
        return $this->hasMany(tujuanpelaporan::class, 'id_pelaporan', 'id');
    }

    public function periodepelaporan(){
        return $this->hasOne(periodepelaporan::class, 'id', 'id_periode_pelaporan');
    }

    public function departemen(){
        return $this->hasOne(departemen::class, 'id', 'id_unit_kerja');
    }
}
