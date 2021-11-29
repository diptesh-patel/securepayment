<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'role_id',
        'notification_url',
        'secret_key',
        'secret_password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * 
     * **
     * 
     * Relation
     * 
     *  */
    public function UserProfile()
    {
        return $this->hasOne(UserProfile::class);
    }
    public function UserMerchant()
    {
        return $this->hasMany(UserMerchant::class);
    }
    
    /**static function */
    public static function getsecrateKey() {
        return User::getUniqueCode(10).'-'.User::getUniqueCode(4).'-'.User::getUniqueCode(4).'-'.User::getUniqueCode(4).'-'.User::getUniqueCode(12);
    }
    public static function getsecretPassword() {
        return User::getUniqueCode(60);
    }
    public static function getUniqueCode($length = "") {
        $code = md5(uniqid(rand(), true));
        if ($length != "") return substr($code, 0, $length);
        else return $code;
    }
}
