<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    // Menangani proses login
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Periksa apakah email dan password cocok
    $user = User::where('email', $request->email)->first();

    if ($user && $user->password === $request->password) {
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
}


    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Menangani proses registrasi
    // Menangani proses registrasi
public function register(Request $request)
{
    // Validasi data form registrasi
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:6',
    ]);

    // Membuat user baru tanpa hashing password
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,  // Simpan password tanpa hashing
    ]);

    // Login otomatis setelah registrasi
    Auth::login($user);

    // Redirect ke halaman dashboard setelah sukses registrasi
    return redirect()->route('dashboard');
}
}
