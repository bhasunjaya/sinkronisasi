<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kldata extends Model
{
    protected $guarded = ['id'];

    public function kegiatan()
    {
        return $this->belongsTo('App\Kegiatan');
    }

    public function subbidang()
    {

        return $this->belongsTo('App\Subbidang');
    }
    public function sinkronisasi()
    {
        return $this->hasOne('App\Sinkronisasi');
    }
}
