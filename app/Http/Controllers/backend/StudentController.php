<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User; // Import the User model

class StudentController extends Controller

{


    public function myAccount()
{
    $user = Auth::guard('student')->user();
    if (!$user) {
        return redirect()->back()->with('error', 'Unauthorized access.');
    }

    $data['meta_title'] = "My Account";
    $data['getRecordAll'] = Student::getSingle($user->id);
    return view('backend.profileChange.studentProfile', $data);
}
  
    


public function UpdateAccount(Request $request, $id)
{
    // Make sure the logged-in student is the one updating their account
    $authStudent = Auth::guard('student')->user();
    if (!$authStudent || $authStudent->id != $id) {
        return redirect()->back()->with('error', 'Unauthorized access.');
    }

    $user = Student::find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user->name = trim($request->name);
    $user->last_name = trim($request->last_name);

    // Handle profile pic upload if present
    if ($request->hasFile('profile_pic')) {
        $file = $request->file('profile_pic');
        $randomStr = date('YmdHis') . Str::random(20);
        $ext = $file->getClientOriginalExtension();
        $filename = strtolower($randomStr) . '.' . $ext;
        $file->move(public_path('upload/profile/'), $filename);
        $user->profile_pic = $filename;
    }

    // Save changes once
    $user->save();

    return redirect()->back()->with('success', 'Account Updated Successfully');
}


    
    





    public function student_list(Request $request)
    {

        $data['getstudent'] = Student::getstudent(Auth::user()->id,Auth::user()->is_admin);
        $data['meta_title'] = "student List";
        return view('backend.student.list', $data);
    }
    public function getClass(Request $request)
    {
        $getClass = ClassModel::getclassActive($request->school_id);
    
        $html = '<option value="">Select</option>';
        $message = '';
    
        if ($getClass->isEmpty()) {
            $html .= '<option value="">No class available</option>';
            $message = 'No class found in this school.';
        } else {
            foreach ($getClass as $class) {
                $html .= '<option value="'.$class->id.'">'.$class->name.'</option>';
            }
        }
    
        return response()->json([
            'success' => $html,
            'message' => $message
        ]);
    }
    
    public function create_student()
    {
        $data['getClass'] = ClassModel::getClassActive(Auth::user()->id);
        $data['getSchool']=User::getSchoolAll();
        $data['meta_title'] = "Create student";
        return view('backend.student.create', $data);
    }
    public function insert_student(Request $request)
    {
        // Validate request
        $request->validate(
            [
                'email' => 'required|email|unique:students',
                'admission_number' => 'required|unique:students', // Add unique validation for admission_number
                'password' => 'required|min:4',
            ],
            [
                'email.unique' => 'This email is already registered. Please try another one.',
                'admission_number.unique' => 'This admission number is already taken. Please try another one.', // Custom error message for admission_number
            ]
        );
        
        $student = new Student();
        if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) {
            $student->created_by_id = $request->school_id;
        } else {
            $student->created_by_id = Auth::user()->id;
        }
        
        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;
        $student->class_id = $request->class_id != "Select" ? $request->class_id : null;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->caste = $request->caste;
        $student->religion = $request->religion;
        $student->mobile_number = $request->mobile_number;
        $student->admission_date = $request->admission_date;
        $student->blood_group = $request->blood_group;
        $student->height = $request->height;
        $student->weight = $request->weight;
        $student->current_address = $request->current_address;
        $student->permanent_address = $request->permanent_address;
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->status = trim($request->status);
        $student->is_admin = 6;
        
        // Handle profile image
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $randomStr = date('YmdHis') . Str::random(20);
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);
            $student->profile_pic = $filename;
        }
        
        // Save the student
        $student->save();
        
        return redirect('panel/student/list')->with('success', 'Student Created Successfully');
    }
    




    public function update_student(Request $request, $id)
    {
        // Validate request
        $request->validate(
            [
                'email' => 'email|unique:students,email,' . $id, // Check for email uniqueness, excluding current student
                'admission_number' => 'required|unique:students,admission_number,' . $id, // Ensure admission_number is unique, excluding current student
                'password' => 'nullable|min:4',
            ],
            [
                'email.unique' => 'This email is already registered. Please try another one.',
                'admission_number.unique' => 'This admission number is already taken. Please try another one.', // Custom error message for admission_number
            ]
        );
        
        // Find student
        $student = Student::findOrFail($id);
        
        // Update fields
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;
        $student->class_id = $request->class_id;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->caste = $request->caste;
        $student->religion = $request->religion;
        $student->mobile_number = trim($request->mobile_number);
        $student->admission_date = $request->admission_date;
        $student->blood_group = $request->blood_group;
        $student->height = $request->height;
        $student->weight = $request->weight;
        $student->current_address = trim($request->current_address);
        $student->permanent_address = trim($request->permanent_address);
        $student->email = trim($request->email);
        $student->status = trim($request->status);
        
        // Update password only if provided
        if (!empty($request->password)) {
            $student->password = Hash::make($request->password);
        }
        
        // Profile image
        if ($request->hasFile('profile_pic')) {
            // Delete old profile image if exists
            if ($student->profile_pic && file_exists(public_path('upload/profile/' . $student->profile_pic))) {
                unlink(public_path('upload/profile/' . $student->profile_pic));
            }
        
            $file = $request->file('profile_pic');
            $randomStr = date('YmdHis') . Str::random(20);
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);
            $student->profile_pic = $filename;
        }
        
        // Save changes
        $student->save();
        
        return redirect('panel/student/list')->with('success', 'Student updated successfully');
    }
    
    
//working ai

    // public function edit_student($id)
    // {
    //     $student = Student::getSingle($id);
    
    //     // If student was created by admin or school
    //     $school_id = $student->created_by_id;
    
    //     // Get classes for the student's school
    //     $getClass = ClassModel::getClassActive($school_id);
    
    //     $data = [
    //         'getstudent' => $student,
    //         'getClass' => $getClass,
    //         'getSchool' => User::getSchoolAll(),
    //         'selectedSchoolId' => $school_id,
    //         'meta_title' => "Edit Student",
    //     ];
    
    //     return view('backend.student.edit', $data);
    // }
    

    public function edit_student($id)
    {
        $getstudent = Student::getSingle($id);
    
        $data['getstudent'] = $getstudent;
        $data['getClass'] = ClassModel::getClassActive($getstudent->created_by_id);
        $data['getSchool'] = User::getSchoolAll();
        $data['meta_title'] = "Edit";
    
        return view('backend.student.edit', $data);
    }
    


    public function delete_student($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect()->back()->with('error', 'student not found.');
        }

        $student->delete();

        return redirect()->back()->with('success', 'student deleted successfully.');
    }



    public function ChangePassword(){
        $data['meta_title']='Change Student Password';
        return view('backend/passwordChange/student_change_password',$data);
    }
   
    
    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5|confirmed', // requires new_password_confirmation
        ]);
    
        // Get the currently authenticated user (teacher)
        $user = Student::find(Auth::guard('student')->id());
    
        // Check if the user exists
        if (!$user) {
            return back()->with('error', 'Unauthorized access.');
        }
    
        // Check current password
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }
    
        // Update to new password
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        return back()->with('success', 'Password updated successfully.');
    }
    
}
