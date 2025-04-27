<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    static function getSingle($id){
        return Subject::find($id);
    }

    static function getsubject($user_id)
    {
        $return = self::select('*');
    
        // Filter by id if provided
        if (!empty(request()->get('id'))) {
            $return = $return->where('id', '=', request()->get('id'));
        }
    
        // Filter by name if provided
        if (!empty(request()->get('name'))) {
            $return = $return->where('name', 'LIKE', '%' . request()->get('name') . '%');
        }
        if (!empty(request()->get('type'))) {
            $return = $return->where('type', 'LIKE', '%' . request()->get('type') . '%');
        }
    
        // Handle status filtering
        if (request()->has('status') && request()->get('status') !== null) {
            $status = request()->get('status');
            // Map 100 to 0 (Inactive)
            if ($status == 100) {
                $status = 0;
            }
            $return = $return->where('status', '=', $status);
        }
        $return=$return->where('created_by_id','=',$user_id);
    
        // Ensure is_class is in the expected values (1 or 2)
        $return = $return->orderBy('id', 'desc')
                         ->paginate(10);
    
        return $return;
    }
}
