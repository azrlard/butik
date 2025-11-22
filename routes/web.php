<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomRequestController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'indexView'])->name('products.index');

Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'showDetail'])->name('products.detail');

Route::get('/cart', function () {
    return view('cart.index');
});

Route::get('/custom', function () {
    return view('custom.index');
});

Route::get('/categories', [CategoryController::class, 'indexView'])->name('categories.index');

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

// Form submission routes
Route::post('/custom-request', [CustomRequestController::class, 'store'])->name('custom.request');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// Payment routes
Route::middleware(['auth'])->group(function () {
    Route::get('/orders/{order}/payment', [OrderController::class, 'payment'])->name('payment');
    Route::post('/orders/{order}/mark-paid', [OrderController::class, 'markPaid'])->name('mark.paid');
});

// Midtrans callback routes
Route::post('/midtrans/callback', [OrderController::class, 'midtransCallback'])->name('midtrans.callback');
Route::post('/midtrans/notification', [OrderController::class, 'midtransNotification'])->name('midtrans.notification');

// Cart routes
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/count', [App\Http\Controllers\CartController::class, 'getCartCount'])->name('cart.count');