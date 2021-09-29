<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonteksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konteks', function (Blueprint $table) {
            $table->id();
            $table->string('faktur_konteks');
            $table->string('kode');
            $table->string('nama');
            $table->string('jenis');
            $table->text('detail_ancaman');
            $table->text('indikator_kinerja_kegiatan');
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
        Schema::dropIfExists('konteks');
    }
}
