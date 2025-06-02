<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherMyclassAndSubjectController extends Controller
{
    public function Class_and_subject_list()
    {
        $teacher = Auth::guard('teacher')->user(); // Replace 'teacher' with your actual guard
        if (!$teacher) {
            abort(403, 'Unauthorized access');
        }
    
        $data['getRecord'] = ClassTeacher::getRecordTeacher($teacher->id);
        $data['meta_title'] = "My Class & Subject";
        return view('teacher.class_subject.list', $data);
    }
}
