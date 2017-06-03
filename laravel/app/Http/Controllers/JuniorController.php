<?php

namespace App\Http\Controllers;
use App\User;

class JuniorController extends Controller
{
    public function home()
    {
        $username = session('username');
        $user = User::where('username',$username) -> first();
        if($user != null){
            $attributes = $user->getAttributes();
            $first = $attributes['Name'];
            $second = $attributes['Surname'];
            $avatar = $attributes['imageUrl'];
        }
        return view('junior/home')->with('firstName',$first)->with('secondName',$second)->with('avatar',$avatar);
    }
}