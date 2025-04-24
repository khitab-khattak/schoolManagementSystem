<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolAdminModel extends Model
{
    protected $table = 'users';
    static function getschool_admin($user_id, $user_type)
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
    
        // Filter by email if provided
        if (!empty(request()->get('email'))) {
            $return = $return->where('email', 'LIKE', '%' . request()->get('email') . '%');
        }
    
        // Filter by address if provided
        if (!empty(request()->get('address'))) {
            $return = $return->where('address', 'LIKE', '%' . request()->get('address') . '%');
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
        if($user_type == 3){
            $return = $return->where('created_by_id','=',$user_id);
        }
        // Ensure is_admin is in the expected values (1 or 2)
        $return = $return->where('is_admin', '=',4)
                         ->where('is_delete', '=', 0)
                         ->orderBy('id', 'desc')
                         ->paginate(10);
    
        return $return;
    }
    public function getCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
