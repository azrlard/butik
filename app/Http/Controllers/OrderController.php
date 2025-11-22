<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.product'])->get();
        return response()->json($orders);
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
        try {
            // For web requests, expect form data from frontend
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'metode_pembayaran' => 'required|string',
                'alamat_pengiriman' => 'required|string',
                'customer_name' => 'required|string',
                'customer_email' => 'required|email',
                'customer_phone' => 'required|string',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.jumlah' => 'required|integer|min:1',
            ]);

            // Check if user is authenticated or matches the user_id
            if (!Auth::check() || Auth::id() != $request->user_id) {
                return redirect()->back()->with('error', 'Anda harus login untuk melakukan checkout');
            }

            $total = 0;
            $orderItems = [];

            // Parse cart items from request
            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $hargaSatuan = $product->harga;
                    $variant = null;

                    // Check if variant is selected
                    if (isset($item['variant_id']) && $item['variant_id']) {
                        $variant = \App\Models\ProductVariant::find($item['variant_id']);
                        if ($variant) {
                            $hargaSatuan += $variant->price_adjustment;
                        }
                    }

                    $subtotal = $hargaSatuan * $item['jumlah'];
                    $total += $subtotal;
                    $orderItems[] = [
                        'product_id' => $item['product_id'],
                        'variant_id' => $item['variant_id'] ?? null,
                        'jumlah' => $item['jumlah'],
                        'harga_satuan' => $hargaSatuan,
                        'harga' => $hargaSatuan,
                        'subtotal' => $subtotal,
                        'variant' => $variant,
                    ];
                } else {
                    throw new \Exception("Product with ID {$item['product_id']} not found");
                }
            }

            if (empty($orderItems)) {
                throw new \Exception("No valid items in cart");
            }

            $order = Order::create([
                'user_id' => $request->user_id,
                'total_harga' => $total,
                'status' => 'pending',
                'metode_pembayaran' => $request->metode_pembayaran,
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
            ]);

            foreach ($orderItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item['product_id'];
                $orderItem->variant_id = $item['variant_id'];
                $orderItem->custom_request_id = null;
                $orderItem->jumlah = $item['jumlah'];
                $orderItem->harga_satuan = $item['harga_satuan'];
                $orderItem->harga = $item['harga_satuan']; // Use harga_satuan for harga field
                $orderItem->subtotal = $item['subtotal'];
                $orderItem->save();

                // Decrease stock
                if (isset($item['variant']) && $item['variant']) {
                    $item['variant']->decrement('stock', $item['jumlah']);
                } else {
                    $product = Product::find($item['product_id']);
                    if ($product) {
                        $product->decrement('stok', $item['jumlah']);
                    }
                }
            }

            // Create Midtrans transaction
            $midtransService = new MidtransService();
            $snapToken = $midtransService->createTransaction($order);

            // Store snap token in session for payment page
            session(['snap_token_' . $order->id => $snapToken]);

            return redirect()->route('payment', ['order' => $order->id])->with('success', 'Pesanan Anda berhasil dibuat. Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat order: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Show payment page for the order.
     */
    public function payment(Order $order)
    {
        // Check if user owns the order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $snapToken = session('snap_token_' . $order->id);

        if (!$snapToken) {
            return redirect()->route('orders')->with('error', 'Token pembayaran tidak ditemukan.');
        }

        return view('orders.payment', compact('order', 'snapToken'));
    }

    /**
     * Handle Midtrans callback.
     */
    public function midtransCallback(Request $request)
    {
        $midtransService = new MidtransService();
        $notification = $request->all();

        $result = $midtransService->handleNotification($notification);

        if ($result) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'failed'], 400);
        }
    }

    /**
     * Handle Midtrans notification.
     */
    public function midtransNotification(Request $request)
    {
        $midtransService = new MidtransService();
        $notification = $request->all();

        $result = $midtransService->handleNotification($notification);

        if ($result) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'failed'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
