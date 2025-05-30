<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class week extends Model
{
    protected $table=('weeks');
    static public function getSingle($id){
        return self::find($id);
    }

    static public function getRecord(){
        return self::get();
    }

}
