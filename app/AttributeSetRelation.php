<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeSetRelation extends Model
{
    public function attributes()
    {
        return $this->hasOne('App\Attributes', 'id', 'attribute_id');
    }
}
