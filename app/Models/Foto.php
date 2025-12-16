<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    // ========== RELATIONSHIPS ==========
    
    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    /**
     * Relasi ke Album
     */
    public function album()
    {
        return $this->belongsTo(Album::class, 'AlbumID', 'AlbumID');
    }

    /**
     * Relasi ke Komentar
     */
    public function komentars()
    {
        return $this->hasMany(KomentarFoto::class, 'FotoID', 'FotoID');
    }

    /**
     * Relasi ke Like
     */
    public function likes()
    {
        return $this->hasMany(LikeFoto::class, 'FotoID', 'FotoID');
    }

    // ========== METHODS ==========
    
    /**
     * Cek apakah user sudah like foto ini
     */
    public function isLikedBy($userId)
    {
        return $this->likes()->where('UserID', $userId)->exists();
    }

    // ========== ACCESSORS ==========
    
    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        $thumbPath = str_replace('photos/', 'photos/thumb_', $this->LokasiFile);
        
        // Check if thumbnail exists, fallback to original
        if (Storage::disk('public')->exists($thumbPath)) {
            return asset('storage/' . $thumbPath);
        }
        
        return asset('storage/' . $this->LokasiFile);
    }

    /**
     * Get full image URL
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->LokasiFile);
    }

    /**
     * Get formatted file size
     */
    public function getFileSizeAttribute()
    {
        $path = storage_path('app/public/' . $this->LokasiFile);
        
        if (file_exists($path)) {
            $bytes = filesize($path);
            $units = ['B', 'KB', 'MB', 'GB'];
            
            for ($i = 0; $bytes > 1024; $i++) {
                $bytes /= 1024;
            }
            
            return round($bytes, 2) . ' ' . $units[$i];
        }
        
        return 'Unknown';
    }

    // ========== QUERY SCOPES ==========
    
    /**
     * Scope: Only published photos
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('TanggalUnggah');
    }

    /**
     * Scope: Photos by specific user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('UserID', $userId);
    }

    /**
     * Scope: Recent photos (last 7 days)
     */
    public function scopeRecent($query)
    {
        return $query->where('TanggalUnggah', '>=', now()->subDays(7));
    }

    /**
     * Scope: Most liked photos
     */
    public function scopeMostLiked($query, $limit = 10)
    {
        return $query->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->limit($limit);
    }
}