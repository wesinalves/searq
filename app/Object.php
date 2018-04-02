<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object extends Model
{
    //
    public function collection(){
    	return $this->belongsTo('App\Collection');
    }
}
