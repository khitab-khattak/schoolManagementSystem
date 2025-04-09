<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function school_list(){
        
        return view('backend.school.list');
    }
    public function create_school(){
        return view('backend.school.create');
    }
}
