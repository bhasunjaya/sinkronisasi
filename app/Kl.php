<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kl extends Model
{
    public function bidangs()
    {
        return $this->hasMany('App\Bidang');
    }
}
