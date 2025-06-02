<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ClassTeacher;
use App\Models\TeacherModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTeacherController extends Controller
{
    public function assign_class_teacher_list()
    {
        $data['getRecord'] = ClassModel::getclass(Auth::user()->id);
        $data['getteacher'] = ClassTeacher::getClassteacher(Auth::user()->id);
        $data['meta_title'] = "Assign Class Teacher";
        return view('backend.assignClassTeacher.list', $data);
    }
    public function create_assign_class_teacher()
    {
        $data['getTeacher'] = TeacherModel::getClassTeacherActive(Auth::user()->id, Auth::user()->is_admin);
        $data['getClass'] = ClassModel::getClassActive(Auth::user()->id);
        $data['meta_title'] = "Create Assign Class Teacher";
        return view('backend.assignClassTeacher.create', $data);
    }
    public function insert_assign_class_teacher(Request $request)
    {
        // Validate input
        $request->validate([
            'class_id' => 'required|integer',
            'teacher_id' => 'required|array',
            'teacher_id.*' => 'integer', // each subject id is integer
            'status' => 'nullable|in:0,1',
        ]);

        if (!empty($request->teacher_id) && !empty($request->class_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                if (!empty($teacher_id)) {
                    // Check if the subject is already assigned to this class
                    $exists = ClassTeacher::where('class_id', $request->class_id)
                        ->where('teacher_id', $teacher_id)
                        ->exists();

                    if (!$exists) {
                        $subjectAssign = new ClassTeacher();
                        $subjectAssign->class_id = $request->class_id;
                        $subjectAssign->teacher_id = $teacher_id;
                        $subjectAssign->created_by_id = Auth::user()->id;
                        $subjectAssign->status = $request->status ?? 1;
                        $subjectAssign->save();
                    }
                }
            }
            return redirect('panel/assign-class-teacher/list')->with('success', 'Subjects Assigned Successfully');
        }

        return redirect()->back()->with('error', 'Please select Class and Teacher');
    }
    public function edit_single_assign_class_teacher($id)
    {
        $data['getRecord'] = ClassTeacher::getSingle($id);
        $data['getteacher'] = TeacherModel::getClassTeacherActive(Auth::user()->id);
        $data['getClass'] = ClassModel::getClassActive(Auth::user()->id);
        $data['meta_title'] = "Edit Assign Class Teacher";

        return view('backend.assignClassTeacher.edit_single', $data);
    }

    public function update_single_assign_class_teacher(Request $request, $id)
    {
        // Check if a record with the same class and teacher exists, excluding the current one
        $check = ClassTeacher::where('id', '!=', $id)
            ->where('class_id', $request->class_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('created_by_id', Auth::user()->id)
            ->first();
    
        if ($check) {
            return redirect()->back()->with('error', 'This class is already assigned to the selected teacher.');
        }
    
        // Update the current record
        $record = ClassTeacher::findOrFail($id);
        $record->class_id = trim($request->class_id);
        $record->teacher_id = trim($request->teacher_id);
        $record->status = trim($request->status);
        $record->save();
    
        return redirect('panel/assign-class-teacher/list')->with('success', 'Assigned Class Teacher updated successfully');
    }
    


    public function edit_assign_class_teacher($id)
    {
        // Get the record by id
        $getRecord = ClassTeacher::getSingle($id);
        if (!$getRecord) {
            return redirect()->back()->with('error', 'Assign Subject not found.');
        }

        // Get class_id from this record
        $classId = $getRecord->class_id;

        // Get all assigned subjects for this class and current user
        $getSelectedTeacher = ClassTeacher::getSelectedTeacher($classId, Auth::user()->id);

        $data = [
            'getRecord' => $getRecord,
            'getSelectedTeacher' => $getSelectedTeacher,
            'getClass' => ClassModel::getClassActive(Auth::user()->id),
            'getteacher' => TeacherModel::getClassTeacherActive(Auth::user()->id, Auth::user()),
            'meta_title' => 'Edit Assign Teacher',
        ];

        return view('backend.assignClassTeacher.edit', $data);
    }


    public function update_assign_class_teacher(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'teacher_id' => 'required|array',
            'teacher_id.*' => 'integer',
            'status' => 'required|in:0,1',
        ]);

        $classId = $request->class_id;
        $createdById = Auth::id();
        $newTeacherIds = $request->teacher_id;

        // Get current assigned teacher_ids for this class & user
        $existingAssignments = ClassTeacher::where('class_id', $classId)
            ->where('created_by_id', $createdById)
            ->get();

        $existingTeacherIds = $existingAssignments->pluck('teacher_id')->toArray();

        // Determine what to delete, insert, and update
        $toDelete = array_diff($existingTeacherIds, $newTeacherIds);
        $toInsert = array_diff($newTeacherIds, $existingTeacherIds);
        $toUpdate = array_intersect($existingTeacherIds, $newTeacherIds);

        // Delete unselected teachers
        if (!empty($toDelete)) {
            ClassTeacher::where('class_id', $classId)
                ->where('created_by_id', $createdById)
                ->whereIn('teacher_id', $toDelete)
                ->delete();
        }

        // Insert new teachers
        foreach ($toInsert as $teacher_id) {
            ClassTeacher::create([
                'class_id' => $classId,
                'teacher_id' => $teacher_id,
                'created_by_id' => $createdById,
                'status' => $request->status,
            ]);
        }

        // Update status for retained teachers
        foreach ($toUpdate as $teacher_id) {
            ClassTeacher::where('class_id', $classId)
                ->where('created_by_id', $createdById)
                ->where('teacher_id', $teacher_id)
                ->update([
                    'status' => $request->status,
                ]);
        }

        return redirect('panel/assign-class-teacher/list')->with('success', 'Assign Class Teacher Updated Successfully');
    }










    public function delete_assign_class_teacher($id)
    {
        $teacher = ClassTeacher::find($id);

        if (!$teacher) {
            return redirect()->back()->with('error', 'Assign Class Teacher not found.');
        }

        $teacher->delete();

        return redirect()->back()->with('success', 'Assign Class Teacher deleted successfully.');
    }
}
