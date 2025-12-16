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

    /**
     * Tampilkan semua album milik user yang sedang login.
     * User selalu bisa melihat semua album miliknya (publik & privat).
     */
    public function index()
    {
        $albums = Album::where('UserID', Auth::id())
            ->withCount('fotos')
            ->latest()
            ->get();

        return view('album.index', compact('albums'));
    }

    /**
     * Tampilkan form buat album baru.
     */
    public function create()
    {
        return view('album.create');
    }

    /**
     * Simpan album baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NamaAlbum' => 'required|string|max:100',
            'Deskripsi' => 'nullable|string|max:500',
            'is_public' => 'required|boolean',
        ]);

        Album::create([
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
            'is_public' => $request->is_public,
            'TanggalDibuat' => now(),
            'UserID' => Auth::id(),
        ]);

        return redirect()->route('album.index')->with('success', 'Album berhasil dibuat!');
    }

    /**
     * Tampilkan detail album.
     * - Jika album milik user → boleh lihat (publik/privat)
     * - Jika album orang lain → hanya boleh lihat jika publik
     */
    public function show($id)
    {
        $album = Album::with(['fotos' => function ($query) {
            $query->withCount(['likes', 'komentars'])->latest();
        }, 'user'])
            ->findOrFail($id);

        // Jika album bukan milik user yang sedang login
        if ($album->UserID !== Auth::id()) {
            // Hanya izinkan akses jika album publik
            if (!$album->is_public) {
                abort(403, 'Album ini bersifat privat.');
            }
        }

        return view('album.show', compact('album'));
    }

    /**
     * Hapus album (hanya pemilik yang bisa).
     */
    public function destroy($id)
    {
        $album = Album::where('AlbumID', $id)
            ->where('UserID', Auth::id())
            ->firstOrFail();

        $album->delete();

        return redirect()->route('album.index')->with('success', 'Album berhasil dihapus!');
    }
}