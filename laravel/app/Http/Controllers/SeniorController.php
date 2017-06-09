<?php

namespace App\Http\Controllers;
use App\Http\Requests\Test\TestRequest;
use App\Http\Requests\Task\TaskRequest;
use App\Repositories\TaskRepository as TaskRepo;
use App\Repositories\TestRepository as TestRepo;
use App\Repositories\UserRepository as UserRepo;
use App\Priority;
use App\Status;
use App\Group;
use App\Notification;
use App\Task;
use App\Tasks_Tests;
use Illuminate\Http\Request;

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
        if($username == null) return null;
        $user = $this->userRepo->find($username);
        if ($user != null) {
            $data['firstName'] = $user['Name'];
            $data['secondName'] = $user['Surname'];
            $data['avatar'] = $user['imageUrl'];
            return $data;
        }
        return null;
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

    public function tasks(){
//        dd($this->taskRepo->getAll());
        $data = $this->getUserData();
        if($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        $selected = 0;
        if(count($data['tasks']) > 0) $selected = $this->taskRepo->getTests(1);
//            dd($selected['tests']);
        return view('senior/tasks')->with('data',$data)->with('selected', $selected);
    }

    public function tests(){
        $data = $this->getUserData();
        if($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        return view('senior/tests')->with('data',$data);
    }

    public function createTask(){
        $data = $this->getUserData();
        if($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        return view('senior/createTask')->with('data',$data);
    }

    public function getTask($id){
        $data = $this->getUserData();
        if($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        $selected = $this->taskRepo->getTests($id);
        return view('senior/tasks')->with('data',$data)->with('selected', $selected);
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

    public function updateTask(TaskRequest $request){
//        dd($request);
        $this->taskRepo->update($request);
        return redirect('/senior/tasks');
    }

    public function createTest(){
        $data = $this->getUserData();
        $data['tests'] = $this->testRepo->getAll();
        $data['groups'] = Group::all()->toArray();
        return view('senior/createTest')->with('data',$data);
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
        return redirect('/senior/tests');
    }

    public function notifications(){
        $data = $this->getUserData();
        //dd($data);
        $data["notifications"] = Notification::all();
    }

    public function addTests($task_id){
//        Tasks_Tests::where('task_id', $task_id)
//            ->update(['test_id' => 1]);
    }

//    public function markTests(&$groupTests, $selectedTests){
//        foreach ($groupTests as &$g){
//            foreach ($g['tests'] as &$el){
//                $el['inTask'] = 0;
//                if(checkIfInArray($el , $selectedTests)) $el['inTask'] = 1;
//            }
//        }
//    }

    public function searchTasks(Request $request){
        $data = $request->all();
        $results = $this->taskRepo->search($data);
        dd($results);
    }


}