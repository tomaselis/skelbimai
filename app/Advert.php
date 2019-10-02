<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    public function category(){
    return $this->hasOne('App\Category', 'id', 'category_id');
    }


    public function imageGalery(){
        return $this->hasMany('App\ImageGalery', 'advert_id', 'id');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function attributeSet()
    {
        return $this->hasOne('App\AttributeSet','id', 'attribute_set_id');
    }
}
