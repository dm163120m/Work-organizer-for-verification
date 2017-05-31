<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;

use App\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth/register');
    }
}