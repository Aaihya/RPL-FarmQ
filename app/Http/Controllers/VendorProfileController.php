<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VendorProfileController extends Controller
{
    /**
     * Menampilkan halaman form edit profil vendor
     */
    public function edit()
    {
        // Mengambil data vendor yang sedang login. 
        // Jika belum mengaktifkan Auth, akan otomatis mengambil User dengan ID 1 untuk testing.
        $user = auth()->user() ?? \App\Models\User::find(1);
        
        if (!$user) {
            abort(404, 'Data vendor tidak ditemukan. Pastikan tabel users sudah terisi data.');
        }

        return view('penjual.profile', compact('user'));
    }

    /**
     * Memproses pembaharuan data profil vendor ke database
     */
    public function update(Request $request)
    {
        $user = auth()->user() ?? \App\Models\User::find(1);

        // Validasi inputan dari form
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'shop_name'       => 'nullable|string|max:255',
            'phone_number'    => 'nullable|numeric',
            'deskripsi_usaha' => 'nullable|string', // Menggunakan kolom asli bawaan kelompokmu
            'avatar'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048' // Maksimal 2MB
        ]);

        // Logika jika vendor mengunggah foto profil toko baru
        if ($request->hasFile('avatar')) {
            // Hapus foto lama di storage jika sebelumnya sudah pernah ada foto
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Simpan foto baru ke folder 'public/avatars'
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Jalankan perintah update ke database
        $user->update($data);

        return redirect()->back()->with('success', 'Profil toko Anda berhasil diperbarui!');
    }
}