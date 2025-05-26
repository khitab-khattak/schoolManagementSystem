<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    static function getSchool()
    {
        $return = self::select('*');
    
        if (!empty(request()->get('id'))) {
            $return = $return->where('id', '=', request()->get('id'));
        }
    
        if (!empty(request()->get('name'))) {
            $return = $return->where('name', 'LIKE', '%' . request()->get('name') . '%');
        }
    
        if (!empty(request()->get('email'))) {
            $return = $return->where('email', 'LIKE', '%' . request()->get('email') . '%');
        }
    
        if (!empty(request()->get('address'))) {
            $return = $return->where('address', 'LIKE', '%' . request()->get('address') . '%');
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
    
        $return = $return->where('is_admin', '=', 3)
                         ->where('is_delete', '=', 0)
                         ->orderBy('id', 'desc')
                         ->paginate(10);
    
        return $return;
    }
    
    static function getSingle($id){
        return User::find($id);
    }

    //admin
    static function getadmin()
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
    
        // Filter by is_admin if provided (admin only)
        if (request()->filled('is_admin')) {
            $return = $return->where('is_admin', '=', request()->get('is_admin'));
        }
    
        // Handle status filtering
        if (request()->has('status') && request()->get('status') !== null) {
            $status = request()->get('status');
            
            // Map 100 to 0 (Inactive)
            if ($status == '100') {
                $status = 0;
            }
            $return = $return->where('status', '=', $status);
        }
    
        // Ensure is_admin is in the expected values (1 or 2)
        $return = $return->whereIn('is_admin', [1, 2])
                         ->where('is_delete', '=', 0)
                         ->orderBy('id', 'desc')
                         ->paginate(10);
    
        return $return;
    }
    static function getRecordAll()
    {
        $return = self::select('*');
        $return = $return->whereIn('is_admin', [1,2,3,4])
                         ->where('is_delete', '=', 0)
                         ->orderBy('id', 'desc')
                         ->get();
    
        return $return;
    }
    
    static public function getSchoolAll(){
        return  self::select('*')
        ->where('is_admin', '=', 3)
        ->where('status', '=', 1)
        ->orderBy('id', 'desc')
        ->get();
    }
}
