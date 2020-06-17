<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected  $table = 'hospitals';
    protected $fillable = ['hospital_name','address'];
    protected $hidden = ['created_at','updated_at'];
    //public $timestamps = false;
    public function doctors() {
         return $this->hasMany('App\models\Doctor','hospital_id','id');
    }
}
