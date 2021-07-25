<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuseumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museum', function (Blueprint $table) {
            //
            $table->string('id',50)->primary();
            $table->string('gambar');
            $table->integer('kuota');
            $table->text('link_google_map');
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
        Schema::table('museum', function (Blueprint $table) {
            //
        });
    }
}
