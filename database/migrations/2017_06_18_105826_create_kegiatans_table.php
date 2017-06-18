<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bidang_id')->unsigned();
            $table->integer('subbidang_id')->unsigned();
            $table->text('kegiatan');
            $table->timestamps();

            $table->foreign('bidang_id')->references('id')->on('bidangs')->onDelete('cascade');
            $table->foreign('subbidang_id')->references('id')->on('subbidangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatans');
    }
}
