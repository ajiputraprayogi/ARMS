<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemantauanEfektivitasPengendaliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemantauan_efektivitas_pengendalians', function (Blueprint $table) {
            $table->id();
            $table->string('id_manajemen');
            $table->string('id_resiko');
            $table->string('id_pengendalian');
            $table->string('keterangan');
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
        Schema::dropIfExists('pemantauan_efektivitas_pengendalians');
    }
}
