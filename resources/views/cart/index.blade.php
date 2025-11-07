@extends('layouts.app')

@section('title', 'Keranjang - Butik Online')

@section('content')
<!-- Page: Cart -->
<div id="cart">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-8">Keranjang Belanja</h1>

        <div id="cart-empty" class="text-center py-20">
            <div class="text-8xl mb-6">🛒</div>
            <h2 class="text-2xl font-semibold text-gray-600 mb-4">Keranjang Anda Kosong</h2>
            <p class="text-gray-500 mb-8">Mulai berbelanja dan tambahkan produk favorit Anda</p>
            <button onclick="navigateTo('products')" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-colors">
                Mulai Belanja
            </button>
        </div>

        <div id="cart-content" class="hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-800">Item Belanja</h3>
                        </div>
                        <div id="cart-items" class="divide-y divide-gray-200">
                            <!-- Cart items will be loaded here -->
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Ringkasan Pesanan</h3>
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span id="cart-subtotal">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Ongkos Kirim</span>
                                <span>Rp 15.000</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Pajak</span>
                                <span id="cart-tax">Rp 0</span>
                            </div>
                            <hr class="border-gray-200">
                            <div class="flex justify-between text-xl font-bold text-gray-800">
                                <span>Total</span>
                                <span id="cart-total">Rp 15.000</span>
                            </div>
                        </div>

                        <button onclick="showCheckoutForm()" class="w-full bg-indigo-600 text-white px-6 py-4 rounded-xl text-lg font-semibold hover:bg-indigo-700 transition-colors mb-4">
                            Checkout Sekarang
                        </button>
                        <button onclick="navigateTo('products')" class="w-full bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-300 transition-colors">
                            Lanjut Belanja
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    // Initialize cart when page loads
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Cart page loaded, initializing cart...');
        console.log('Current cart:', cart);
        console.log('Cart length:', cart.length);

        // Load cart items
        loadCartItems();

        // Update cart count in navbar (but don't override the global cart)
        initializeCartDisplay();
    });

    // Cart is already loaded in layout, but ensure it's available here
    if (typeof cart === 'undefined') {
        cart = JSON.parse(localStorage.getItem('cart')) || [];
    }

    function processCheckout(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        // Add cart items to form data
        cart.forEach((item, index) => {
            formData.append(`items[${index}][product_id]`, item.id);
            formData.append(`items[${index}][variant_id]`, item.variant_id || null);
            formData.append(`items[${index}][jumlah]`, item.quantity);
        });

        // Add user_id
        formData.append('user_id', userId);

        try {
            // Send order to API
            fetch('/api/orders', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: formData
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // Close checkout modal
                    closeCheckoutModal();

                    // Show success notification
                    showNotification(result.message);

                    // Clear cart
                    cart = [];
                    updateCartCount();
                    initializeCartDisplay(); // Update navbar display immediately
                    loadCartItems();

                    // Navigate to cart page
                    setTimeout(() => navigateTo('cart'), 100);
                } else {
                    throw new Error(result.message || 'Failed to create order');
                }
            })
            .catch(error => {
                console.error('Checkout error:', error);
                showNotification('Terjadi kesalahan saat checkout. Silakan coba lagi.');
            });

        } catch (error) {
            console.error('Checkout error:', error);
            showNotification('Terjadi kesalahan saat checkout. Silakan coba lagi.');
        }
    }
</script>

<!-- Checkout Form Modal -->
<div id="checkout-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Form Checkout</h3>
                <button onclick="closeCheckoutModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="checkout-form" onsubmit="processCheckout(event)" method="POST" action="/api/orders">
                @csrf
                <div class="space-y-4 mb-6">
                    <div>
                        <label for="customer-name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="customer-name" name="customer_name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="customer-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="customer-email" name="customer_email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="customer-phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="tel" id="customer-phone" name="customer_phone" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="shipping-address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Pengiriman</label>
                        <textarea id="shipping-address" name="alamat_pengiriman" rows="3" required
                                  placeholder="Masukkan alamat lengkap pengiriman"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"></textarea>
                    </div>

                    <div>
                        <label for="payment-method" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                        <select id="payment-method" name="metode_pembayaran" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Pilih metode pembayaran</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="cod">Cash on Delivery</option>
                            <option value="ewallet">E-Wallet</option>
                        </select>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h4 class="font-semibold text-gray-800 mb-2">Ringkasan Pesanan</h4>
                    <div class="space-y-1 text-sm">
                        <div class="flex justify-between">
                            <span>Total Item:</span>
                            <span id="modal-total-items">0 item</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Harga:</span>
                            <span id="modal-total-price">Rp 0</span>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <button type="button" onclick="closeCheckoutModal()"
                            class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                        Konfirmasi Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Pesanan Berhasil!</h3>
            <p class="text-gray-600 mb-6">Terima kasih atas pesanan Anda. Tim kami akan segera memproses pesanan.</p>
            <button onclick="closeSuccessModal()" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>