<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    //
    public function collection(){
    	return $this->belongsTo('App\Collection');
    }
}
