<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Eloquent;

/**
 * User
 *
 * @mixin Eloquent
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='users';

    public static function getAllUsers()
    {
        return DB::table('users')->get()->toArray();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsers()
    {
        return User::where('role','=', 'user')->get();
    }

    public static function getAdmins()
    {
        return User::where('role','=', 'admin')->get();
    }
}
