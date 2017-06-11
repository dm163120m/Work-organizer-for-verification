<?php
namespace App\Repositories;
use App\Report;
use App\Test;

class TestRepository{
    protected $model;

    public function __construct(Test $model){
        $this->model = $model;
    }

    public function getAll(){
        $all = Test::with('group_id', 'author', 'reports')->get();
        return $all->toArray();
    }

    public function find($id){
        return Test::where('id',$id) -> first()->getAttributes();
    }

    public function getInArray($array){
        return Test::whereIn('id', $array)->get();
    }

    public function getById($id){
        return Test::where('id', '=', $id)->with('reports', 'author')->first()->toArray();
    }

    public function search($data){
        $conditions = [];
        if($data['test_id'] != null AND $data['test_id'] != "") $conditions[] = ['id', '=', $data['test_id']];
        if($data['title'] != null AND $data['title'] != "") $conditions[] = ['title' , 'LIKE', '%'.$data['title'].'%'];
        if(array_key_exists ('author', $data)) $conditions[] = ['author' , '=', $data['author']];
        if(array_key_exists ('group_id', $data)) $conditions[] = ['group_id' , '=', $data['group_id']];
        if($data['path'] != null AND $data['path'] != "") $conditions[] = ['path' , 'LIKE', '%'.$data['path'].'%'];

//        $tests = Test::with('Reports')->where($conditions)->whereHas('Reports', function($q){
//            $q->where('status', '0');
//        })->get();

        $res = Test::where($conditions)->with('reports')->get()->toArray();
        if(array_key_exists ('status', $data)){
            foreach ($res as $key => $test){
                $last_report = end($test['reports']);
                if($last_report['status'] != $data['status']) unset($res[$key]);
            }
        }
        return $res;
    }

    /**
     * @return Test
     */
    public function create($request){
        $newTest = $request->all();
        unset($newTest['_token']);
        $newTest['author'] = session('username');
        $newTest['created'] = date('Y-m-d H:i:s');
        $test = new Test($newTest);
        $test->save();
        return;
    }

    /**
     * @return Test
     */
    public function addReports($arrayTests, $report){
        $reportM = new Report($report);
//        $reportM->latest_change = $report['latest_change'];
//        $reportM->latest_run = $report['latest_run'];
//        $reportM->count = $report['count'];
//        $reportM->seed = $report['seed'];
//        $reportM->fail_description = $report['fail_description'];
        $reportM->save();
        foreach ($arrayTests as $test_id) {
            $test = Test::find($test_id);
            $test->reports()->attach($reportM->id, ['id_report' => $reportM->id]);
            $test->push();
        }
//        $test = Test::find($editedTask["id"]);
//        $task->author = session('username');
//        $task->title = $editedTask["title"];
//        $task->description = $editedTask["description"];
//        $task->status = $editedTask["status"];
//        $task->priority = $editedTask["priority"];
//        $task->assignee = $editedTask["assignee"];
//        if(array_key_exists ('comment', $editedTask)) {
//            $comment = new Comment();
//            $comment->username = session('username');
//            $comment->comment = $editedTask['comment'];
//            $task->comments()->save($comment);
//        }
//
//        foreach ($editedTask['addedTests'] as $test) {
//            if (!$task->tests->contains($test)) {
//                $task->tests()->attach($test, ['test_id' => $test]);
//            }
//        }
    }
}