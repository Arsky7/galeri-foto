<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Tampilkan halaman register
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'Username' => 'required|string|max:50|unique:users,Username',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|min:6|confirmed',
            'NamaLengkap' => 'required|string|max:100',
            'Alamat' => 'nullable|string',
        ], [
            'Username.required' => 'Username wajib diisi',
            'Username.unique' => 'Username sudah digunakan',
            'Email.required' => 'Email wajib diisi',
            'Email.email' => 'Format email tidak valid',
            'Email.unique' => 'Email sudah terdaftar',
            'Password.required' => 'Password wajib diisi',
            'Password.min' => 'Password minimal 6 karakter',
            'Password.confirmed' => 'Konfirmasi password tidak cocok',
            'NamaLengkap.required' => 'Nama lengkap wajib diisi',
        ]);

        $user = User::create([
            'Username' => $request->Username,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'NamaLengkap' => $request->NamaLengkap,
            'Alamat' => $request->Alamat,
        ]);

        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }
}