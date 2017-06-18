<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pemda_id')->unsigned();
            $table->integer('kegiatan_id')->unsigned();
            $table->enum('jenis', ['reguler', 'penugasan', 'afirmasi']);
            $table->text('kegiatan')->nullable();
            $table->integer('volume')->unsigned()->nullable();
            $table->string('satuan')->nullable();
            $table->text('lokasi')->nullable();
            $table->decimal('dana', 12, 2);
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
        Schema::dropIfExists('usulans');
    }
}
