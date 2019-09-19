<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    public function type()
    {
        return $this->hasOne('App\AttributeTypes', 'id', 'type_id');
    }

//    public function value()
//    {
//        return $this->hasOne('App\AttributeValues', 'attribute_id', 'id');
//    }

    public function attributeEnd()
    {
        return $this->hasOne('App\AttributeEnding', 'attribute_id', 'id');
    }
}
