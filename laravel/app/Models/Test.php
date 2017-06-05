<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';
    protected $fillable = ['title', 'author', 'group_id', 'path', 'description'];

    public function group_id(){
        return $this->hasOne('App\Group', 'id', 'group_id');
    }
    public function author(){
        return $this->belongsTo('App\User', 'author', 'username');
    }

    public function tasks(){
        return $this->belongsToMany('App\Test', 'tasks_tests', 'test_id', 'test_id');
    }
    public $timestamps = false;
}
