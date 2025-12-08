<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'UserID';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'Username',
        'Password',
        'Email',
        'NamaLengkap',
        'Alamat',
        'Role',
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];

    protected $casts = [
        'Email_verified_at' => 'datetime',
    ];

    // Wajib agar Auth::attempt membaca field Password custom
    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Relasi: 1 User banyak Album
    public function albums()
    {
        return $this->hasMany(Album::class, 'UserID');
    }

    // Relasi: 1 User banyak Foto
    public function fotos()
    {
        return $this->hasMany(Foto::class, 'UserID');
    }

    // Relasi: 1 User banyak Komentar
    public function komentars()
    {
        return $this->hasMany(KomentarFoto::class, 'UserID');
    }

    // Relasi: 1 User banyak Like
    public function likes()
    {
        return $this->hasMany(LikeFoto::class, 'UserID');
    }
}
