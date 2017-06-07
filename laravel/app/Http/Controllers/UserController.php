<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository as UserRepo;


class UserController extends Controller{
    private $userRepo;

    public function __construct(UserRepo $userRepo) {
        $this->userRepo = $userRepo;
    }

    private function getUserData(){
        $username = session('username');
        $user = $this->userRepo->find($username);
        if ($user != null) {
            $data['firstName'] = $user['Name'];
            $data['secondName'] = $user['Surname'];
            $data['avatar'] = $user['imageUrl'];
        }
        return $data;
    }


    public function editProfile(){
        $data = $this->getUserData();
        return view('user/editprofile')->with('data',$data);
    }

    public function notifications() {
        $data = $this->getUserData();
        $data["notifications"] = Notification::all();

        //$data['firstName'] = $user['Name'];
        //$data['secondName'] = $user['Surname'];
        //dd($data);
        return view('senior/home')->with('data',$data);
    }

    
}