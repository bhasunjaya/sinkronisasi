<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemdadata extends Model {
	//
	public function kegiatan() {
		return $this->belongsTo('App\Kegiatan');
	}

	public function subbidang() {

		return $this->belongsTo('App\Subbidang');
	}
}
