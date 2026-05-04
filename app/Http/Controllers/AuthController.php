<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Halaman Login
    public function showLogin() { return view('auth.login'); }

    // Halaman Register
    public function showRegister() { return view('auth.register'); }

    // PROSES REGISTER
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required',
            'deskripsi_usaha' => 'required_if:role,penjual' // Wajib diisi jika pilih penjual
        ]);

        // Logika: Jika penjual, status PENDING. Jika user biasa, status ACTIVE.
        $status = ($request->role == 'penjual') ? 'pending' : 'active';

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $status,
            'deskripsi_usaha' => $request->deskripsi_usaha,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // PROSES LOGIN
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // CEK STATUS: Jika penjual masih pending, jangan kasih masuk
            if ($user->role == 'penjual' && $user->status == 'pending') {
                Auth::logout();
                return back()->with('error', 'Akun penjual Anda belum disetujui admin.');
            }

            $request->session()->regenerate();

            // REDIRECT sesuai role
            if ($user->role == 'admin') return redirect('/admin/dashboard');
            if ($user->role == 'penjual') return redirect('/penjual/dashboard');
            return redirect('/home');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // PROSES LOGOUT
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
