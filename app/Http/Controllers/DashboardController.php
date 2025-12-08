<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // Hitung statistik
        $totalFoto = Foto::where('UserID', $user->UserID)->count();
        $totalAlbum = Album::where('UserID', $user->UserID)->count();
        
        // Hitung total likes dari foto user
        $totalLikes = $user->fotos()->withCount('likes')->get()->sum('likes_count');

        // Foto user terbaru
        $myPhotos = Foto::where('UserID', $user->UserID)
            ->with(['album', 'likes', 'komentars'])
            ->latest('TanggalUnggah')
            ->take(6)
            ->get();

        // Semua foto (feed)
        $allPhotos = Foto::with(['user', 'album', 'likes', 'komentars'])
            ->latest('TanggalUnggah')
            ->take(12)
            ->get();

        return view('dashboard.index', compact(
            'user',
            'totalFoto',
            'totalAlbum',
            'totalLikes',
            'myPhotos',
            'allPhotos'
        ));
    }
}