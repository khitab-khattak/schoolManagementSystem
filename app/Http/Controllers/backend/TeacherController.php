<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeacherModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function teacher_list()
    {
        $data['getteacher'] = TeacherModel::getteacher(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "Teacher List";
        return view('backend.teacher.list', $data);
    }
    public function create_teacher()
    {
        return view('backend.teacher.create');
    }
    public function insert_teacher(Request $request)
{
   
    // Validate request
    $request->validate(
        [
            'email' => 'required|email|unique:teachers',
            'password' => 'required|min:4',
        ],
        [
            'email.unique' => 'This email is already registered. Please try another one.',
        ]
    );

    $user = new TeacherModel;
    $user->name = trim($request->name);
    $user->last_name = trim($request->last_name);
    $user->gender = $request->gender;
    $user->dob = $request->dob;
    $user->doj = $request->doj;
    $user->mobile = trim($request->mobile);
    $user->marital_status = trim($request->marital_status);
    $user->current_address = trim($request->current_address);
    $user->permanent_address = trim($request->permanent_address);
    $user->qualification = trim($request->qualification);
    $user->work_experience = trim($request->work_experience);
    $user->note = trim($request->note);
    $user->email = trim($request->email);
    $user->password = Hash::make($request->password);
    $user->status = trim($request->status);
    $user->is_admin =5;
    $user->created_by_id = Auth::user()->id;

    // Handle profile image
    if ($request->hasFile('profile_pic')) {
        $file = $request->file('profile_pic');
        $randomStr = date('YmdHis') . Str::random(20);
        $ext = $file->getClientOriginalExtension();
        $filename = strtolower($randomStr) . '.' . $ext;
        $file->move(public_path('upload/profile/'), $filename);
        $user->profile_pic = $filename;
    }

    // Save the user
    $user->save();

    return redirect('panel/teacher/list')->with('success', 'Teacher Created Successfully');
}




public function update_teacher(Request $request, $id)
{
    // Validate request
    $request->validate(
        [
            'email' => 'email|unique:teachers,email,' . $id,  // Ensure email is unique except for the current user
            'password' => 'nullable|min:4',  // Password is optional for update
        ],
        [
            'email.unique' => 'This email is already registered. Please try another one.',
        ]
    );

    // Get the teacher's record
    $user = TeacherModel::findOrFail($id);

    // Update fields with request data
    $user->name = trim($request->name);
    $user->last_name = trim($request->last_name);
    $user->gender = $request->gender;
    $user->dob = $request->dob;
    $user->doj = $request->doj;
    $user->mobile = trim($request->mobile);
    $user->marital_status = trim($request->marital_status);
    $user->current_address = trim($request->current_address);
    $user->permanent_address = trim($request->permanent_address);
    $user->qualification = trim($request->qualification);
    $user->work_experience = trim($request->work_experience);
    $user->note = trim($request->note);
    $user->email = trim($request->email);
    
    // Update password only if provided
    if (!empty($request->password)) {
        $user->password = Hash::make($request->password);
    }

    $user->status = trim($request->status);

    // Handle profile image upload if present
    if ($request->hasFile('profile_pic')) {
        // Delete old profile image if it exists
        if ($user->profile_pic && file_exists(public_path('upload/profile/' . $user->profile_pic))) {
            unlink(public_path('upload/profile/' . $user->profile_pic)); // Remove old file
        }

        // Handle new image upload
        $file = $request->file('profile_pic');
        $randomStr = date('YmdHis') . Str::random(20);
        $ext = $file->getClientOriginalExtension();
        $filename = strtolower($randomStr) . '.' . $ext;
        $file->move(public_path('upload/profile/'), $filename);

        // Update profile pic in the database
        $user->profile_pic = $filename;
    }

    // Save the updated user data
    $user->save();

    return redirect('panel/teacher/list')->with('success', 'Teacher Updated Successfully');
}




    public function edit_teacher($id)
    {
        $data['getteacher'] = TeacherModel::getSingle($id);
        $data['meta_title'] = "Edit";
        return view('backend.teacher.edit', $data);
    }


    public function delete_teacher($id)
    {
        $teacher = TeacherModel::find($id);

        if (!$teacher) {
            return redirect()->back()->with('error', 'teacher not found.');
        }

        $teacher->delete();

        return redirect()->back()->with('success', 'teacher deleted successfully.');
    }
}
