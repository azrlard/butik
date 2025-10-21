<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'produk_id', 'foto_request', 'keterangan', 'status', 'harga_estimasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
