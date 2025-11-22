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
            'foto_request' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_referensi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'required|string',
            'harga_estimasi' => 'nullable|numeric|min:0',
            'customer-name' => 'required|string|max:255',
            'customer-email' => 'required|email|max:255',
            'customer-phone' => 'required|string|max:20',
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
            // Store customer info in keterangan for now
            'customer_name' => $request->{'customer-name'},
            'customer_email' => $request->{'customer-email'},
            'customer_phone' => $request->{'customer-phone'},
            'product_category' => $request->{'product-category'},
        ];

        if ($request->hasFile('foto_request')) {
            $data['foto_request'] = $request->file('foto_request')->store('custom-requests', 'public');
        }

        if ($request->hasFile('foto_referensi')) {
            $data['foto_referensi'] = $request->file('foto_referensi')->store('custom-requests', 'public');
        }

        $customRequest = CustomRequest::create($data);

        // Create order for custom request
        $order = Order::create([
            'user_id' => $data['user_id'],
            'total_harga' => $data['harga_estimasi'] ?? 0,
            'status' => 'pending',
            'metode_pembayaran' => 'pending', // Will be set later
            'alamat_pengiriman' => 'Custom request - akan ditentukan nanti',
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'],
        ]);

        // Create order item linked to custom request
        OrderItem::create([
            'order_id' => $order->id,
            'custom_request_id' => $customRequest->id,
            'jumlah' => 1,
            'harga_satuan' => $data['harga_estimasi'] ?? 0,
            'subtotal' => $data['harga_estimasi'] ?? 0,
        ]);

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
