<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LikeController;

// Halaman utama
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Authentication Routes (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Protected Routes (harus login)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Album
    Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
    Route::get('/album/create', [AlbumController::class, 'create'])->name('album.create');
    Route::post('/album', [AlbumController::class, 'store'])->name('album.store');
    Route::get('/album/{id}', [AlbumController::class, 'show'])->name('album.show');
    Route::delete('/album/{id}', [AlbumController::class, 'destroy'])->name('album.destroy');
    
    // Foto
    Route::get('/foto', [FotoController::class, 'index'])->name('foto.index');
    Route::get('/foto/create', [FotoController::class, 'create'])->name('foto.create');
    Route::post('/foto', [FotoController::class, 'store'])->name('foto.store');
    Route::get('/foto/{id}', [FotoController::class, 'show'])->name('foto.show');
    Route::delete('/foto/{id}', [FotoController::class, 'destroy'])->name('foto.destroy');
    
    // Komentar (AJAX)
    Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');
    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('komentar.destroy');
    
    // Like (AJAX)
    Route::post('/like/toggle', [LikeController::class, 'toggle'])->name('like.toggle');
});