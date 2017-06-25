<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemdadatasTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('pemdadatas', function (Blueprint $table) {
			$table->increments('id');

			$table->string('pemda_id');
			$table->string('bidang_id');
			$table->string('subbidang_id');
			$table->string('kegiatan_id');
			$table->enum('jenis', ['reguler', 'penugasan', 'afirmasi']);
			$table->decimal('volume', 12, 2)->default(0);
			$table->string('satuan')->nullable();
			$table->string('unit_cost')->nullable();
			$table->text('target')->nullable();
			$table->text('lokasi')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('pemdadatas');
	}
}
