<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    // Mengizinkan kolom-kolom ini diisi lewat form CRUD
    protected $fillable = [
        'name', 
        'type', 
        'price', 
        'weight', 
        'age', 
        'location', 
        'health_status', 
        'image', 
        'is_sold', 
        'user_id'
    ];

    // Hubungan relasi: Produk ini milik seorang Penjual/User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}