<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{

    public function bidang()
    {
        return $this->belongsTo('App\Bidang');
    }

    public function subbidang()
    {
        return $this->belongsTo('App\Subbidang');
    }
}
