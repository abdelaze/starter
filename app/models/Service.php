<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected  $table = 'services';
    protected $fillable = ['name'];
    protected $hidden = ['created_at','updated_at','pivot'];
    public function doctors() {
        return $this->belongsToMany('App\models\Doctor','doctor_service','service_id','doctor_id','id','id');
    }
}
