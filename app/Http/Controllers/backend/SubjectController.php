<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ClassTimetable;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\SubjectClassModel;
use App\Models\week;
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


    public function assign_subject_list()
    {
        $data['getsubject'] = SubjectClassModel::getsubject(Auth::user()->id);
        $data['meta_title'] = "Assign Subject Class List";
        return view('backend.assignSubject.list', $data);
    }

    public function create_assign_subject()
    {
        $data['getClass'] = ClassModel::getClassActive(Auth::user()->id);
        $data['getsubject'] = Subject::getSubjectActive(Auth::user()->id);
        return view('backend.assignSubject.create', $data);
    }
    public function insert_assign_subject(Request $request)
    {
        // Validate input
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|array',
            'subject_id.*' => 'integer', // each subject id is integer
            'status' => 'nullable|in:0,1',
        ]);

        if (!empty($request->subject_id) && !empty($request->class_id)) {
            foreach ($request->subject_id as $subject_id) {
                if (!empty($subject_id)) {
                    // Check if the subject is already assigned to this class
                    $exists = SubjectClassModel::where('class_id', $request->class_id)
                        ->where('subject_id', $subject_id)
                        ->exists();

                    if (!$exists) {
                        $subjectAssign = new SubjectClassModel;
                        $subjectAssign->class_id = $request->class_id;
                        $subjectAssign->subject_id = $subject_id;
                        $subjectAssign->created_by_id = Auth::user()->id;
                        $subjectAssign->status = $request->status ?? 1;
                        $subjectAssign->save();
                    }
                }
            }
            return redirect('panel/assign-subject/list')->with('success', 'Subjects Assigned Successfully');
        }

        return redirect()->back()->with('error', 'Please select class and subjects');
    }






    // public function update_assign_subject(Request $request, $id)
    // {
    //     // Find the record to get class_id and created_by_id for validation
    //     $subjectAssign = SubjectClassModel::getSingle($id);

    //     if (!$subjectAssign) {
    //         return redirect()->back()->with('error', 'Assign Subject Class not found.');
    //     }

    //     $request->validate([
    //         'class_id' => 'required|integer',
    //         'subject_id' => 'required|array',
    //         'subject_id.*' => 'integer',
    //         'status' => 'required|in:0,1',
    //     ]);

    //     $class_id = $request->class_id;
    //     $created_by_id = Auth::user()->id;

    //     // Delete all existing assignments for this class & user
    //     SubjectClassModel::where('class_id', $class_id)
    //         ->where('created_by_id', $created_by_id)
    //         ->delete();

    //     // Insert new assignments
    //     foreach ($request->subject_id as $subject_id) {
    //         if (!empty($subject_id)) {
    //             $newAssign = new SubjectClassModel;
    //             $newAssign->class_id = $class_id;
    //             $newAssign->subject_id = $subject_id;
    //             $newAssign->created_by_id = $created_by_id;
    //             $newAssign->status = $request->status;
    //             $newAssign->save();
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Assign Subject Class Updated Successfully');
    // }





    public function edit_assign_subject($id)
    {
        // Get the record by id
        $getRecord = SubjectClassModel::getSingle($id);
        if (!$getRecord) {
            return redirect()->back()->with('error', 'Assign Subject not found.');
        }

        // Get class_id from this record
        $classId = $getRecord->class_id;

        // Get all assigned subjects for this class and current user
        $getSelectedSubject = SubjectClassModel::getSelectedSubject($classId, Auth::user()->id);

        $data = [
            'getRecord' => $getRecord,
            'getSelectedSubject' => $getSelectedSubject,
            'getClass' => ClassModel::getClassActive(Auth::user()->id),
            'getsubject' => Subject::getSubjectActive(Auth::user()->id),
            'meta_title' => 'Edit Assign Subject',
        ];

        return view('backend.assignSubject.edit', $data);
    }


    public function update_assign_subject(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|array',
            'subject_id.*' => 'integer',
            'status' => 'required|in:0,1',
        ]);

        $classId = $request->class_id;
        $createdById = Auth::id();
        $newSubjectIds = $request->subject_id;

        // Fetch all previous subject_ids for this class & user
        $existingAssignments = SubjectClassModel::where('class_id', $classId)
            ->where('created_by_id', $createdById)
            ->get();

        $existingSubjectIds = $existingAssignments->pluck('subject_id')->toArray();

        // Find subjects to delete
        $toDelete = array_diff($existingSubjectIds, $newSubjectIds);
        // Find subjects to insert
        $toInsert = array_diff($newSubjectIds, $existingSubjectIds);
        // Find subjects to update (already exist and still selected)
        $toUpdate = array_intersect($existingSubjectIds, $newSubjectIds);

        // ✅ Delete deselected subjects
        if (!empty($toDelete)) {
            SubjectClassModel::where('class_id', $classId)
                ->where('created_by_id', $createdById)
                ->whereIn('subject_id', $toDelete)
                ->delete();
        }

        // ✅ Insert new subjects
        foreach ($toInsert as $subject_id) {
            SubjectClassModel::create([
                'class_id' => $classId,
                'subject_id' => $subject_id,
                'created_by_id' => $createdById,
                'status' => $request->status,
            ]);
        }

        // ✅ Update status for existing assignments if needed
        foreach ($toUpdate as $subject_id) {
            SubjectClassModel::where('class_id', $classId)
                ->where('created_by_id', $createdById)
                ->where('subject_id', $subject_id)
                ->update([
                    'status' => $request->status,
                ]);
        }

        return redirect('panel/assign-subject/list')->with('success', 'Assign Subject Updated Successfully');
    }



    public function edit_single_assign_subject($id)
    {
        $getRecord = SubjectClassModel::getSingle($id);

        $data = [
            'getRecord' => $getRecord,
            'getClass' => ClassModel::getClassActive(Auth::user()->id),
            'getsubject' => Subject::getSubjectActive(Auth::user()->id),
            'meta_title' => 'Edit Assign Subject Class',
        ];

        return view('backend.assignSubject.edit_single', $data);
    }


    public function update_single_assign_subject(Request $request, $id)
    {
        // Check if a record with the same class and teacher exists, excluding the current one
        $check = SubjectClassModel::where('id', '!=', $id)
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->where('created_by_id', Auth::user()->id)
            ->first();
    
        if ($check) {
            return redirect()->back()->with('error', 'This class is already assigned to the selected teacher.');
        }
    
        // Update the current record
        $record = SubjectClassModel::findOrFail($id);
        $record->class_id = trim($request->class_id);
        $record->subject_id = trim($request->subject_id);
        $record->status = trim($request->status);
        $record->save();
    
        return redirect('panel/assign-subject/list')->with('success', 'Assigned Subject Class updated successfully');
    }









    public function delete_assign_subject($id)
    {
        $subject = SubjectClassModel::find($id);

        if (!$subject) {
            return redirect()->back()->with('error', 'Assign Subject Class not found.');
        }

        $subject->delete();

        return redirect()->back()->with('success', 'Assign Subject Class deleted successfully.');
    }

    public function class_timetable(Request $request)
    {
        if (!empty($request->class_id)) {
            $getSubject = SubjectClassModel::getSelectedSubject($request->class_id, Auth::user()->id);
        } else {
            $getSubject = '';
        }

        $data['getSubject'] = $getSubject;

        $result = array();
        $getWeek = week::getRecord();
        foreach ($getWeek as $week) {
            $arraydata = array();
            $arraydata['id'] = $week->id;
            $arraydata['week_name'] = $week->name;

            if(!empty($request->class_id)&& !empty($request->subject_id)){
                $getClassTimetable = ClassTimetable::getRecord($request->class_id,$request->subject_id,$week->id);
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

        $data['getClass'] = ClassModel::getClassActive(Auth::user()->id);
        $data['meta_title'] = "Class Timetable";

        return view('backend.classTimetable.list', $data);
    }

    public function get_assign_subject_class(Request $request)
    {
        $getSubject = SubjectClassModel::getSelectedSubject($request->class_id, Auth::user()->id);
        $selectedId = $request->selected_subject_id;

        $html = '<option value="">Select</option>';
        foreach ($getSubject as $subject) {
            $selected = ($selectedId == $subject->subject_id) ? 'selected' : '';
            $html .= '<option value="' . $subject->subject_id . '" ' . $selected . '>' . $subject->subject_name . '</option>';
        }

        return response()->json([
            'success' => $html,
            'message' => $getSubject->isEmpty() ? 'No subjects assigned to this class.' : null
        ]);
    }

    public function submit_class_timetable(Request $request)
    {
        if (!empty($request->class_id) && !empty($request->subject_id)) {
            ClassTimetable::DeleteRecord($request->class_id, $request->subject_id);
            foreach ($request->timetable as $timetable) {
                if (!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number'])) {
                    $save = new ClassTimetable;
                    $save->week_id = $timetable['week_id'];
                    $save->start_time = $timetable['start_time'];
                    $save->end_time = $timetable['end_time'];
                    $save->room_number = $timetable['room_number'];
                    $save->class_id = $request->class_id;
                    $save->subject_id = $request->subject_id;
                    $save->save();
                }
            }
            return redirect()->back()->with('success', 'Class Timetable Successfully Updated.');
        } else {
            return redirect()->back()->with('error', 'Please Select Class and Subject.');
        }
    }
}
