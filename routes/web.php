<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomRequestController;

Route::get('/', function () {
    $categories = App\Models\Category::all();
    $products = App\Models\Product::with('category', 'variants')->get();
    return view('home.index', compact('categories', 'products'));
});

Route::get('/home', function () {
    $categories = App\Models\Category::all();
    $products = App\Models\Product::with('category', 'variants')->get();
    return view('home.index', compact('categories', 'products'));
});

Route::get('/products', function (Request $request) {
    $categories = App\Models\Category::all();
    $products = App\Models\Product::with('category', 'variants')->get();

    return view('products.index', compact('categories', 'products'));
});

Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'showDetail'])->name('products.detail');

Route::get('/cart', function () {
    return view('cart.index');
});

Route::get('/custom', function () {
    return view('custom.index');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Form submission routes (without CSRF for simplicity)
Route::post('/custom-request', [CustomRequestController::class, 'store'])->name('custom.request')->withoutMiddleware(['csrf']);

// Keep API routes for backward compatibility (can be removed later if not needed)
Route::prefix('api')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store'])->withoutMiddleware(['csrf', 'web']);
    Route::post('/custom-requests', [CustomRequestController::class, 'store'])->withoutMiddleware(['csrf', 'web']);
});

