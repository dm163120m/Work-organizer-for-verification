<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model{
    protected $table = 'tasks';

    public function priority(){
        return $this->hasOne('App\Priority', 'id');
    }
    public function status(){
        return $this->hasOne('App\Status', 'id');
    }
    public function author(){
        return $this->belongsTo('App\User', 'author', 'username');
    }
    public function assignee(){
        return $this->hasOne('App\User', 'username' ,'assignee');
    }

}
