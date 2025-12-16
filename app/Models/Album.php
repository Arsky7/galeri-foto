<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album'; // ← Tambahkan ini

    protected $primaryKey = 'AlbumID';

    public $timestamps = true;

    protected $fillable = [
        'NamaAlbum',
        'Deskripsi',
        'TanggalDibuat',
        'UserID',
        'is_public' // ← tambahkan nanti
    ];
    protected $casts = [
        'TanggalDibuat' => 'date', // atau 'datetime' jika formatnya lengkap
        'is_public' => 'boolean'
    ];
    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'AlbumID');
    }
}
