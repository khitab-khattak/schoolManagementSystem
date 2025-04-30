<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';



    static function getSingle($id){
        return ClassModel::find($id);
    }

    static function getclass($user_id,$user_type)
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
    public function getCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    static function getclassActive($user_id)
    {
        $return = self::select('*')
        ->where('status','=',1)
        ->where('created_by_id','=',$user_id)
        ->orderBy('id', 'desc')
        ->get();
    
        return $return;
    }
}
