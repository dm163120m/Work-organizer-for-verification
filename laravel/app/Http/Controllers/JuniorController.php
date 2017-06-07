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

    public function notifications() {
        $data = $this->getUserData();
        $data["notifications"] = Notification::all();
        //dd($data);
        //$data['firstName'] = $user['Name'];
        //$data['secondName'] = $user['Surname'];
        //dd($data);
        return view('junior/home')->with('data',$data);
    }

    public function tasks(){
//        dd($this->taskRepo->getAll());
        $data = $this->getUserData();
        $data['tasks'] = $this->taskRepo->getAll();
        $data['juniors'] = $this->userRepo->getJuniors();
        $data['priorities'] = Priority::all()->toArray();
        $data['statuses'] = Status::all()->toArray();

        $selected = 0;
        if(count($data['tasks']) > 0) $selected = $this->taskRepo->getTests(1);
        return view('junior/tasks')->with('data',$data)->with('selected', $selected);
    }

    public function getTask($id){
        $data = $this->getUserData();
        $data['tasks'] = $this->taskRepo->getAll();
        $data['juniors'] = $this->userRepo->getJuniors();
        $data['priorities'] = Priority::all()->toArray();
        $data['statuses'] = Status::all()->toArray();

        $selected = $this->taskRepo->getTests($id);

//        dd($selected);
//        $post = Task::find($id);
//        $post->tests()->attach($image_ids);
        return view('junior/tasks')->with('data',$data)->with('selected', $selected);
    }

    public function tests(){
        $data = $this->getUserData();
//        dd($this->taskRepo->getAll());
        $data['tasks'] = $this->taskRepo->getAll();
        $data['juniors'] = $this->userRepo->getJuniors();
        $data['groups'] = Group::all()->toArray();
        $data['groupsTests'] = Group::with('tests')->get()->toArray();
        $data['tests'] = $this->testRepo->getAll();
        return view('junior/tests')->with('data',$data);
    }

    public function createTest(){
        $data = $this->getUserData();
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