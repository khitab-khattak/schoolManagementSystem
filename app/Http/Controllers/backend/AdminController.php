<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function admin_list()
    {
        $data['getadmin'] = User::getadmin();
        $data['meta_title'] = "admin List";
        return view('backend.admin.list', $data);
    }
    public function create_admin()
    {
        return view('backend.admin.create');
    }
    public function insert_admin(Request $request)
    {
        request()->validate(
            [
                'email' => 'required|email|unique:users'
            ],
            [
                'email.unique' => 'This email is already registered. Please try another one.',
            ]
        );
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->address = trim($request->address);
        $user->status = trim($request->status);
        $user->is_admin = trim($request->is_admin);
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
        return redirect('panel/admin/list')->with('success', 'admin Created Successfully');
    }



    public function update_admin(Request $request, $id)
    {
        $request->validate(
            [
                'email' => 'email|unique:users,email,' . $id
            ],
            [
                'email.unique' => 'This email is already registered. Please try another one.'
            ]
        );
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->address = trim($request->address);
        $user->status = trim($request->status);
        if ($request->has('is_admin')) {
            $user->is_admin = trim($request->is_admin);
        }
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
        return redirect('panel/admin/list')->with('success', 'admin Updated Successfully');
    }



    public function edit_admin($id)
    {
        $data['getadmin'] = User::getSingle($id);
        $data['meta_title'] = "Edit";
        return view('backend.admin.edit', $data);
    }


    public function delete_admin($id)
    {
        $admin = User::find($id);

        if (!$admin) {
            return redirect()->back()->with('error', 'admin not found.');
        }

        $admin->delete();

        return redirect()->back()->with('success', 'admin deleted successfully.');
    }
}
