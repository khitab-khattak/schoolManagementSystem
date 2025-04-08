<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $meta_title = 'Dashboard';
        return view('backend.dashboard',compact('meta_title'));
    }
}
