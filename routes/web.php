<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorProfileController; // 🛒 Tambahkan Import Ini

/*
|--------------------------------------------------------------------------
| Web Routes - FarmQ Marketplace
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama: Langsung lempar ke Login
Route::get('/', function() {
    return redirect()->route('login');
});

// 2. Auth Routes (Bebas diakses sebelum login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']); 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// 3. Protected Routes: Harus Login (Auth)
Route::middleware('auth')->group(function () {
    
    // Proses Keluar (Logout)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Group Khusus ADMIN
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () { 
            return "Halaman Dashboard Admin"; 
        })->name('admin.dashboard');
    });

    // Group Khusus PENJUAL (Dashboard & Pengaturan Profil Toko)
    Route::middleware('role:penjual')->group(function () {
        Route::get('/penjual/dashboard', [ProductController::class, 'dashboard'])->name('penjual.dashboard');
        
        // 🛠️ SELESAI: Rute Profil Vendor dimasukkan ke sini agar aman terlindungi role penjual
        Route::get('/penjual/profile', [VendorProfileController::class, 'edit'])->name('penjual.profile.edit');
        Route::put('/penjual/profile', [VendorProfileController::class, 'update'])->name('penjual.profile.update');
    });

    // Jalur CRUD Produk (Aman di bawah Auth)
    Route::resource('products', ProductController::class);

    // Route untuk User Biasa / Pembeli
    Route::get('/home', function () {
        return "Selamat Datang Pembeli!";
    })->name('home');

});