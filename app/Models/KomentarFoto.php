<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarFoto extends Model
{
    protected $table = 'komentarfoto';
    protected $primaryKey = 'KomentarID';

    protected $fillable = [
        'FotoID',
        'UserID',
        'IsiKomentar',
        'TanggalKomentar',
    ];

    protected $casts = [
        'TanggalKomentar' => 'date',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    // Relasi ke Foto
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'FotoID', 'FotoID');
    }
}