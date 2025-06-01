<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    protected $table = 'class_teacher';
    protected $fillable = [
        'class_id',
        'teacher_id',
        'created_by_id',
        'status',
    ];

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getClassteacher($user_id)
    {
        $return = self::select('class_teacher.*', 'class.name as class_name', 'teachers.name as teacher_name','teachers.last_name as teacher_last_name');
        $return = $return->join('class', 'class.id', '=', 'class_teacher.class_id');
        $return = $return->join('teachers', 'teachers.id', '=', 'class_teacher.teacher_id');

        if (!empty(request()->get('id'))) {
            $return = $return->where('class_teacher.id', '=', request()->get('id'));
        }

        if (!empty(request()->get('teacher_name'))) {
            $return = $return->where(function ($query) {
                if (!empty(request()->get('teacher_name'))) {
                    $query->where('teachers.name', 'like', '%' . request()->get('teacher_name') . '%');
                }
                if (!empty(request()->get('teacher_last_name'))) {
                    $query->where('teachers.last_name', 'like', '%' . request()->get('teacher_last_name') . '%');
                }
            });
        }
        
        if (!empty(request()->get('class_name'))) {
            $return = $return->where('class.name', '=', request()->get('class_name'));
        }

        if (!empty(request()->get('status'))) {
            $status = request()->get('status');
            if ($status == 100) {
                $status = 0;
            }
            $return = $return->where('class_teacher.status', '=', request()->get('status'));
        }
        $return = $return->where('class_teacher.created_by_id', '=', $user_id);
        return $return->orderBy('class_teacher.id', 'desc')->paginate(10);
    }

    static public function getSelectedTeacher($class_id, $created_by_id)
    {
        return Self::select('class_teacher.*', 'teachers.name as teacher_name','teachers.last_name as teacher_last_name')
            ->join('teachers', 'teachers.id', '=', 'teacher_id')
            ->where('class_teacher.created_by_id', '=', $created_by_id)
            ->where('class_teacher.class_id', '=', $class_id)
            ->get();
    }
}
