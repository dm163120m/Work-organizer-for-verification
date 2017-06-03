<?php

namespace App\Http\Controllers;
use App\Repositories\TaskRepository as TaskRepo;
use App\Repositories\UserRepository as UserRepo;

class SeniorController extends Controller{

    /**
     * @var TaskRepo
     */
    private $taskRepo;
    private $userRepo;

    public function __construct(TaskRepo $taskRepo, UserRepo $userRepo) {
        $this->taskRepo = $taskRepo;
        $this->userRepo = $userRepo;
    }

    public function createTask(){
//        dd($this->taskRepo->getAll());
        $data['tasks'] = $this->taskRepo->getAll();
        $data['juniors'] = $this->userRepo->getJuniors();
//        dd($data['juniors']);
        $username = session('username');
        $user = $this->userRepo->find($username);
        if($user != null) {
            $data['firstName'] = $user['Name'];
            $data['secondName'] = $user['Surname'];
            $data['avatar'] = $user['imageUrl'];
        }

        return view('senior/createtask')->with('data',$data);
    }
}