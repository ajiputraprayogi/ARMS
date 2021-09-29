<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelaksanaanmanajemenrisikosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaksanaan_manajemen_risiko', function (Blueprint $table) {
            $table->id();
            $table->string('faktur');
            $table->string('id_departemen');
            $table->string('nama_pemilik_risiko');
            $table->string('jabatan_pemilik_risiko');
            $table->string('nama_koordinator_pemilik_risiko');
            $table->string('jabatan_koordinator_pemilik_risiko');
            $table->string('priode_penerapan');
            $table->integer('selera_risiko');
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
        Schema::dropIfExists('pelaksanaan_manajemen_risiko');
    }
}
