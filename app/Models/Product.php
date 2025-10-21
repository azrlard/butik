<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'nama_produk', 'deskripsi', 'harga', 'stok', 'foto', 'tipe_produk',
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
}
