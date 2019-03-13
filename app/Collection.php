<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    //
    use SoftDeletes;

     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $dates = ['deleted_at'];


    public function types()
    {
        return $this->belongsToMany('App\Type');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function locales()
    {
        return $this->belongsToMany('App\Local');
    }

    public function dimensions()
    {
        return $this->hasMany('App\Dimension');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    public function objects()
    {
        return $this->hasMany('App\Object');
    }

    public function collections()
    {
        return $this->hasMany('App\Collection');
    }

    public function collection()
    {
        return $this->belongsTo('App\Collection');
    }

    public function producers()
    {
        return $this->belongsToMany('App\Producer');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject');
    }

    public function idioms()
    {
        return $this->belongsToMany('App\Idiom');
    }
}
