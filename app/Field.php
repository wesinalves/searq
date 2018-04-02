<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //
    public function collections()
    {
        return $this->belongsToMany('App\Collection');
    }
}
