<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoleksiMuseumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koleksi_museum', function (Blueprint $table) {
            //
            $table->id();
            $table->string('nama_gambar');
            $table->string('gambar');
            $table->string('museum_id');
            $table->foreign('museum_id')->references('id')->on('museum')->onUpdate('cascade');
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
        Schema::table('koleksi_museum', function (Blueprint $table) {
            //
        });
    }
}
