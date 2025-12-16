<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan galeri semua foto dengan support AJAX untuk infinite scroll
     */
    public function index(Request $request)
    {
        // AJAX Request untuk Infinite Scroll
        if ($request->ajax()) {
            $fotos = Foto::with(['user', 'album'])
                ->withCount(['likes', 'komentars'])
                ->latest('TanggalUnggah')
                ->paginate(12);
            
            return response()->json([
                'success' => true,
                'data' => $fotos->items(),
                'current_page' => $fotos->currentPage(),
                'last_page' => $fotos->lastPage(),
                'has_more' => $fotos->hasMorePages(),
                'next_page_url' => $fotos->nextPageUrl(),
            ]);
        }

        // Normal Request
        $fotos = Foto::with(['user', 'album'])
            ->withCount(['likes', 'komentars'])
            ->latest('TanggalUnggah')
            ->paginate(12);

        return view('foto.index', compact('fotos'));
    }

    /**
     * Form upload foto
     */
    public function create()
    {
        $albums = Album::where('UserID', Auth::id())
            ->latest()
            ->get();
            
        return view('foto.create', compact('albums'));
    }

    /**
     * Simpan foto dengan compression otomatis
     */
    public function store(Request $request)
    {
        $request->validate([
            'JudulFoto' => 'required|string|max:100',
            'DeskripsiFoto' => 'nullable|string|max:1000',
            'AlbumID' => 'required|exists:album,AlbumID',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // Max 10MB
        ], [
            'JudulFoto.required' => 'Judul foto wajib diisi',
            'AlbumID.required' => 'Pilih album',
            'AlbumID.exists' => 'Album tidak valid',
            'foto.required' => 'File foto wajib diupload',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format: JPG, PNG, GIF, atau WebP',
            'foto.max' => 'Ukuran maksimal 10MB',
        ]);

        try {
            $file = $request->file('foto');
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.jpg';
            $mainPath = 'photos/' . $filename;
            $thumbPath = 'photos/thumb_' . $filename;
            
            // Compress dan simpan foto utama (max 1920px)
            $this->compressAndSave($file, $mainPath, 1920, 85);
            
            // Generate thumbnail (400x400)
            $this->compressAndSave($file, $thumbPath, 400, 80, true);
            
            // Simpan ke database
            $foto = Foto::create([
                'JudulFoto' => $request->JudulFoto,
                'DeskripsiFoto' => $request->DeskripsiFoto,
                'TanggalUnggah' => now(),
                'LokasiFile' => $mainPath,
                'AlbumID' => $request->AlbumID,
                'UserID' => Auth::id(),
            ]);
            
            // Log activity
            Log::info('Foto uploaded', [
                'foto_id' => $foto->FotoID,
                'user_id' => Auth::id(),
                'filename' => $filename
            ]);

            return redirect()
                ->route('foto.index')
                ->with('success', 'Foto berhasil diupload! (Auto-compressed ✓)');
                
        } catch (\Exception $e) {
            Log::error('Upload foto error: ' . $e->getMessage());
            
            return back()
                ->with('error', 'Gagal upload foto. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Detail foto dengan eager loading
     */
    public function show($id)
    {
        $foto = Foto::with([
            'user', 
            'album', 
            'likes.user', 
            'komentars' => function($query) {
                $query->with('user')->latest('TanggalKomentar');
            }
        ])->findOrFail($id);

        $isLiked = $foto->isLikedBy(Auth::id());
        
        // Increment view counter (optional)
        // $foto->increment('views');

        return view('foto.show', compact('foto', 'isLiked'));
    }

    /**
     * Hapus foto beserta file-nya
     */
    public function destroy($id)
    {
        try {
            $foto = Foto::where('FotoID', $id)
                ->where('UserID', Auth::id())
                ->firstOrFail();

            // Hapus file foto utama
            Storage::disk('public')->delete($foto->LokasiFile);
            
            // Hapus thumbnail
            $thumbPath = str_replace('photos/', 'photos/thumb_', $foto->LokasiFile);
            Storage::disk('public')->delete($thumbPath);
            
            // Hapus dari database (cascade akan hapus likes & komentars)
            $foto->delete();
            
            Log::info('Foto deleted', [
                'foto_id' => $id,
                'user_id' => Auth::id()
            ]);

            return redirect()
                ->route('foto.index')
                ->with('success', 'Foto berhasil dihapus!');
                
        } catch (\Exception $e) {
            Log::error('Delete foto error: ' . $e->getMessage());
            
            return back()->with('error', 'Gagal menghapus foto.');
        }
    }

    /**
     * PRIVATE: Compress dan save image menggunakan PHP GD
     */
    private function compressAndSave($file, $savePath, $maxSize, $quality, $crop = false)
    {
        // Detect image type
        $imageType = exif_imagetype($file->getPathname());
        
        // Create image resource
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($file->getPathname());
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($file->getPathname());
                break;
            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($file->getPathname());
                break;
            case IMAGETYPE_WEBP:
                $source = imagecreatefromwebp($file->getPathname());
                break;
            default:
                throw new \Exception('Unsupported image type');
        }
        
        $width = imagesx($source);
        $height = imagesy($source);
        
        if ($crop) {
            // Crop to square
            $newWidth = $newHeight = $maxSize;
            $size = min($width, $height);
            $x = ($width - $size) / 2;
            $y = ($height - $size) / 2;
            
            $destination = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled(
                $destination, $source,
                0, 0, $x, $y,
                $newWidth, $newHeight, $size, $size
            );
        } else {
            // Resize maintaining aspect ratio
            if ($width > $maxSize || $height > $maxSize) {
                if ($width > $height) {
                    $newWidth = $maxSize;
                    $newHeight = ($height / $width) * $maxSize;
                } else {
                    $newHeight = $maxSize;
                    $newWidth = ($width / $height) * $maxSize;
                }
            } else {
                $newWidth = $width;
                $newHeight = $height;
            }
            
            $destination = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preserve PNG transparency
            if ($imageType == IMAGETYPE_PNG) {
                imagealphablending($destination, false);
                imagesavealpha($destination, true);
                $transparent = imagecolorallocatealpha($destination, 255, 255, 255, 127);
                imagefilledrectangle($destination, 0, 0, $newWidth, $newHeight, $transparent);
            }
            
            imagecopyresampled(
                $destination, $source,
                0, 0, 0, 0,
                $newWidth, $newHeight, $width, $height
            );
        }
        
        // Save to storage
        $fullPath = storage_path('app/public/' . $savePath);
        $directory = dirname($fullPath);
        
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        
        // Save as JPEG with quality
        imagejpeg($destination, $fullPath, $quality);
        
        // Free memory
        imagedestroy($source);
        imagedestroy($destination);
        
        return $savePath;
    }
}