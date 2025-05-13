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
        // Try logging in as teacher
        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('teacher/dashboard');
        }
    
        // Try logging in as student
        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('student/dashboard');
        }
    
        // Try logging in as parent
        if (Auth::guard('parent')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('parent/dashboard');
        }
    
        // Default login (web guard)
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('panel/dashboard');
        }
    
        return redirect()->back()->with('error', 'Please enter correct email and password');
    }
    
    
    public function forgot(){
        return view ('auth.forgot');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
