<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'UserID'; // Custom PK
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'Username',
        'Password',
        'Email',
        'NamaLengkap',
        'Alamat',
        'role'
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];

    protected $casts = [
        'Email_verified_at' => 'datetime',
    ];

    /**
     * Override default password field used by Laravel
     */
    public function getAuthPassword()
    {
        return $this->Password;
    }

    /**
     * Ensure password always hashed automatically
     */
    public function setPasswordAttribute($value)
    {
        if ($value && !Hash::needsRehash($value)) {
            $this->attributes['Password'] = Hash::make($value);
        } else {
            $this->attributes['Password'] = $value;
        }
    }

    /**
     * User -> Foto relationship
     * 1 user punya banyak foto
     */
    public function fotos()
    {
        return $this->hasMany(Foto::class, 'UserID', 'UserID');
    }
}
