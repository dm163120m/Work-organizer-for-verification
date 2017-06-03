<?php
namespace App\Repositories;
use App\User;

class UserRepository {
    protected $model;

    public function __construct(User $model){
        $this->model = $model;
    }

    public function getAll(){
        return User::with('tasks')->get()->toArray();
    }

    public function find($username){
        return User::where('username',$username)->first()->getAttributes();
    }

    public function getJuniors(){
        return User::where('role','junior')->get()->toArray();
    }

}