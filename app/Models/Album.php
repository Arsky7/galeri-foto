<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album';
    protected $primaryKey = 'AlbumID';

    protected $fillable = [
        'NamaAlbum',
        'Deskripsi',
        'TanggalDibuat',
        'UserID',
    ];

    protected $casts = [
        'TanggalDibuat' => 'date',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    // Relasi ke Foto
    public function fotos()
    {
        return $this->hasMany(Foto::class, 'AlbumID', 'AlbumID');
    }
}