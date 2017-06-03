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
}