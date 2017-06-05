<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\UserRepository as UserRepo;
use App\User;

class RegisterController extends Controller{
    private $userRepo;

    public function __construct(UserRepo $userRepo) {
        $this->userRepo = $userRepo;
    }
    public function index(){
        return view('auth/register');
    }

    public function registerPost(RegisterRequest $request){
        $this->userRepo->createUser($request);
        return redirect('login')
            ->with('msg', 'You are successfully registered!');
//            ->withInput($request->only('username'));
    }


}