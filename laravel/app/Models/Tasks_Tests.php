<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks_Tests extends Model
{
    protected $table = 'tasks_tests';

    public function tests(){
        return $this->belongsTo('App\Test', 'id', 'test_id');
    }

    public function tasks(){
        return $this->belongsTo('App\Task', 'id', 'task_id');
    }
}