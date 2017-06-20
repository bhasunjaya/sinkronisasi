<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    public function subbidangs()
    {
        return $this->hasMany('App\Subbidang');
    }
}
