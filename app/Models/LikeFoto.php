<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeFoto extends Model
{
    protected $table = 'likefoto';
    protected $primaryKey = 'LikeID';

    protected $fillable = [
        'FotoID',
        'UserID',
        'TanggalLike',
    ];

    protected $casts = [
        'TanggalLike' => 'date',
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