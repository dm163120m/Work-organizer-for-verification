<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model{
    protected $table = 'tasks';

    protected $fillable = ['title', 'description', 'author', 'assignee', 'priority', 'status'];

    public function priority(){
        return $this->hasOne('App\Priority', 'id', 'priority');
    }
    public function status(){
        return $this->hasOne('App\Status', 'id', 'status');
    }
    public function author(){
        return $this->belongsTo('App\User', 'author', 'username');
    }
    public function assignee(){
        return $this->hasOne('App\User', 'username' ,'assignee');
    }

    public function tests(){
        return $this->belongsToMany('App\Test', 'tasks_tests', 'task_id', 'test_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'task_id', 'id');
    }

    public $timestamps = false;
}
