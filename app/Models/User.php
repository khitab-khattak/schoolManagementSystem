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

        if(!empty(request()->get('id'))){
            $return = $return->where('id', '=', request()->get('id'));
        }
        if(!empty(request()->get('name'))){
            $return = $return->where('name', '=', request()->get('name'));
        }

        if(!empty(request()->get('email'))){
            $return = $return->where('email', '=', request()->get('email'));
        }

        if(!empty(request()->get('address'))){
            $return = $return->where('address', '=', request()->get('address'));
        }

        if(!empty(request()->get('status'))){
            $status = request()->get('status');
            if($status == 100)
            {
                $status=0;
            }
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
}
