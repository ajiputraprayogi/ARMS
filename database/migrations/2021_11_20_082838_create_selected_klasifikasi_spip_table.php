<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectedKlasifikasiSpipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selected_klasifikasi_spip', function (Blueprint $table) {
            $table->id();
            $table->integer('id_klasifikasi_spip');
            $table->integer('id_pengendalian_risiko');
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
        Schema::dropIfExists('selected_klasifikasi_spip');
    }
}
