<?php
namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index()
    {
        return view('auth/login');
    }

    /**
     * Handle a login request to the application
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function loginPost(LoginRequest $request)
    {
        $username = $request->input('username');
        $password= $request->input('password');

        $user = User::where('username',$username) -> first();

        if($user != null){
            $attributes = $user->getAttributes();
            if($attributes['password'] == $password){
                $request->session()->put('username', $attributes['username']);
                if($attributes['role'] == 'junior') return redirect('/junior');
                else  if($attributes['role'] == 'senior') return redirect('/senior/createtask');
                else return redirect('/admin');
            }
        }

        return redirect('login')
            ->with('msg', 'The username or password is incorrect. Verify that CAPS LOCK is not on, and then retype the current username and password.')
            ->withInput($request->only('username'));
    }
}