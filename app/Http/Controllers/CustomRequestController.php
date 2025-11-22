<?php

namespace App\Http\Controllers;

use App\Models\CustomRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // For frontend submissions, make user_id optional and default to 1
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'foto_referensi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'required|string',
            'harga_estimasi' => 'nullable|numeric|min:0',
            'product-category' => 'required|string|max:255',
        ]);

        // Check if user is authenticated for custom requests
        if (!$request->user_id && !Auth::check()) {
            return redirect()->back()->with('error', 'Silakan login terlebih dahulu untuk membuat custom request');
        }

        $data = [
            'user_id' => $request->user_id ?: (Auth::check() ? Auth::id() : 1), // Use authenticated user or default to 1
            'keterangan' => $request->keterangan,
            'harga_estimasi' => $request->harga_estimasi,
            'status' => 'pending',
            'product_category' => $request->{'product-category'},
        ];

        if ($request->hasFile('foto_referensi')) {
            $data['foto_referensi'] = $request->file('foto_referensi')->move(public_path('images'), time() . '.' . $request->file('foto_referensi')->getClientOriginalExtension());
            $data['foto_referensi'] = 'images/' . basename($data['foto_referensi']);
        }

        // Add custom request to session cart
        $cart = \Illuminate\Support\Facades\Session::get('cart', []);

        $cartItem = [
            'id' => 'custom_' . time(), // Unique id for custom
            'type' => 'custom',
            'nama_produk' => 'Custom Request - ' . $data['product_category'],
            'harga' => $data['harga_estimasi'] ?? 0,
            'quantity' => 1,
            'deskripsi' => $data['keterangan'],
            'foto' => isset($data['foto_referensi']) ? $data['foto_referensi'] : null,
            'product_category' => $data['product_category'],
        ];

        $cart[] = $cartItem;
        \Illuminate\Support\Facades\Session::put('cart', $cart);

        return redirect('/cart');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomRequest $customRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomRequest $customRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomRequest $customRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomRequest $customRequest)
    {
        //
    }
}
