<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengendalianRisikosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengendalian_risiko', function (Blueprint $table) {
            $table->id();
            $table->string('id_manajemen_risiko');
            $table->string('id_risiko');
            $table->string('id_akar_masalah');
            $table->string('kode_tindak_pengendalian');
            $table->string('respons_risiko');
            $table->string('kegiatan_pengendalian');
            $table->string('id_klasifikasi_sub_unsur_spip');
            $table->string('penanggung_jawab');
            $table->string('indikator_keluaran');
            $table->date('target_waktu');
            $table->string('status_pelaksanaan');
            $table->string('id_skor_frekuensi');
            $table->string('id_skor_dampak');
            $table->string('id_peta_besaran_risiko');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengendalian_risiko');
    }
}
