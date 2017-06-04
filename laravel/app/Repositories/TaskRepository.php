<?php
namespace App\Repositories;
use App\Task;

class TaskRepository{
    protected $model;

    public function __construct(Task $model){
        $this->model = $model;
    }

    public function getAll(){
        $all = Task::with('priority', 'status', 'author', 'assignee')->get();
        return $all->toArray();
    }

    public function getMyTasks($username){
        return Task::where('assignee', '=', $username)->with('priority', 'status', 'author', 'assignee')->get()->toArray();
    }

    public function find($id){
        return Task::where('id',$id)->with('priority', 'status', 'author', 'assignee')->first()->getAttributes();
    }

    /**
     * @return Task
     */
    public function create($request){
        $newTask = $request->all();
        unset($newTask['_token']);
        $newTask['author'] = session('username');
        $task = new Task($newTask);
        $task->save();
        return;
    }

}