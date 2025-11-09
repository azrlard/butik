<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\ProductVariant;

class CartController extends Controller
{
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
            // Use variant price if exists
            $harga = $variant->price_adjustment;
        } else {
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
            'category' => $product->category ? $product->category->nama_kategori : null
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
        $cartKey = $variantId ? "{$productId}-{$variantId}" : $productId;

        if ($quantity <= 0) {
            unset($cart[$cartKey]);
        } else {
            if (isset($cart[$cartKey])) {
                // Check stock
                if ($variantId) {
                    $variant = ProductVariant::find($variantId);
                    if ($variant && $variant->stock < $quantity) {
                        return response()->json(['error' => 'Insufficient stock'], 400);
                    }
                }

                $cart[$cartKey]['quantity'] = $quantity;
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
        $cartKey = $variantId ? "{$productId}-{$variantId}" : $productId;

        unset($cart[$cartKey]);
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
        return array_sum(array_column($cart, 'quantity'));
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
