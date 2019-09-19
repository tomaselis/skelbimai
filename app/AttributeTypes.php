<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeTypes extends Model
{
    public function attribute()
    {
        return $this->hasOne('App\Attributes', 'type_id', 'id');
    }
}
