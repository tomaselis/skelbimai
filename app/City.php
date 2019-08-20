<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function adverts(){
        return $this->hasMany('App\advert', 'city_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
