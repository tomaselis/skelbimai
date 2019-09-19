<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValues extends Model
{
    public function attribute()
    {
        return $this->hasOne('App\Attributes', 'id','attribute_id');
    }
}
