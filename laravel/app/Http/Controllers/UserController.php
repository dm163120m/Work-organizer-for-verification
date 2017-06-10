<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository as UserRepo;
use App\Http\Requests\Auth\EditProfileRequest;
use Session;

class UserController extends Controller{
    private $userRepo;

    public function __construct(UserRepo $userRepo) {
        $this->userRepo = $userRepo;
    }

    private function getUserData(){
        $data = $this->userRepo->getUserData();
        return $data;
    }


    public function editProfile(){
        $data = $this->getUserData();
        return view('user/editprofile')->with('data',$data);
    }

    public function logOut(){
        Session::flush();
        return redirect('login');
    }

    public function editProfilePost(EditProfileRequest $request){
        $this->userRepo->editUser($request);
        return view('user/editprofile')
            ->with('msg', 'You successfully edited your profile!!');
    }

    
}