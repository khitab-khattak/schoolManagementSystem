<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParentsController extends Controller
{
    public function parents_list()
    {

        $data['getparents'] = Parents::getparents(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "parents List";
        return view('backend.parents.list', $data);
    }
    public function create_parents()
    {
        $data['getSchool'] = User::getSchoolAll();
        $data['meta_title'] = "Create parents";
        return view('backend.parents.create', $data);
    }
    public function insert_parents(Request $request)
    {
        // Validate request
        $request->validate(
            [
                'email' => 'required|email|unique:parents',
                'password' => 'required|min:4',
            ],
            [
                'email.unique' => 'This email is already registered. Please try another one.',
            ]
        );

        
        $user = new Parents();
        if(Auth::user()->is_admin==1 || Auth::user()->is_admin==2){
            $user->created_by_id = $request->school_id;
        }
        else{
            $user->created_by_id = Auth::user()->id;
        }
        $user->first_name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->gender = $request->gender;
        $user->occupation = $request->occupation;
        $user->mobile = trim($request->mobile);
        $user->address = trim($request->address);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->status = trim($request->status);

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

        return redirect('panel/parents/list')->with('success', 'parents Created Successfully');
    }




    public function update_parents(Request $request, $id)
    {
        // Validate request
        $request->validate(
            [
                'email' => 'email|unique:parents,email,' . $id,  // Ensure email is unique except for the current user
                'password' => 'nullable|min:4',  // Password is optional for update
            ],
            [
                'email.unique' => 'This email is already registered. Please try another one.',
            ]
        );

        // Get the parents's record
        $user = Parents::findOrFail($id);

        // Update fields with request data
        $user->first_name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->gender = $request->gender;
        $user->occupation = $request->occupation;
        $user->mobile = trim($request->mobile);
        $user->address = trim($request->address);
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

        return redirect('panel/parents/list')->with('success', 'parents Updated Successfully');
    }




    public function edit_parents($id)
    {
        $data['getparents'] = Parents::getSingle($id);
        $data['meta_title'] = "Edit";
        return view('backend.parents.edit', $data);
    }


    public function delete_parents($id)
    {
        $parents = Parents::find($id);

        if (!$parents) {
            return redirect()->back()->with('error', 'parents not found.');
        }

        $parents->delete();

        return redirect()->back()->with('success', 'parents deleted successfully.');
    }
}
