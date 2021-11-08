<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelaporanPengelolaanRisikoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaporan_pengelolaan_risiko', function (Blueprint $table) {
            $table->id();
            $table->integer('id_periode_pelaporan');
            $table->integer('id_unit_kerja');
            $table->string('status');
            $table->string('file');
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
        Schema::dropIfExists('pelaporan_pengelolaan_risiko');
    }
}
