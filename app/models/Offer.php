<?php

namespace App\models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Offer extends Model
{
    protected  $table = 'offers';
    protected $fillable = ['photo','name_en','name_ar','price','details','status'];
    //local scope
    public function scopeInactive($query) {
        return $query->where('status',0);
    }
    //global scope

    protected static function booted()
    {
        static::addGlobalScope(new OfferScope);
    }

    //if you want to make anonymous globalscope in model
//    protected static function booted()
//    {
//        static::addGlobalScope('status', function (Builder $builder) {
//            $builder->where('status', 0);
//        });
//    }

   // accessors
    public function setNameEnAttribute($val) {
        $this->attributes['name_en'] = strtoupper($val);
    }
}
