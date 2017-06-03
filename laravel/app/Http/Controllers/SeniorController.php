<?php

namespace App\Http\Controllers;
use App\Http\Requests\Task\TaskRequest;
use App\Repositories\TaskRepository as TaskRepo;
use App\Repositories\TestRepository as TestRepo;
use App\Repositories\UserRepository as UserRepo;
use App\Priority;
use App\Status;
use App\Group;

class SeniorController extends Controller{

    /**
     * @var TaskRepo
     */
    private $taskRepo;
    private $userRepo;
    private $testRepo;

    public function __construct(TaskRepo $taskRepo, TestRepo $testRepo, UserRepo $userRepo) {
        $this->taskRepo = $taskRepo;
        $this->userRepo = $userRepo;
        $this->testRepo = $testRepo;
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

    public function tasks(){
//        dd($this->taskRepo->getAll());
        $data = $this->getUserData();
        $data['tasks'] = $this->taskRepo->getAll();
        $data['juniors'] = $this->userRepo->getJuniors();
        $data['priorities'] = Priority::all()->toArray();
        $data['statuses'] = Status::all()->toArray();

        return view('senior/tasks')->with('data',$data);
    }

    public function tests(){
        $data = $this->getUserData();
//        dd($this->taskRepo->getAll());
        $data['tasks'] = $this->taskRepo->getAll();
        $data['juniors'] = $this->userRepo->getJuniors();
        $data['groups'] = Group::all()->toArray();
        $data['groupsTests'] = Group::with('tests')->get()->toArray();
        return view('senior/tasks')->with('data',$data);
    }

    public function createTask(){
        $data = $this->getUserData();
        $data['tasks'] = $this->taskRepo->getAll();
        $data['juniors'] = $this->userRepo->getJuniors();
        $data['groups'] = Group::all()->toArray();
        $data['priorities'] = Priority::all()->toArray();
        $data['statuses'] = Status::all()->toArray();
        return view('senior/createTask')->with('data',$data);
    }

    /**
     * Handle a create task request to the application
     *
     * @param  \App\Http\Requests\Task\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function createTaskPost(TaskRequest $request){
        $this->taskRepo->create($request);
        return redirect('/senior/tasks');
    }
}