<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawdatas', function (Blueprint $table) {
            $table->increments('id');
            //KODE PEMDA    NAMA KABUPATEN  JENIS   KODE BIDANG BIDANG  SUB BIDANG
            //KEGIATAN    KODE PROYEK PROYEK  SATUAN  OUTPUT  LOKASI PROYEK   USULAN DANA PROYEK (JUTA RUPIAH)
            $table->char('kode', 4);
            $table->string('nama');
            $table->string('jenis');
            $table->integer('kode_bidang')->unsigned();
            $table->string('bidang');
            $table->string('subbidang');
            $table->text('kegiatan');
            $table->string('kode_proyek');
            $table->text('proyek');
            $table->string('satuan');
            $table->string('output');
            $table->text('lokasi');
            $table->decimal('dana', 12, 2);
            $table->boolean('is_proses')->default(false);
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
        Schema::dropIfExists('rawdatas');
    }
}
