<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected  $table =  'countries';
    protected $fillable = ['name'];
    public $timestamps = false;

//has many through
    public function doctors(){
        return $this -> hasManyThrough('App\models\Doctor','App\models\Hospital','country_id','hospital_id','id','id');
    }
}
