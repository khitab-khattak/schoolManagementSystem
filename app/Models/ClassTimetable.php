<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTimetable extends Model
{
    protected $table ='class_timetable';

    static public function getSingle($id){
        return self::find($id);
    }

    static public function DeleteRecord($class_id,$subject_id){
        return self::where('class_id','=',$class_id)->where('subject_id','=',$subject_id)->delete();
    }
     

    static public function getRecord($class_id,$subject_id,$week_id){
        return self::where('class_id','=',$class_id)
        ->where('subject_id','=',$subject_id)
        ->where('week_id','=',$week_id)
        ->first();
    }

    static public function getRecordA($class_id, $subject_id, $week_name){
        return self::join('weeks', 'weeks.id', '=', 'class_timetable.week_id')
            ->where('class_timetable.class_id', $class_id)
            ->where('class_timetable.subject_id', $subject_id)
            ->where('weeks.name', $week_name) // use the correct column name from weeks table
            ->select('class_timetable.*') // optional: specify columns
            ->first();
    }
    
}
