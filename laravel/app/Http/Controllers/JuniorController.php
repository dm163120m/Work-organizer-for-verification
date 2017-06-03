<?php

namespace App\Http\Controllers;
use App\Priority;
use App\Repositories\TaskRepository as TaskRepo;
use App\Repositories\UserRepository as UserRepo;
use App\Repositories\TestRepository as TestRepo;

class JuniorController extends Controller{

    /**
     * @var TaskRepo
     */
    private $taskRepo;
    private $userRepo;
    private $testRepo;

    public function __construct(TaskRepo $taskRepo, UserRepo $userRepo, TestRepo $testRepo) {
        $this->taskRepo = $taskRepo;
        $this->userRepo = $userRepo;
        $this->testRepo = $testRepo;
    }

    public function home(){
//        dd($this->taskRepo->find('1'));
//        dd(Priority::all()->toArray());
        $data['tasks'] = $this->taskRepo->getAll();
        $username = session('username');
        $user = $this->userRepo->find($username);
        if($user != null) {
            $data['firstName'] = $user['Name'];
            $data['secondName'] = $user['Surname'];
            $data['avatar'] = $user['imageUrl'];
        }

        return view('junior/home')->with('data',$data);
    }
}