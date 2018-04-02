<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	//
	protected $fillable = ['name','type', 'description'];

    public function collection(){
    	return $this->belongsTo('App\Collection');
    }
}
