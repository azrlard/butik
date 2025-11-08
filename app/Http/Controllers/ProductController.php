<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'variants']);

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        // Filter by type
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('tipe_produk', $request->type);
        }

        $products = $query->get();

        // Ensure proper JSON response format
        return response()->json($products->map(function($product) {
            return [
                'id' => $product->id,
                'nama_produk' => $product->nama_produk,
                'deskripsi' => $product->deskripsi,
                'harga' => $product->harga,
                'stok' => $product->stok,
                'foto' => $product->foto,
                'tipe_produk' => $product->tipe_produk,
                'category_id' => $product->category_id,
                'category' => $product->category,
                'variants' => $product->variants,
                'terjual' => $product->terjual ?? 0
            ];
        }));
    }

    /**
     * Display products page with server-side data
     */
    public function indexView(Request $request)
    {
        $categories = \App\Models\Category::all();

        $query = Product::with(['category', 'variants']);

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        // Filter by type
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('tipe_produk', $request->type);
        }

        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'LIKE', '%' . $search . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
        }

        $products = $query->get();

        return view('products.index', compact('categories', 'products'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $productData = $product->load(['category', 'variants']);

        // Ensure proper JSON response format
        return response()->json([
            'id' => $productData->id,
            'nama_produk' => $productData->nama_produk,
            'deskripsi' => $productData->deskripsi,
            'harga' => $productData->harga,
            'stok' => $productData->stok,
            'foto' => $productData->foto,
            'tipe_produk' => $productData->tipe_produk,
            'category_id' => $productData->category_id,
            'category' => $productData->category,
            'variants' => $productData->variants,
            'terjual' => $productData->terjual ?? 0
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Show product detail page
     */
    public function showDetail($id)
    {
        $product = Product::with(['category', 'variants'])->findOrFail($id);
        return view('products.detail', compact('product'));
    }
}
