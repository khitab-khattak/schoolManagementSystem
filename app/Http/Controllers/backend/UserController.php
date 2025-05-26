<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function MyAccount(){
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        $data['meta_title']="My Account";
        $data['getRecordAll'] = User::getSingle(Auth::user()->id);
        return view ('backend/profileChange/profile',$data);
    }

    public function UpdateAccount(Request $request, $id)
    {
      
        $user = User::getSingle($id);
    
        // Basic validation
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
       
    
        $user->name = trim($request->name);

    
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $randomStr = date('YmdHis') . Str::random(20);
            $ext = $file->getClientOriginalExtension(); // Get only the file extension
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename); // Always good to use public_path

            $user->profile_pic = $filename;
        }


        $user->save(); 
    
        return redirect()->back()->with('success', 'Account Updated Successfully');
    }
    
   

    public function ChangePassword(){
        $data['meta_title']='Change Password';
        return view('backend/PasswordChange/change_password',$data);
    }
 
    
    public function UpdatePassword(Request $request)
{
    // Validate the input with custom messages
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:5|confirmed', // Requires new_password_confirmation
    ], [
        'new_password.confirmed' => 'The password confirmation does not match.', // Custom message
    ]);

    // Detect which guard is currently logged in
    if (Auth::guard('web')->check()) {
        $guard = 'web';
        $user = User::find(Auth::guard('web')->id());
    } else {
        return back()->with('error', 'Unauthorized access.');
    }

    // Check if the current password matches
    if (!Hash::check($request->old_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect.');
    }

    // Check if the new password and confirmation match manually
    if ($request->new_password !== $request->new_password_confirmation) {
        return back()->with('error', 'The password confirmation does not match.');
    }

    // Update the password to the new one
    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password updated successfully.');
}

        

      
}
