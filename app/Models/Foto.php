<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    protected $primaryKey = 'FotoID';

    protected $fillable = [
        'JudulFoto',
        'DeskripsiFoto',
        'TanggalUnggah',
        'LokasiFile',
        'AlbumID',
        'UserID',
    ];

    protected $casts = [
        'TanggalUnggah' => 'date',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    // Relasi ke Album
    public function album()
    {
        return $this->belongsTo(Album::class, 'AlbumID', 'AlbumID');
    }

    // Relasi ke Komentar
    public function komentars()
    {
        return $this->hasMany(KomentarFoto::class, 'FotoID', 'FotoID');
    }

    // Relasi ke Like
    public function likes()
    {
        return $this->hasMany(LikeFoto::class, 'FotoID', 'FotoID');
    }

    // Cek apakah user sudah like
    public function isLikedBy($userId)
    {
        return $this->likes()->where('UserID', $userId)->exists();
    }
}