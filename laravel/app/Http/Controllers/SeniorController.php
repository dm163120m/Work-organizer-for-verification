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

class SeniorController extends Controller
{

    /**
     * @var TaskRepo
     */
    private $taskRepo;
    private $userRepo;
    private $testRepo;

    public function __construct(TaskRepo $taskRepo, TestRepo $testRepo, UserRepo $userRepo)
    {
        $this->taskRepo = $taskRepo;
        $this->userRepo = $userRepo;
        $this->testRepo = $testRepo;
    }

    private function getTasksData($data)
    {
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

    public function tasks()
    {
//        dd($this->taskRepo->getAll());
        $data = $this->userRepo->getUserData();
        if ($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        $selected = 0;
        if (count($data['tasks']) > 0) $selected = $this->taskRepo->getTests(1);
        return view('senior/tasks')->with('data', $data)->with('selected', $selected);
    }

    public function tests()
    {
        $data = $this->userRepo->getUserData();
        if ($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        return view('senior/allTests')->with('data', $data);
    }

    public function createTask()
    {
        $data = $this->userRepo->getUserData();
        if ($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        return view('senior/createTask')->with('data', $data);
    }

    public function getTask($id)
    {
        $data = $this->userRepo->getUserData();
        if ($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        $selected = $this->taskRepo->getTests($id);
//        dd($selected);
        return view('senior/tasks')->with('data', $data)->with('selected', $selected);
    }

    public function getTest($id)
    {
        $data = $this->userRepo->getUserData();
        if ($data == null) return redirect('login');
        $data = $this->getTasksData($data);
        $selected = $this->testRepo->getById($id);
        return view('senior/tests')->with('data', $data)->with('selected', $selected);
    }

    /**
     * Handle a create task request to the application
     *
     * @param  \App\Http\Requests\Task\TaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function createTaskPost(TaskRequest $request)
    {
        $this->taskRepo->create($request);
        return redirect('/senior/tasks');
    }

    public function updateTask(TaskRequest $request)
    {
//        dd($request->all());
        $this->taskRepo->update($request);
        return redirect('/senior/tasks');
    }

    public function createTest()
    {
        $data = $this->userRepo->getUserData();
        $data = $this->getTasksData($data);
        return view('senior/createTest')->with('data', $data);
    }

    /**
     * Handle a create task request to the application
     *
     * @param  \App\Http\Requests\Test\TestRequest $request
     * @return \Illuminate\Http\Response
     */
    public function createTestPost(TestRequest $request)
    {
        //dd($request);
        $this->testRepo->create($request);
        return redirect('/senior/tests');
    }

    public function notifications(){
        $data = $this->userRepo->getUserData();
        $data["notifications"] = Notification::all();
        return view('user/home')->with('data', $data);
    }

    public function getTests(Request $request){
        $inputArray = $request->input('tests_array');
        $tests = $this->testRepo->getInArray($inputArray)->toArray();
        return response()->json(['returnedTests' => $tests]);
//        return $request;
    }

    public function searchTasks(Request $request){
        $data = $this->userRepo->getUserData();
        $data = $this->getTasksData($data);
        $r = $request->all();
        $results = $this->taskRepo->search($r);
        return view('senior/searchTasks')->with('results', $results)->with('data', $data);
    }

    public function searchTests(Request $request)
    {
        $data = $this->getTasksData([]);
        $r = $request->all();
        //dd($r);
        $results = $this->testRepo->search($r);
        //dd($results);

        return view('user/searchTests')->with('results', $results)->with('data', $data);
    }
}