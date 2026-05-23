<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ================= KATALOG (PEMBELI) =================
    public function katalog(Request $request)
    {
        $query = Product::where('is_sold', false);

        if ($request->type) {
            $query->where('type', $request->type);
        }

        $products = $query->latest()->get();

        return view('welcome', compact('products')); 
    }

    // ================= DASHBOARD PENJUAL =================
    public function dashboard()
    {
        // Jika belum login (auth()->id() kosong), sistem akan otomatis mengambil produk milik user ID 1
        $vendorId = auth()->id() ?? 1;
        
        $products = Product::where('user_id', $vendorId)->latest()->get();
        
        $totalProduk = $products->count();
        $terjual = $products->where('is_sold', true)->count();

        return view('penjual.dashboard', compact('products', 'totalProduk', 'terjual'));
    }

    // ================= TAMBAH PRODUK =================
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'type'          => 'required|string',
            'price'         => 'required|numeric',
            'weight'        => 'required|numeric',
            'age'           => 'required|numeric',
            'location'      => 'required|string|max:255',
            'health_status' => 'required|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Gunakan User ID yang login, jika tidak ada (testing) gunakan ID 1
        $validatedData['user_id'] = auth()->id() ?? 1;
        $validatedData['is_sold'] = false;

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validatedData);

        return redirect()->route('penjual.dashboard')->with('success', 'Hewan qurban baru berhasil dipasang!');
    }

    // ================= FORM EDIT PRODUK =================
    public function edit(Product $product)
    {
        // Bypass hak akses untuk testing jika belum login
        $currentUserId = auth()->id() ?? 1;
        if ($product->user_id !== $currentUserId) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        return view('penjual.edit', compact('product'));
    }

    // ================= PROSES UPDATE PRODUK (FIX UPDATE GAMBAR) =================
    public function update(Request $request, Product $product)
    {
        // Bypass hak akses untuk keperluan testing jika belum login resmi
        $currentUserId = auth()->id() ?? 1;
        if ($product->user_id !== $currentUserId) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // 1. Perbaikan aturan validasi gambar agar meloloskan semua jenis ekstensi modern
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'type'          => 'required|in:Sapi,Kambing,Domba',
            'price'         => 'required|numeric',
            'weight'        => 'required|numeric',
            'age'           => 'required|numeric',
            'location'      => 'required|string',
            'health_status' => 'required|string',
            'is_sold'       => 'required|boolean',
            'image'         => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:3072' // Ditambah webp & batas 3MB agar aman
        ]);

        // 2. Mengecek apakah ada file gambar baru yang dikirim dari form
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            // Hapus file fisik gambar lama dari local storage agar tidak menumpuk sampah data
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            // Simpan gambar baru ke folder 'products' di dalam disk public
            $path = $request->file('image')->store('products', 'public');
            
            // Masukkan path baru secara paksa ke dalam array eksekusi data
            $data['image'] = $path;
        } else {
            // Jika user sama sekali tidak memilih file gambar baru, pastikan jalur gambar lama tidak hilang
            $data['image'] = $product->image;
        }

        // 3. Jalankan perintah pembaruan database
        $product->update($data);

        return redirect()->route('penjual.dashboard')->with('success', 'Data hewan dan foto berhasil diperbarui!');
    }
    // ================= PROSES HAPUS PRODUK =================
    public function destroy(Product $product)
    {
        // Bypass hak akses untuk testing jika belum login
        $currentUserId = auth()->id() ?? 1;
        if ($product->user_id !== $currentUserId) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Hewan qurban berhasil dihapus dari katalog!');
    }

    // ================= HALAMAN FORM TAMBAH PRODUK =================
    public function create()
    {
        return view('products.create');
    }

    // ================= DETAIL PRODUK =================
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}