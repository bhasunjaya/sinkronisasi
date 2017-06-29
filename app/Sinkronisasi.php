<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinkronisasi extends Model
{
    protected $guarded = [];

    public function kegiatan()
    {
        return $this->belongsTo('App\Kegiatan');
    }

    public function subbidang()
    {

        return $this->belongsTo('App\Subbidang');
    }

    public function Kldata()
    {
        return $this->hasOne('App\Kldata');
    }
    public function pemdadata()
    {
        return $this->hasOne('App\Pemdadata');
    }
}
