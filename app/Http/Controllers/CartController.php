<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Check variant if provided
        if ($variantId) {
            $variant = ProductVariant::find($variantId);
            if (!$variant || $variant->product_id !== $productId) {
                return response()->json(['error' => 'Variant not found'], 404);
            }

            // Check stock
            if ($variant->stock < $quantity) {
                return response()->json(['error' => 'Insufficient stock'], 400);
            }
        } else {
            // For products without variants, check if it's ready stock
            if ($product->tipe_produk !== 'ready') {
                return response()->json(['error' => 'Product requires variant selection'], 400);
            }
        }

        $cartKey = $variantId ? "{$productId}-{$variantId}" : $productId;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                'product_id' => $productId,
                'variant_id' => $variantId,
                'quantity' => $quantity,
                'product' => $product,
                'variant' => $variantId ? ProductVariant::find($variantId) : null
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'count' => $this->getCartCount()
        ]);
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
