<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'nama_produk', 'deskripsi', 'harga', 'foto', 'tipe_produk',
    ];

    protected $attributes = [
        'harga' => 0,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customRequests()
    {
        return $this->hasMany(CustomRequest::class, 'produk_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function getHargaAttribute()
    {
        if ($this->tipe_produk === 'custom') {
            return $this->attributes['harga'] ?? 0;
        }

        // For ready stock products, get price from variants or return 0
        return $this->variants()->min('price_adjustment') ?? 0;
    }

    public function getStokAttribute()
    {
        if ($this->tipe_produk === 'custom') {
            return 999; // Unlimited stock for custom products
        }

        // For ready stock products, sum all variant stocks
        return $this->variants()->sum('stock');
    }
}
