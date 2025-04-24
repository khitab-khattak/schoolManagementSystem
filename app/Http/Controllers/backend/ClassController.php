<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\class;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function class_list()
    {
        $data['getclass'] = ClassModel::getclass(Auth::user()->id,Auth::user()->is_admin);
        $data['meta_title'] = "class List";
        return view('backend.class.list', $data);
    }
    public function create_class()
    {
        return view('backend.class.create');
    }
    public function insert_class(Request $request)
    {
        $class = new ClassModel;
        $class->name = trim($request->name);
        $class->status = trim($request->status);
        $class->created_by_id = Auth::user()->id;
        $class->save();
        return redirect('panel/class/list')->with('success', 'class Created Successfully');
    }



    public function update_class(Request $request, $id)
    {
        $class = ClassModel::getSingle($id);
        $class->name = trim($request->name);
        $class->status = trim($request->status);
        $class->save();


        $class->save(); // Don't forget to save the class to the database
        return redirect('panel/class/list')->with('success', 'class Updated Successfully');
    }



    public function edit_class($id)
    {
        $data['getclass'] = ClassModel::getSingle($id);
        $data['meta_title'] = "Edit";
        return view('backend.class.edit', $data);
    }


    public function delete_class($id)
    {
        $class = ClassModel::find($id);

        if (!$class) {
            return redirect()->back()->with('error', 'class not found.');
        }

        $class->delete();

        return redirect()->back()->with('success', 'class deleted successfully.');
    }
}
