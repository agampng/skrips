<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaMuseumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_museum', function (Blueprint $table) {
            $table->id();
            $table->string('nama_agenda');
            $table->string('museum_id');
            $table->string('nama_gambar');
            $table->string('deskripsi_agenda');
            $table->text('isi_agenda');
            $table->date('tanggal_mulai_agenda');
            $table->date('tanggal_berakhir_agenda');
            $table->foreign('museum_id')->references('id')->on('museum')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('agenda_museum');
    }
}
