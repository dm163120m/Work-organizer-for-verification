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

    public function getSeniors(){
        return User::where('role','senior')->get()->toArray();
    }

    public function createUser($request){
        $userForCreation = $request->all();
        unset($userForCreation['_token']);
        $userForCreation['approved'] = 0;
        $user = new User($userForCreation);
        $user->save();
        return;
    }

}