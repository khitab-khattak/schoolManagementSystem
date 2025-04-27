<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function subject_list()
    {
        $data['getsubject'] = Subject::getsubject(Auth::user()->id);
        $data['meta_title'] = "subject List";
        return view('backend.subject.list', $data);
    }
    public function create_subject()
    {
        return view('backend.subject.create');
    }
    public function insert_subject(Request $request)
    {
        $subject = new Subject;
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->created_by_id = Auth::user()->id;
        $subject->status = trim($request->status);
       
        $subject->save();
        return redirect('panel/subject/list')->with('success', 'subject Created Successfully');
    }



    public function update_subject(Request $request, $id)
    {
        $subject = Subject::getSingle($id);
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        $subject->save();


        $subject->save(); // Don't forget to save the subject to the database
        return redirect('panel/subject/list')->with('success', 'subject Updated Successfully');
    }



    public function edit_subject($id)
    {
        $data['getsubject'] = Subject::getSingle($id);
        $data['meta_title'] = "Edit";
        return view('backend.subject.edit', $data);
    }


    public function delete_subject($id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return redirect()->back()->with('error', 'subject not found.');
        }

        $subject->delete();

        return redirect()->back()->with('success', 'subject deleted successfully.');
    }
}
