<?php
namespace App\Repositories;
use App\User;

class UserRepository {
    protected $model;

    public function __construct(User $model){
        $this->model = $model;
    }
    
    public function getUserData(){
        $username = session('username');
        if($username == null) return null;
        $user = User::where('username',$username)->first()->getAttributes();
        if ($user != null) {
            $data['firstName'] = $user['Name'];
            $data['secondName'] = $user['Surname'];
            $data['avatar'] = $user['imageUrl'];
            $data['role'] = $user['role'];
            $data['email'] = $user['email'];
            return $data;
        }
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

    public function search($data){
        //dd($data);
        $conditions = [];
        //dd($user);
        if ($data['name'] != null AND $data['name'] != "") $conditions[] = ['Name', 'LIKE', '%' . $data['name'] . '%'];
		if (array_key_exists('role', $data)) $conditions[] = ['role', '=', $data['role']];
        //dd($conditions);
        $res = User::where($conditions)->get()->toArray();
        //dd($res);
        return $res;
    }

    public function updateUser($request){
        $username = session('username');
        $user = User::where('username',$username)->first();
        $newUserData = $request->all();
        $user->email = $newUserData['email'];
        //$user->password = $newUserData['password'];
        //$user->imageUrl = $newUserData['imageUrl'];
        $user->save();
        return;
    }

    public function reject($reqUsername){
        $user = User::where('username',$reqUsername)->first();
        $user->approved = -1;
        $user->save();
        return;
    }

    public function approve($reqUsername){
        $user = User::where('username',$reqUsername)->first();
        $user->approved = 1;
        $user->save();
        return;
    }

}