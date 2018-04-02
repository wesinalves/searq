<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    //
     protected $table = 'locales';

    public function collections()
    {
        return $this->belongsToMany('App\Collection');
    }
}
