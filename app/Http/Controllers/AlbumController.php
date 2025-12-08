<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan semua album user
    public function index()
    {
        $albums = Album::where('UserID', Auth::id())
            ->withCount('fotos')
            ->latest()
            ->get();

        return view('album.index', compact('albums'));
    }

    // Form buat album
    public function create()
    {
        return view('album.create');
    }

    // Simpan album baru
    public function store(Request $request)
    {
        $request->validate([
            'NamaAlbum' => 'required|string|max:100',
            'Deskripsi' => 'nullable|string',
        ]);

        Album::create([
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
            'TanggalDibuat' => now(),
            'UserID' => Auth::id(),
        ]);

        return redirect()->route('album.index')->with('success', 'Album berhasil dibuat!');
    }

    // Detail album
    public function show($id)
    {
        $album = Album::where('AlbumID', $id)
            ->where('UserID', Auth::id())
            ->with(['fotos' => function($query) {
                $query->with(['likes', 'komentars'])->latest();
            }])
            ->firstOrFail();

        return view('album.show', compact('album'));
    }

    // Hapus album
    public function destroy($id)
    {
        $album = Album::where('AlbumID', $id)
            ->where('UserID', Auth::id())
            ->firstOrFail();

        $album->delete();

        return redirect()->route('album.index')->with('success', 'Album berhasil dihapus!');
    }
}