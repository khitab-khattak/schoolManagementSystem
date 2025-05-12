<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';



    static function getSingle($id){
        return Student::find($id);
    }


static function getStudent($user_id, $user_type)
    {
        $return = self::select('*');
    
        if (!empty(request()->get('id'))) {
            $return = $return->where('id', '=', request()->get('id'));
        }
    
        if (!empty(request()->get('first_name'))) {
            $return = $return->where('first_name', 'LIKE', '%' . request()->get('first_name') . '%');
        }
        if (!empty(request()->get('last_name'))) {
            $return = $return->where('last_name', 'LIKE', '%' . request()->get('last_name') . '%');
        }
    
        if (!empty(request()->get('email'))) {
            $return = $return->where('email', 'LIKE', '%' . request()->get('email') . '%');
        }
    
        if (request()->has('gender') && request()->get('gender') !== null) {
            $gender = request()->get('gender');
            $return = $return->where('gender', '=', $gender);
        }
    
        // Handle status filtering
        if (request()->has('status') && request()->get('status') !== null) {
            $status = request()->get('status');
            // Map 100 to 0 for Inactive
            if ($status == 100) {
                $status = 0; 
            }
            $return = $return->where('status', '=', $status);
        }
        if($user_type == 3){
            $return = $return->where('created_by_id','=',$user_id);
        }
    
        $return = $return
        ->orderBy('id', 'desc')
        ->paginate(10);
    
        return $return;
    }
    static function getparentsMystudent($parent_id)
    {
        $return = self::select('*');
        $return = $return->where('parent_id', '=', $parent_id);
    
        return $return->orderBy('id', 'desc')->paginate(10);
    }
    public function getClass()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    public function getParentData(){
        return $this->belongsTo(Parents::class,'parent_id');
       }

    public function getCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
