<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $pendingOrders = [];
        if (Auth::check()) {
            $pendingOrders = Order::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->whereHas('orderItems', function($q) {
                    $q->whereNotNull('custom_request_id');
                })
                ->with('orderItems.customRequest')
                ->get();
        }
        return view('cart.index', compact('cart', 'pendingOrders'));
    }

    /**
     * Get cart items from session
     */
    public function getCart()
    {
        $cart = Session::get('cart', []);
        return response()->json($cart);
    }

    /**
     * Add item to cart
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'variant_id' => 'nullable|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $productId = $request->product_id;
        $variantId = $request->variant_id;
        $quantity = $request->quantity;

        $cart = Session::get('cart', []);

        // Check if product exists
        $product = Product::with('category')->find($productId);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Check variant if provided
        if ($variantId) {
            $variant = ProductVariant::find($variantId);
            if (!$variant || $variant->product_id !== $productId) {
                return response()->json(['error' => 'Variant not found'], 404);
            }
            // Use variant price
            $harga = $variant->price_adjustment;
        } else {
            // Use product price (for ready, it's min variant price)
            $harga = $product->harga;
        }

        // Create cart item with consistent structure
        $cartItem = [
            'id' => $productId, // For frontend compatibility
            'product_id' => $productId,
            'variant_id' => $variantId,
            'quantity' => $quantity,
            'nama_produk' => $product->nama_produk,
            'harga' => $harga,
            'deskripsi' => $product->deskripsi,
            'foto' => $product->foto,
            'tipe_produk' => $product->tipe_produk,
            'category' => $product->category ? $product->category->nama_kategori : null,
            'variant_size' => $variant ? $variant->size : null
        ];

        // Cek apakah item sudah ada di cart
        $existingIndex = $this->findCartItemIndex($cart, $productId, $variantId);

        if ($existingIndex !== false) {
            // Update quantity jika sudah ada
            $cart[$existingIndex]['quantity'] += $quantity;
        } else {
            // Tambah item baru
            $cart[] = $cartItem;
        }

        Session::put('cart', $cart);

        Log::info('Cart updated', [
            'cart_count' => count($cart),
            'total_quantity' => $this->getCartCount()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => $this->getCartCount(),
            'cart' => $cart // Return full cart for debugging
        ]);
    }

    // Helper method untuk mencari item di cart
    private function findCartItemIndex($cart, $productId, $variantId)
    {
        foreach ($cart as $index => $item) {
            if ($item['product_id'] == $productId && $item['variant_id'] == $variantId) {
                return $index;
            }
        }
        return false;
    }

    /**
     * Update cart item
     */
    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'variant_id' => 'nullable|integer',
            'quantity' => 'required|integer|min:0'
        ]);

        $productId = $request->product_id;
        $variantId = $request->variant_id;
        $quantity = $request->quantity;

        $cart = Session::get('cart', []);
        $index = $this->findCartItemIndex($cart, $productId, $variantId);

        if ($index !== false) {
            if ($quantity <= 0) {
                unset($cart[$index]);
                $cart = array_values($cart); // Reindex array
            } else {
                // Check stock
                if ($variantId) {
                    $variant = ProductVariant::find($variantId);
                    if ($variant && $variant->stock < $quantity) {
                        return response()->json(['error' => 'Insufficient stock'], 400);
                    }
                }

                $cart[$index]['quantity'] = $quantity;
            }
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'count' => $this->getCartCount()
        ]);
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'variant_id' => 'nullable|integer'
        ]);

        $productId = $request->product_id;
        $variantId = $request->variant_id;

        $cart = Session::get('cart', []);
        $index = $this->findCartItemIndex($cart, $productId, $variantId);

        if ($index !== false) {
            unset($cart[$index]);
            $cart = array_values($cart); // Reindex array
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'count' => $this->getCartCount()
        ]);
    }

    /**
     * Get cart count
     */
    public function getCartCount()
    {
        $cart = Session::get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return response()->json(['count' => $count]);
    }

    /**
     * Remove pending order
     */
    public function removePendingOrder(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($order->status !== 'pending') {
            return response()->json(['error' => 'Cannot remove this order'], 400);
        }

        $order->update(['status' => 'cancelled']);

        // Also cancel the custom request
        $customRequest = $order->orderItems->first()->customRequest ?? null;
        if ($customRequest) {
            $customRequest->update(['status' => 'rejected']);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove custom item from cart
     */
    public function removeCustom(Request $request)
    {
        $request->validate(['index' => 'required|integer']);
        $cart = Session::get('cart', []);
        if (isset($cart[$request->index]) && $cart[$request->index]['type'] === 'custom') {
            unset($cart[$request->index]);
            $cart = array_values($cart); // Reindex
            Session::put('cart', $cart);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'error' => 'Item not found']);
    }

    /**
     * Clear cart
     */
    public function clearCart()
    {
        Session::forget('cart');
        return response()->json(['success' => true]);
    }
}
