<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';

    public function group_id(){
        return $this->hasOne('App\Group', 'id', 'group_id');
    }
    public function author(){
        return $this->belongsTo('App\User', 'author', 'username');
    }
}
