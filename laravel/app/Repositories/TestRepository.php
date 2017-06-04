<?php
namespace App\Repositories;
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

    /**
     * @return Test
     */
    public function create($request){
        $newTest = $request->all();
        unset($newTest['_token']);
        $newTest['author'] = session('username');
      //  dd($newTest);
        $test = new Test($newTest);
        $test->save();
        return;
    }
}