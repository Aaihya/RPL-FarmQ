<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

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

        // UBAH BARIS INI: dari 'katalog.index' menjadi 'welcome'
        return view('welcome', compact('products')); 
    }

    // ================= DASHBOARD PENJUAL =================
    public function dashboard()
    {
        $products = Product::where('user_id', auth()->id())->get();
        $totalProduk = $products->count();
        $terjual = $products->where('is_sold', true)->count();

        return view('penjual.dashboard', compact('totalProduk','terjual'));
    }

    // ================= TAMBAH PRODUK =================
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required|numeric',
            'weight' => 'required',
            'age' => 'required',
            'location' => 'required',
            'health_status' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products','public');
        }

        $data['user_id'] = auth()->id();

        Product::create($data);

        return back()->with('success','Produk ditambahkan');
    }
}
