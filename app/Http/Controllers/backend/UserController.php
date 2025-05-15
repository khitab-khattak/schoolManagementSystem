<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
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
