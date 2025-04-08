<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(){
       
        return view ('auth.login');
    }
    public function auth_login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],true)){
            return redirect('panel/dashboard');
        }
        else{
            return redirect()->back()->with('error','Please enter conrrrect email and password');
        }
    }
    public function forgot(){
        return view ('auth.forgot');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
