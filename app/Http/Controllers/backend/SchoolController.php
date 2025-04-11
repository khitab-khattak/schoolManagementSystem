<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    public function school_list()
    {
        $data['getSchool']=User::getSchool();
        return view('backend.school.list',$data);
    }
    public function create_school()
    {
        return view('backend.school.create');
    }
    public function insert(Request $request)
    {
        request()->validate([
            'email'=>'required|email|unique:users'
        ], [
            'email.unique' => 'This email is already registered. Please try another one.',
        ]
    );
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->address = trim($request->address);
        $user->status = trim($request->status);
        $user->is_admin = 3;
        $user->created_by_id = Auth::user()->id;
        $user->save();
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $randomStr = date('YmdHis') . Str::random(20);
            $ext = $file->getClientOriginalExtension(); // Get only the file extension
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename); // Always good to use public_path
        
            $user->profile_pic = $filename;
        }
        

        $user->save(); // Don't forget to save the user to the database
        return redirect('panel/school/list')->with('success','School Created Successfully');
    }
}
