<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(){
       
        return view ('auth.login');
    }
    public function forgot(){
        return view ('auth.forgot');
    }
}
