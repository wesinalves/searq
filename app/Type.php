<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
   public function collections()
    {
        return $this->belongsToMany('App\Collection');
    }
}
