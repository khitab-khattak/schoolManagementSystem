<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class SubjectClassModel extends Model
{
    protected $table = 'subject_class';
    protected $fillable = [
        'class_id',
        'subject_id',
        'created_by_id',
        'status',
    ];
   
    
    static function getSingle($id){
        return self::find($id);
    }
    

    // static function getsubject($user_id)
    // {
    //     $query = self::select(
    //         'subject_class.*',
    //         'class.name as class_name',
    //         'subjects.name as subject_name'
    //     )
    //     ->join('class', 'class.id', '=', 'subject_class.class_id')
    //     ->join('subjects', 'subjects.id', '=', 'subject_class.subject_id')
    //     ->where('subject_class.created_by_id', '=', $user_id);
    
    //     // Filter by Assign ID
    //     if (!empty(request()->input('subject_class.id'))) {
    //         $query->where('subject_class.id', '=', request()->input('subject_class.id'));
    //     }
    
    //     if (!empty(request()->get('name'))) {
    //         $query->where('subjects.name', 'LIKE', '%' . request()->get('name') . '%');
    //     }
    //     if (!empty(request()->get('class'))) {
    //         $query->where('class.name', 'LIKE', '%' . request()->get('class') . '%');
    //     }
    
    //     // Filter by status (100 is treated as inactive)
    //     if (request()->has('status') && request()->get('status') !== '') {
    //         $status = request()->get('status') == 100 ? 0 : request()->get('status');
    //         $query->where('subject_class.status', '=', $status);
    //     }
    
    //     return $query->orderBy('subject_class.id', 'desc')->paginate(10);
    // }
    static public function getsubject($user_id){
        $return=self::select('subject_class.*','class.name as class_name','subjects.name as subject_name');
        $return= $return->join('class','class.id','=','subject_class.class_id');
        $return= $return->join('subjects','subjects.id','=','subject_class.subject_id');
        
        if (!empty(request()->get('id'))) {
            $return = $return->where('subject_class.id', '=', request()->get('id'));
        }
         
        if (!empty(request()->get('class_name'))) {
            $return = $return->where('class.name', '=', request()->get('class_name'));
        }
        if (!empty(request()->get('subject_name'))) {
            $return = $return->where('subjects.name', '=', request()->get('subject_name'));
        }

        if (!empty(request()->get('status'))) {
            $status=request()->get('status');
            if($status == 100){
                $status = 0;
            }
            $return = $return->where('subject_class.status', '=', request()->get('status'));
        }
        $return = $return->where('subject_class.created_by_id','=',$user_id);
        return $return->orderBy('subject_class.id','desc')->paginate(10);
        
    }

    static function getRecord()
    {
        $return = self::orderBy('id', 'desc')
        ->paginate();
    
        return $return;
    }
    static public function getSelectedSubject($class_id, $created_by_id){
        return Self::where('created_by_id', '=', $created_by_id)
            ->where('class_id', '=', $class_id)
            ->get();
    }

}
