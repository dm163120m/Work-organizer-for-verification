<?php namespace App\Http\Controllers;
/**
 * Milica Djordjevic 2016/3120
 * Dragana Spasic 2016/3256
 */
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AdminController extends Controller {

    /**
     * The UserRepository instance.
     *
     * @var App\UserRepository
     */
    protected $user_gestion;

    /**
     * Create a new AdminController instance.
     *
     * @param  App\Repositories\UserRepository $user_gestion
     * @return void
     */
    public function __construct(UserRepository $user_gestion){
		$this->user_gestion = $user_gestion;

    }

	public function requests()
	{
		$data = $this->user_gestion->getUserData();
		$data['users'] = $this->user_gestion->getAll();
		return view('admin/requests')->with('data',$data);
	}
	public function users()
	{
		$data = $this->user_gestion->getUserData();
		$data['users'] = $this->user_gestion->getAll();
		return view('admin/users')->with('data',$data);
	}

    public function searchUsers(Request $request){
//        $data["users"] =  $this->user_gestion->getAll();
        //dd($request->all());
        $results = $this->user_gestion->search($request->all());
        //dd($results);
        $data = $this->user_gestion->getUserData();
        $data['results']= $results;
        return view('admin/searchUsers')->with('results', $results)->with('data', $data);
	}

	public function rejectUser($username){
		$this->user_gestion->reject($username);
		$data = $this->user_gestion->getUserData();
		$data['users'] = $this->user_gestion->getAll();
		return redirect('admin/requests')->with($data);
	}

	public function approveUser($username){
		$this->user_gestion->approve($username);
		$data = $this->user_gestion->getUserData();
		$data['users'] = $this->user_gestion->getAll();
		return redirect('admin/requests')->with($data);
	}

	public function deleteUser($username){
		$this->user_gestion->reject($username);
		$data = $this->user_gestion->getUserData();
		$data['users'] = $this->user_gestion->getAll();
		return redirect('admin/users')->with($data);
	}

	public function invertAct($username){
		$this->user_gestion->invertActivation($username);
		$data = $this->user_gestion->getUserData();
		$data['users'] = $this->user_gestion->getAll();
		return redirect('admin/users')->with($data);
	}

}
