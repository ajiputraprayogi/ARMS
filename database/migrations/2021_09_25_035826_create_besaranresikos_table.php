<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBesaranresikosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('besaran_resiko', function (Blueprint $table) {
            $table->id();
            $table->string('probabilitas');
            $table->string('dampak');
            $table->integer('nilai');
            $table->string('kode_warna');
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
        Schema::dropIfExists('besaran_resiko');
    }
}
