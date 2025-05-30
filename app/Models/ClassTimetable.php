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
}
