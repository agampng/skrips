<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiket_pesanan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_tiket_pesanan');
            $table->string('nama_perwakilan');
            $table->string('email_perwakilan');
            $table->string('museum',50);
            $table->string('kode',6);
            $table->integer('total_harga');
            $table->integer('kuota');
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
        Schema::dropIfExists('tiket_pesanan');
    }
}
