<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function adverts(){
        return $this->hasMany('App\Advert', 'category_id', 'id');
    }

    public function subCategory(){
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }

    public function subCategories(){
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }
    public function parent(){
        return $this->belongsTo('\App\Category', 'parent_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
