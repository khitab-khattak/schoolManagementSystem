<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\SchoolAdminModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SchoolAdminController extends Controller
{
    public function school_admin_list()
    {
        $data['getschool_admin'] = SchoolAdminModel::getschool_admin(Auth::user()->id,Auth::user()->is_admin);
        $data['meta_title'] = "school_admin List";
        return view('backend.school_admin.list', $data);
    }
    public function create_school_admin()
    {
        $data['getSchool']=User::getSchoolAll();
        return view('backend.school_admin.create',$data);
    }
    public function insert_school_admin(Request $request)
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
        $user->is_admin = 4;
        if(Auth::user()->is_admin==1 || Auth::user()->is_admin==2){
            $user->created_by_id = $request->school_id;
        }
        else{
            $user->created_by_id = Auth::user()->id;
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
        return redirect('panel/school_admin/list')->with('success', 'school_admin Created Successfully');
    }



    public function update_school_admin(Request $request, $id)
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
        return redirect('panel/school_admin/list')->with('success', 'school_admin Updated Successfully');
    }



    public function edit_school_admin($id)
    {
        $data['getschool_admin'] = User::getSingle($id);
        $data['meta_title'] = "Edit";
        return view('backend.school_admin.edit', $data);
    }


    public function delete_school_admin($id)
    {
        // $user = User::getSingle($id);
        // $user->is_delete=1;
        // $user->save();
        $school_admin = User::find($id);

        if (!$school_admin) {
            return redirect()->back()->with('error', 'school_admin not found.');
        }

        $school_admin->delete();

        return redirect()->back()->with('success', 'school_admin deleted successfully.');
    }
}
