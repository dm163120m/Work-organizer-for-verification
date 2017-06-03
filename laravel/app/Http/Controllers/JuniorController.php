<?php

namespace App\Http\Controllers;
use App\User;
use App\Repositories\TaskRepository as TaskRepo;

class JuniorController extends Controller{

    /**
     * @var TaskRepo
     */
    private $taskRepo;

    public function __construct(TaskRepo $taskRepo) {
        $this->taskRepo = $taskRepo;
    }

    public function home(){
//        dd($this->taskRepo->getAll());
        $data['tasks'] = $this->taskRepo->getAll();
        $username = session('username');
        $user = User::where('username',$username) -> first();
        if($user != null) {
            $attributes = $user->getAttributes();
            $data['firstName'] = $attributes['Name'];
            $data['secondName'] = $attributes['Surname'];
            $data['avatar'] = $attributes['imageUrl'];
        }

        return view('junior/home')->with('data',$data);
    }
}