<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - FarmQ Marketplace
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama: Langsung lempar ke Login
Route::get('/', function() {
    return redirect()->route('login');
});

// 2. Auth Routes: Hanya bisa diakses jika BELUM login (Guest)
// Route::middleware('guest')->group(function () {
//     Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
//     Route::post('/register', [AuthController::class, 'register']);
// });

// 3. Protected Routes: Harus Login (Auth)
Route::middleware('auth')->group(function () {
    
    // Proses Keluar
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Group Khusus ADMIN
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () { 
            return "Halaman Dashboard Admin"; // Ganti ke view('admin.dashboard') jika sudah ada filenya
        })->name('admin.dashboard');
    });

    // Group Khusus PENJUAL
    // Route::middleware('role:penjual')->group(function () {
    //     // Menembak langsung ke file resources/views/welcome.blade.php sesuai screenshot
    //     Route::get('/penjual/dashboard', function () {
    //         return view('welcome');
    //     })->name('penjual.dashboard');

    //     // Route untuk simpan produk
    //     Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    // });

    // Route untuk User Biasa / Pembeli (Opsional)
    Route::get('/home', function () {
        return "Selamat Datang Pembeli!";
    })->name('home');

});

    Route::get('/penjual/dashboard', function () {
    return view('welcome');
    })->name('penjual.dashboard');

    Route::middleware('role:penjual')->group(function () {
        Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    });