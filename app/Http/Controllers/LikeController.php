<?php

namespace App\Http\Controllers;

use App\Models\LikeFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Toggle like (AJAX)
    public function toggle(Request $request)
    {
        $request->validate([
            'FotoID' => 'required|exists:foto,FotoID',
        ]);

        $fotoId = $request->FotoID;
        $userId = Auth::id();

        $existingLike = LikeFoto::where('FotoID', $fotoId)
            ->where('UserID', $userId)
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $isLiked = false;
        } else {
            // Like
            LikeFoto::create([
                'FotoID' => $fotoId,
                'UserID' => $userId,
                'TanggalLike' => now(),
            ]);
            $isLiked = true;
        }

        $likeCount = LikeFoto::where('FotoID', $fotoId)->count();

        return response()->json([
            'success' => true,
            'data' => [
                'isLiked' => $isLiked,
                'likeCount' => $likeCount,
            ]
        ]);
    }
}