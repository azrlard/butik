<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/categories', function () {
    $categories = App\Models\Category::with('products')->get();
    return view('categories.index', compact('categories'));
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/')->with('success', 'Login berhasil!');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->withInput($request->only('email'));
})->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang!');
})->name('register.post');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'Anda telah berhasil logout');
})->name('logout');

// Protected routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', function () {
        return view('user.orders');
    })->name('orders');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::get('/settings', function () {
        return view('user.settings');
    })->name('settings');
});

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

