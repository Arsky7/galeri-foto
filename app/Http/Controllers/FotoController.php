<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan galeri semua foto
    public function index()
    {
        $fotos = Foto::with(['user', 'album', 'likes', 'komentars'])
            ->latest('TanggalUnggah')
            ->paginate(12);

        return view('foto.index', compact('fotos'));
    }

    // Form upload foto
    public function create()
    {
        $albums = Album::where('UserID', Auth::id())->latest()->get();
        return view('foto.create', compact('albums'));
    }

    // Simpan foto
    public function store(Request $request)
    {
        $request->validate([
            'JudulFoto' => 'required|string|max:100',
            'DeskripsiFoto' => 'nullable|string',
            'AlbumID' => 'required|exists:album,AlbumID',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'JudulFoto.required' => 'Judul foto wajib diisi',
            'AlbumID.required' => 'Pilih album',
            'foto.required' => 'File foto wajib diupload',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran foto maksimal 5MB',
        ]);

        // Upload foto
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('photos', $filename, 'public');

        Foto::create([
            'JudulFoto' => $request->JudulFoto,
            'DeskripsiFoto' => $request->DeskripsiFoto,
            'TanggalUnggah' => now(),
            'LokasiFile' => $path,
            'AlbumID' => $request->AlbumID,
            'UserID' => Auth::id(),
        ]);

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diupload!');
    }

    // Detail foto
    public function show($id)
    {
        $foto = Foto::with([
            'user', 
            'album', 
            'likes.user', 
            'komentars.user'
        ])->findOrFail($id);

        $isLiked = $foto->isLikedBy(Auth::id());

        return view('foto.show', compact('foto', 'isLiked'));
    }

    // Hapus foto
    public function destroy($id)
    {
        $foto = Foto::where('FotoID', $id)
            ->where('UserID', Auth::id())
            ->firstOrFail();

        Storage::disk('public')->delete($foto->LokasiFile);
        $foto->delete();

        return redirect()->route('foto.index')->with('success', 'Foto berhasil dihapus!');
    }
}