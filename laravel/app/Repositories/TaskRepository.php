<?php
/**
 * Milica Djordjevic 2016/3120
 * Dragana Spasic 2016/3256
 */
namespace App\Repositories;
use App\Report;		   
use App\Comment;
use App\Task;
use App\Tasks_Tests;

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
        return Task::where('assignee', '=', $username)->with('priority', 'status', 'author', 'assignee', 'tests', 'comments')->get()->toArray();
    }

    public function find($id){
        return Task::where('id',$id)->with('priority', 'status', 'author', 'assignee')->first();
    }

    public function getTests($id){
        return Task::where('id', '=', $id)->with('priority', 'status', 'author', 'assignee', 'tests', 'comments')->first()->toArray();
    }

    public function search($data){
        $conditions = [];
        if($data['task_id'] != null AND $data['task_id'] != "") $conditions[] = ['id', '=', $data['task_id']];
        if($data['title'] != null AND $data['title'] != "") $conditions[] = ['title' , 'LIKE', '%'.$data['title'].'%'];
        if(array_key_exists ('assignee', $data)  AND $data['assignee'] != "") $conditions[] = ['assignee' , '=', $data['assignee']];
        if(array_key_exists ('author', $data) AND $data['author'] != "") $conditions[] = ['author' , '=', $data['author']];
        $query = Task::where($conditions);
        if(array_key_exists ('priority', $data)){
            $query->whereIn('priority', $data['priority']);
        }
        if(array_key_exists ('status', $data)){
            $query->whereIn('status', $data['status']);
        }
        return $query->get()->toArray();
    }

    /**
     * @return Task
     */
    public function create($request){
        $newTask = $request->all();
        $testsToAdd = $newTask['addedTests'];
        unset($newTask['addedTests']);
        unset($newTask['_token']);
        $newTask['author'] = session('username');
        $task = new Task($newTask);
        $task->save();
        if(array_key_exists ('comment', $newTask)) {
            $comment = new Comment();
            $comment->username = session('username');
            $comment->comment = $newTask['comment'];
            $task->comments()->save($comment);
        }

        foreach ($testsToAdd as $test) {
            if (!$task->tests->contains($test)) {
                $task->tests()->attach($test, ['test_id' => $test]);
            }
        }
        $task->push();
        return;
    }

    /**
     * @return Task
     */
    public function update($request){
        $editedTask = $request->all();
        $task = Task::find($editedTask["id"]);
        $task->author = session('username');
        $task->title = $editedTask["title"];
        $task->description = $editedTask["description"];
        $task->status = $editedTask["status"];
        $task->priority = $editedTask["priority"];
        $task->assignee = $editedTask["assignee"];
        if((array_key_exists ('comment', $editedTask))&&($editedTask['comment']== '')) {
            $comment = new Comment();
            $comment->username = session('username');
            $comment->comment = $editedTask['comment'];
            $task->comments()->save($comment);
        }

        foreach ($editedTask['addedTests'] as $test) {
            if (!$task->tests->contains($test)) {
                $task->tests()->attach($test, ['test_id' => $test]);
            }
        }
        $task->push();
        return;
    }

    public function updateByJunior($request){
        $editedTask = $request->all();
        $task = Task::find($editedTask["id"]);
        $task->status = $editedTask["status"];
        if(array_key_exists ('comment', $editedTask)) {
            $comment = new Comment();
            $comment->username = session('username');
            $comment->comment = $editedTask['comment'];
            $task->comments()->save($comment);
        }
        $task->push();
        return;
    }

}