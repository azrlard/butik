@extends('layouts.app')

@section('title', 'Keranjang - Butik Online')

@section('content')
@php
    $currentPage = 'Keranjang Belanja';
@endphp
@include('shared.breadcrumb')

<!-- Page: Cart -->
<div x-data="cartComponent()" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif
    <h1 class="text-4xl md:text-5xl font-black text-text mb-8">Keranjang Belanja</h1>

    <!-- Empty Cart -->
    <div x-show="cart.length === 0" class="text-center py-20">
        <div class="text-8xl mb-6">🛒</div>
        <h2 class="text-2xl font-semibold text-secondary mb-4">Keranjang Anda Kosong</h2>
        <p class="text-accent mb-8">Mulai berbelanja dan tambahkan produk favorit Anda</p>
        <a href="/products" class="bg-primary text-background px-8 py-3 rounded-xl font-semibold hover:bg-secondary transition-colors">
            Mulai Belanja
        </a>
    </div>

    <!-- Cart Content -->
    <div x-show="cart.length > 0" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <div class="bg-background rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-secondary">
                    <h3 class="text-xl font-semibold text-text">Item Belanja</h3>
                </div>
                <div class="divide-y divide-secondary">
                    <template x-for="(item, index) in cart" :key="item.id">
                        <div class="p-6 flex items-center space-x-4">
                            <img :src="item.foto ? '/storage/' + item.foto : '👕'" :alt="item.nama_produk" class="w-20 h-20 object-cover rounded-lg">
                            <div class="flex-1">
                                <h4 class="font-semibold text-text" x-text="item.nama_produk"></h4>
                                <p class="text-accent text-sm" x-text="item.deskripsi || 'Deskripsi tidak tersedia'"></p>
                                <div class="flex items-center space-x-2 mt-2">
                                    <button @click="updateQuantity(index, item.quantity - 1)" class="w-8 h-8 bg-accent rounded-full flex items-center justify-center">-</button>
                                    <span x-text="item.quantity" class="w-8 text-center"></span>
                                    <button @click="updateQuantity(index, item.quantity + 1)" class="w-8 h-8 bg-accent rounded-full flex items-center justify-center">+</button>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-primary" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(item.harga * item.quantity)"></div>
                                <button @click="removeItem(index)" class="text-red-500 hover:text-red-700 mt-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-background rounded-xl shadow-lg p-6 sticky top-24">
                <h3 class="text-xl font-semibold text-text mb-6">Ringkasan Pesanan</h3>
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-accent">
                        <span>Total Item</span>
                        <span x-text="cart.length + ' item'"></span>
                    </div>
                    <div class="flex justify-between text-accent">
                        <span>Total Harga</span>
                        <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal)"></span>
                    </div>
                    <hr class="border-secondary">
                    <div class="flex justify-between text-xl font-bold text-text">
                        <span>Total</span>
                        <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal)"></span>
                    </div>
                </div>

                <button @click="showCheckout = true" class="w-full bg-primary text-background px-6 py-4 rounded-xl text-lg font-semibold hover:bg-secondary transition-colors mb-4">
                    Checkout Sekarang
                </button>
                <a href="/products" class="w-full bg-accent text-text px-6 py-3 rounded-xl font-semibold hover:bg-secondary hover:text-background transition-colors inline-block text-center">
                    Lanjut Belanja
                </a>
            </div>
        </div>
    </div>

    <!-- Checkout Modal -->
    <div x-show="showCheckout" x-cloak x-transition.opacity x-transition.duration.300ms style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div x-show="showCheckout" x-transition x-transition.duration.300ms x-transition.delay.100ms style="display: none;" class="bg-background rounded-xl shadow-2xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-text">Form Checkout</h3>
                    <button @click="showCheckout = false" class="text-accent hover:text-secondary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="processCheckout" method="POST" action="/orders">
                    @csrf
                    <input type="hidden" name="user_id" :value="{{ auth()->check() ? auth()->id() : '1' }}">
                    <div class="space-y-4 mb-6">
                        <div>
                            <label for="customer-name" class="block text-sm font-medium text-text mb-1">Nama Lengkap</label>
                            <input type="text" id="customer-name" name="customer_name" required
                                   class="w-full px-3 py-2 border border-secondary rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="customer-email" class="block text-sm font-medium text-text mb-1">Email</label>
                            <input type="email" id="customer-email" name="customer_email" required
                                   class="w-full px-3 py-2 border border-secondary rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="customer-phone" class="block text-sm font-medium text-text mb-1">Nomor Telepon</label>
                            <input type="tel" id="customer-phone" name="customer_phone" required
                                   class="w-full px-3 py-2 border border-secondary rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="shipping-address" class="block text-sm font-medium text-text mb-1">Alamat Pengiriman</label>
                            <textarea id="shipping-address" name="alamat_pengiriman" rows="3" required
                                      placeholder="Masukkan alamat lengkap pengiriman"
                                      class="w-full px-3 py-2 border border-secondary rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none"></textarea>
                        </div>

                        <div>
                            <label for="payment-method" class="block text-sm font-medium text-text mb-1">Metode Pembayaran</label>
                            <select id="payment-method" name="metode_pembayaran" required
                                    class="w-full px-3 py-2 border border-secondary rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Pilih metode pembayaran</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cod">Cash on Delivery</option>
                                <option value="ewallet">E-Wallet</option>
                            </select>
                        </div>
                    </div>

                    <div class="bg-accent rounded-lg p-4 mb-6">
                        <h4 class="font-semibold text-text mb-2">Ringkasan Pesanan</h4>
                        <div class="space-y-1 text-sm">
                            <div class="flex justify-between">
                                <span>Total Item:</span>
                                <span x-text="cart.length + ' item'"></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Total Harga:</span>
                                <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(total)"></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" @click="showCheckout = false"
                                class="flex-1 bg-accent text-text px-4 py-2 rounded-lg font-semibold hover:bg-secondary hover:text-background transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                                class="flex-1 bg-primary text-background px-4 py-2 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            Konfirmasi Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function cartComponent() {
    return {
        cart: @json(session('cart', [])),
        showCheckout: false,

        init() {
            console.log('Cart component initialized with:', this.cart.length, 'items');
            console.log('Cart data:', this.cart);
            // Ensure modal is hidden on page load
            this.showCheckout = false;
            // Force hide modals on init
            this.$nextTick(() => {
                const modals = document.querySelectorAll('[x-show="showCheckout"]');
                modals.forEach(modal => modal.style.display = 'none');
            });
        },

        get subtotal() {
            return this.cart.reduce((sum, item) => sum + (item.harga * item.quantity), 0);
        },

        get total() {
            return this.subtotal;
        },

        updateQuantity(index, newQuantity) {
            if (newQuantity < 1) return;

            // Update quantity in Alpine.js
            this.cart[index].quantity = newQuantity;

            // Send AJAX request to update server-side cart
            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: this.cart[index].product_id,
                    variant_id: this.cart[index].variant_id,
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Failed to update cart:', data.error);
                    // Revert quantity if update failed
                    this.cart[index].quantity = this.cart[index].quantity;
                }
            })
            .catch(error => {
                console.error('Error updating cart:', error);
                // Revert quantity if update failed
                this.cart[index].quantity = this.cart[index].quantity;
            });
        },

        removeItem(index) {
            const item = this.cart[index];

            // Remove from Alpine.js cart immediately for UI responsiveness
            this.cart.splice(index, 1);

            // Send AJAX request to remove from server-side cart
            fetch('/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: item.product_id,
                    variant_id: item.variant_id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Failed to remove item:', data.error);
                    // Add item back if removal failed
                    this.cart.splice(index, 0, item);
                }
            })
            .catch(error => {
                console.error('Error removing item:', error);
                // Add item back if removal failed
                this.cart.splice(index, 0, item);
            });
        },

        processCheckout() {
            // Add cart items as hidden inputs to form
            const form = document.querySelector('form[action="/orders"]');
            // Clear existing cart inputs
            form.querySelectorAll('input[name^="items"]').forEach(input => input.remove());

            this.cart.forEach((item, index) => {
                const productIdInput = document.createElement('input');
                productIdInput.type = 'hidden';
                productIdInput.name = `items[${index}][product_id]`;
                productIdInput.value = item.product_id;
                form.appendChild(productIdInput);

                const quantityInput = document.createElement('input');
                quantityInput.type = 'hidden';
                quantityInput.name = `items[${index}][jumlah]`;
                quantityInput.value = item.quantity;
                form.appendChild(quantityInput);

                if (item.variant_id) {
                    const variantInput = document.createElement('input');
                    variantInput.type = 'hidden';
                    variantInput.name = `items[${index}][variant_id]`;
                    variantInput.value = item.variant_id;
                    form.appendChild(variantInput);
                }
            });

            // Submit the form
            form.submit();
        },

        init() {
            console.log('Cart component initialized with:', this.cart.length, 'items');
            console.log('Cart data:', this.cart);
            // Ensure modal is hidden on page load
            this.showCheckout = false;
            // Force hide modals on init
            this.$nextTick(() => {
                const modals = document.querySelectorAll('[x-show="showCheckout"]');
                modals.forEach(modal => modal.style.display = 'none');
            });
        }
    }
}
</script>
@endsection

