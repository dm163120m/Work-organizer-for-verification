<?php
namespace App\Repositories;
use App\Task;

class TaskRepository{
    protected $model;

    public function __construct(Task $model){
        $this->model = $model;
    }

    public function getAll(){
        $all = $this->model->all();
        return $all->toArray();
    }
}