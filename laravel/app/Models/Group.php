<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    public function tests(){
        return $this->hasMany('App\Test', 'group_id', 'id');
    }

}