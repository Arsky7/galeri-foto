<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'Username' => 'required|string|max:50|unique:users,Username',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|min:6|confirmed',
            'NamaLengkap' => 'required|string|max:100',
            'Alamat' => 'nullable|string',
        ]);

        User::create([
            'Username' => $request->Username,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'NamaLengkap' => $request->NamaLengkap,
            'Alamat' => $request->Alamat,
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login terlebih dahulu.');
    }
}
