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
    public function auth_login(Request $request)
    {
        // Logout all guards first
        Auth::guard('web')->logout();
        Auth::guard('teacher')->logout();
        Auth::guard('student')->logout();
        Auth::guard('parent')->logout();
    
        // Now attempt login
        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('teacher/dashboard');
        }
    
        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('student/dashboard');
        }
    
        if (Auth::guard('parent')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('parent/dashboard');
        }
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('panel/dashboard');
        }
    
        // If login attempt fails, redirect to login page with error message
        return redirect('/login')->with('error', 'Please enter correct email and password');
    }
    
    
    
    
    public function forgot(){
        return view ('auth.forgot');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');  // This will ensure they go to /login
    }    
}
