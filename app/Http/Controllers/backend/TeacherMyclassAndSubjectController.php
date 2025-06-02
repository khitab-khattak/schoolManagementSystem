<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassModel;
use App\Models\SubjectClassModel;
use App\Models\Week; // Ensure the correct namespace for the Week model
use App\Models\ClassTimetable; // Import the ClassTimetable model
use App\Models\Subject;

class TeacherMyclassAndSubjectController extends Controller
{
    public function Class_and_subject_list()
    {
        $teacher = Auth::guard('teacher')->user(); // Replace 'teacher' with your actual guard
        if (!$teacher) {
            abort(403, 'Unauthorized access');
        }
    
        $data['getRecord'] = ClassTeacher::getRecordTeacher($teacher->id);
        $data['meta_title'] = "My Class & Subject Timetable";
        return view('teacher.class_subject.list', $data);
    }
    public function Teacher_Class_Timetable( $class_id,$subject_id){
       $result = array();
        $getWeek = week::getRecord();
        foreach ($getWeek as $week) {
            $arraydata = array();
            $arraydata['id'] = $week->id;
            $arraydata['week_name'] = $week->name;

            if(!empty($class_id)&& !empty($subject_id)){
                $getClassTimetable = ClassTimetable::getRecord($class_id,$subject_id,$week->id);
                if(!empty($getClassTimetable)){
                    $arraydata['start_time'] = $getClassTimetable->start_time;
                    $arraydata['end_time'] = $getClassTimetable->end_time;
                    $arraydata['room_number'] = $getClassTimetable->room_number;
                }else{
                    $arraydata['start_time'] = '';
                    $arraydata['end_time'] = '' ;
                    $arraydata['room_number'] =  '';
                }
            }else{
                $arraydata['start_time'] = '';
                $arraydata['end_time'] = '' ;
                $arraydata['room_number'] =  '';
            }


            $result[] = $arraydata;
        }
        $data['getRecord'] = $result;

        $data['meta_title'] = "Class Timetable";
        $data['getClass']=ClassModel::getSingle($class_id);
        $data['getSubject']=Subject::getSingle($subject_id);


        return view('teacher.class_subject.timetable', $data);

    }
}
