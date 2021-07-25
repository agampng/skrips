<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('hari_pertama');
            $table->string('hari_terakhir');
            $table->string('jam_buka');
            $table->string('jam_tutup');
            $table->string('museum',50);
            $table->foreign('museum')->references('id')->on('museum')->onDelete('cascade')->onUpdate('cascade');;
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
        Schema::dropIfExists('daftar_jadwal');
    }
}
