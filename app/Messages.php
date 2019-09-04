<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public function scopeActive($query){
        return $query->where('active', 1);
    }
    public function scopeUnread($query){
        return $query->where('status', 1);
    }
    public function type(){
        return $this->hasOne('App\Type', 'id', 'type_id');
    }

}
