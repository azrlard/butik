<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomRequestController;
use App\Models\Product;
use App\Models\Category;

Route::get('/', function () {
    $productsData = Product::with('category')->get();
    $categories = Category::all();
    return view('welcome', compact('productsData', 'categories'));
});

Route::get('/home', function () {
    return view('home.index');
});

Route::get('/products', function () {
    return view('products.index');
});

Route::get('/cart', function () {
    return view('cart.index');
});

Route::get('/custom', function () {
    return view('custom.index');
});

// Form submission routes (without CSRF for simplicity)
Route::post('/custom-request', [CustomRequestController::class, 'store'])->name('custom.request')->withoutMiddleware(['csrf']);

// API routes for frontend data fetching (without CSRF for simplicity)
Route::prefix('api')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store'])->withoutMiddleware(['csrf', 'web']);
});