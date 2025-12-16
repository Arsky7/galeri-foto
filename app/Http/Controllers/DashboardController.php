<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Album;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        // Total foto & album milik user
        $totalFoto = Foto::where('UserID', $user->UserID)->count();
        $totalAlbum = Album::where('UserID', $user->UserID)->count();

        // Total likes dari semua foto user
        $totalLikes = Foto::where('UserID', $user->UserID)
            ->withCount('likes')
            ->get()
            ->sum('likes_count');

        // Foto terbaru milik user
        $myPhotos = Foto::where('UserID', $user->UserID)
            ->withCount(['likes', 'komentars'])
            ->latest()
            ->take(6)
            ->get();

        // Semua foto terbaru (hanya yang dari album publik, jika album privat tidak boleh muncul)
        $allPhotos = Foto::with(['user', 'album', 'likes', 'komentars'])
            ->whereHas('album', function ($query) {
                // Hanya ambil foto dari album publik
                $query->where('is_public', true);
            })
            ->orWhere('UserID', $user->UserID) // Tapi user bisa lihat semua fotonya (termasuk di album privat)
            ->latest()
            ->take(12)
            ->get()
            ->unique('FotoID') // Hindari duplikat jika foto muncul di dua kondisi
            ->values();

        return view('dashboard.index', compact(
            'user', 'totalFoto', 'totalAlbum', 'totalLikes', 'myPhotos', 'allPhotos'
        ));
    }
}