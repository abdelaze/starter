<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected  $table = 'doctors';
    protected $fillable = ['name','title','hospital_id','medical_id','gender'];
    protected $hidden = ['created_at','updated_at','pivot'];
    //public $timestamps = false;
    public function hospital() {
        return $this->belongsTo('App\models\Hospital','hospital_id','id');
    }
    public function services() {
         return $this->belongsToMany('App\models\Service','doctor_service','doctor_id','service_id','id','id');
    }

    //accessor
    public function getGenderAttribute($val) {
         return $val == 1 ? 'male' : 'female';
    }
}
