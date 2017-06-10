<?php

namespace App\Http\Controllers;
use App\Priority;
use App\Http\Requests\Test\TestRequest;
use App\Http\Requests\Task\TaskRequest;
use App\Repositories\TaskRepository as TaskRepo;
use App\Repositories\UserRepository as UserRepo;
use App\Repositories\TestRepository as TestRepo;
use App\Notification;
use App\Status;
use App\Group;

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

    private function getTasksData($data){
        $data['tasks'] = $this->taskRepo->getAll();
        $data['juniors'] = $this->userRepo->getJuniors();
        $data['seniors'] = $this->userRepo->getSeniors();
        $data['priorities'] = Priority::all()->toArray();
        $data['statuses'] = Status::all()->toArray();
        $data['groupsTests'] = Group::with('tests')->get()->toArray();
        $data['groups'] = Group::all()->toArray();
        $data['tests'] = $this->testRepo->getAll();
        return $data;
    }

    public function home(){
//        dd($this->taskRepo->find('1'));
//        dd(Priority::all()->toArray());
        $data['tasks'] = $this->taskRepo->getAll();
        $data = $this->userRepo->getUserData();

        return view('junior/home')->with('data',$data);
    }

    public function notifications() {
        $data = $this->userRepo->getUserData();
        $data["notifications"] = Notification::all();
        //dd($data);
        //$data['firstName'] = $user['Name'];
        //$data['secondName'] = $user['Surname'];
        //dd($data);
        return view('user/home')->with('data',$data);
    }

    public function tasks(){
//        dd($this->taskRepo->getAll());
        $data = $this->userRepo->getUserData();
        if($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        $selected = 0;
        if(count($data['tasks']) > 0) $selected = $this->taskRepo->getTests(1);
        return view('junior/tasks')->with('data',$data)->with('selected', $selected);
    }

    public function getTask($id){
        $data = $this->userRepo->getUserData();
        if($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        $selected = $this->taskRepo->getTests($id);
        return view('junior/tasks')->with('data',$data)->with('selected', $selected);
    }

    public function tests(){
        $data = $this->userRepo->getUserData();
//        dd($this->taskRepo->getAll());
        $data = $this->getTasksData($data);

        //dd($data);
        return view('senior/tests')->with('data',$data);
    }

    public function createTest(){
        $data = $this->userRepo->getUserData();
        $data['tests'] = $this->testRepo->getAll();
        $data['groups'] = Group::all()->toArray();
        return view('junior/createTest')->with('data',$data);
    }

    /**
     * Handle a create task request to the application
     *
     * @param  \App\Http\Requests\Test\TestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function createTestPost(TestRequest $request){
        //dd($request);
        $this->testRepo->create($request);
        return redirect('/junior/tests');
    }

}