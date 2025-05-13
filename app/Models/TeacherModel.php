<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TeacherModel extends Authenticatable
{
    protected $table = 'teachers';
    static function getSingle($id){
        return TeacherModel::find($id);
    }
    static function getteacher($user_id, $user_type)
    {
        $return = self::select('*');
    
        if (!empty(request()->get('id'))) {
            $return = $return->where('id', '=', request()->get('id'));
        }
    
        if (!empty(request()->get('name'))) {
            $return = $return->where('name', 'LIKE', '%' . request()->get('name') . '%');
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
    
        $return = $return->where('is_admin','=',5)
        ->orderBy('id', 'desc')
        ->where('is_admin','=',5)
        ->paginate(10);
    
        return $return;
    }
    public function getCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
