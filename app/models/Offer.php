<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected  $table = 'offers';
    protected $fillable = ['photo','name_en','name_ar','price','details'];
}
