<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function task(){
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }

    public function username(){
        return $this->belongsTo('App\User', 'username', 'author');
    }
}