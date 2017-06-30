<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function subbidang()
    {
        return $this->belongsTo('App\Subbidang');
    }
}
