<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Foto;
use App\Models\Album;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalFoto = Foto::where('UserID', $user->UserID)->count();
        $totalAlbum = Album::where('UserID', $user->UserID)->count();
        $totalLikes = Foto::with('likes')->get()->sum(fn($f) => $f->likes->count());
        $myPhotos = Foto::where('UserID', $user->UserID)->latest()->take(6)->get();
        $allPhotos = Foto::latest()->take(12)->get();

        return view('dashboard.index', compact(
            'user', 'totalFoto', 'totalAlbum', 'totalLikes', 'myPhotos', 'allPhotos'
        ));
    }
}
