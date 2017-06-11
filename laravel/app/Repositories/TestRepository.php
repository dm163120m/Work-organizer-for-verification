<?php
namespace App\Repositories;
use App\Group;
use App\Test;

class TestRepository{
    protected $model;

    public function __construct(Test $model){
        $this->model = $model;
    }

    public function getAll(){
        $all = Test::with('group_id', 'author')->get();
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
        if(array_key_exists ('author', $data) AND $data['author'] != "") $conditions[] = ['author' , '=', $data['author']];
        if(array_key_exists ('group', $data) AND $data['group'] != "") $conditions[] = ['group' , '=', $data['group']];
        if($data['path'] != null AND $data['path'] != "") $conditions[] = ['path' , 'LIKE', '%'.$data['path'].'%'];
        if(array_key_exists ('statuses', $data) AND $data['statuses'] != "") $conditions[] = ['statuses' , '=', $data['statuses']];
        $query = Test::where($conditions);
        //dd($conditions);
        return $query->get()->toArray();
    }

    /**
     * @return Test
     */
    public function create($request){
        $newTest = $request->all();
        unset($newTest['_token']);
        $newTest['author'] = session('username');
        $test = new Test($newTest);
        $test->save();
        return;
    }
}