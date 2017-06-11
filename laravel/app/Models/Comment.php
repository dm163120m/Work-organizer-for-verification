<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['username', 'comment', 'task_id'];

    public function task(){
        return $this->belongsTo('App\Task', 'id', 'task_id');
    }

    public function username(){
        return $this->belongsTo('App\User', 'username', 'author');
    }

    public $timestamps = false;
}