<?php

namespace App\Http\Controllers;

use App\Models\KomentarFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Simpan komentar (AJAX)
    public function store(Request $request)
    {
        $request->validate([
            'FotoID' => 'required|exists:foto,FotoID',
            'IsiKomentar' => 'required|string|max:500',
        ]);

        $komentar = KomentarFoto::create([
            'FotoID' => $request->FotoID,
            'UserID' => Auth::id(),
            'IsiKomentar' => $request->IsiKomentar,
            'TanggalKomentar' => now(),
        ]);

        $komentar->load('user');

        return response()->json([
            'success' => true,
            'data' => [
                'KomentarID' => $komentar->KomentarID,
                'IsiKomentar' => $komentar->IsiKomentar,
                'TanggalKomentar' => $komentar->TanggalKomentar->format('d M Y'),
                'user' => [
                    'NamaLengkap' => $komentar->user->NamaLengkap,
                ]
            ]
        ]);
    }

    // Hapus komentar
    public function destroy($id)
    {
        $komentar = KomentarFoto::where('KomentarID', $id)
            ->where('UserID', Auth::id())
            ->firstOrFail();

        $komentar->delete();

        return response()->json(['success' => true]);
    }
}