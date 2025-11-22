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

    <!-- Empty Cart -->
    <div x-show="cart.length === 0 && pendingOrders.length === 0" class="text-center py-20">
        <div class="text-8xl mb-6 text-[#8B4513]">🛒</div>
        <h2 class="text-2xl font-semibold text-[#8B4513] mb-4">Keranjang Anda Kosong</h2>
        <p class="text-[#3E2723] mb-8 opacity-80">Mulai berbelanja dan tambahkan produk favorit Anda</p>
        <a href="/products" class="bg-[#8B4513] text-white px-8 py-3 rounded-xl font-semibold hover:bg-[#D2691E] transition-colors">
            Mulai Belanja
        </a>
    </div>

    <!-- Cart Content -->
    <div x-show="cart.length > 0 || pendingOrders.length > 0" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-[#F5F5DC]">
                <div class="p-6 border-b border-[#D2691E]/30 bg-[#F5F5DC]">
                    <h3 class="text-xl font-semibold text-[#3E2723]">Item Belanja</h3>
                </div>
                <div class="divide-y divide-[#F5F5DC]">
                    <template x-for="(item, index) in cart" :key="item.product_id + '-' + (item.variant_id || 'no-variant')">
                        <div class="p-6 flex items-center space-x-4 hover:bg-[#F5F5DC]/50 transition-colors">
                            <img :src="item.type === 'custom' ? item.foto : (item.foto ? '/storage/' + item.foto : '👕')" :alt="item.nama_produk"
                                  class="w-20 h-20 object-cover rounded-lg border border-[#D2691E]/20">
                            <div class="flex-1">
                                <h4 class="font-semibold text-[#3E2723]" x-text="item.nama_produk"></h4>
                                <p class="text-[#3E2723] text-sm opacity-75 mt-1" x-text="item.deskripsi || 'Deskripsi tidak tersedia'"></p>
                                <p v-if="item.variant_size" class="text-[#8B4513] text-xs font-medium mt-1" x-text="'Ukuran: ' + item.variant_size"></p>
                                <div class="flex items-center space-x-2 mt-3">
                                    <button @click="updateQuantity(index, item.quantity - 1)" 
                                            class="w-8 h-8 bg-[#8B4513] text-white rounded-full flex items-center justify-center hover:bg-[#D2691E] transition-colors">-</button>
                                    <span x-text="item.quantity" class="w-8 text-center font-semibold text-[#3E2723]"></span>
                                    <button @click="updateQuantity(index, item.quantity + 1)" 
                                            class="w-8 h-8 bg-[#8B4513] text-white rounded-full flex items-center justify-center hover:bg-[#D2691E] transition-colors">+</button>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-[#8B4513] text-lg" 
                                     x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(item.harga * item.quantity)"></div>
                                <button @click="removeItem(index)" 
                                        class="text-red-600 hover:text-red-800 mt-2 transition-colors p-1 rounded hover:bg-red-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Pending Orders -->
            <div x-show="pendingOrders.length > 0" class="mt-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-[#F5F5DC]">
                    <div class="p-6 border-b border-[#D2691E]/30 bg-[#F5F5DC]">
                        <h3 class="text-xl font-semibold text-[#3E2723]">Pesanan Custom Pending</h3>
                    </div>
                    <div class="divide-y divide-[#F5F5DC]">
                        <template x-for="(order, index) in pendingOrders" :key="order.id">
                            <div class="p-6 hover:bg-[#F5F5DC]/50 transition-colors">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-[#3E2723]">Custom Request #<span x-text="order.id"></span></h4>
                                        <p class="text-[#3E2723] text-sm opacity-75 mt-1" x-text="order.orderItems && order.orderItems[0] && order.orderItems[0].custom_request ? order.orderItems[0].custom_request.keterangan : 'Custom order'"></p>
                                        <p class="text-[#8B4513] text-xs font-medium mt-1">Status: <span x-text="order.status"></span></p>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-[#8B4513] text-lg" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(order.total_harga)"></div>
                                        <button @click="removePendingOrder(index)" class="text-red-600 hover:text-red-800 mt-2 transition-colors p-1 rounded hover:bg-red-50">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24 border border-[#F5F5DC]">
                <h3 class="text-xl font-semibold text-[#3E2723] mb-6">Ringkasan Pesanan</h3>
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-[#3E2723]">
                        <span class="opacity-80">Total Item</span>
                        <span class="font-semibold" x-text="cart.length + ' item'"></span>
                    </div>
                    <div class="flex justify-between text-[#3E2723]">
                        <span class="opacity-80">Total Harga</span>
                        <span class="font-semibold" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal)"></span>
                    </div>
                    <hr class="border-[#D2691E]/30">
                    <div class="flex justify-between text-xl font-bold text-[#3E2723]">
                        <span>Total</span>
                        <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal)"></span>
                    </div>
                </div>

                <button @click="showCheckout = true" 
                        class="w-full bg-[#8B4513] text-white px-6 py-4 rounded-xl text-lg font-semibold hover:bg-[#D2691E] transition-colors mb-4 shadow-lg">
                    Checkout Sekarang
                </button>
                <a href="/products" 
                   class="w-full bg-[#F5F5DC] text-[#3E2723] px-6 py-3 rounded-xl font-semibold hover:bg-[#D2691E] hover:text-white transition-colors inline-block text-center border border-[#D2691E]/30">
                    Lanjut Belanja
                </a>
            </div>
        </div>
    </div>

    <!-- Checkout Modal -->
    <div x-show="showCheckout" x-cloak x-transition.opacity x-transition.duration.300ms style="display: none;" 
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div x-show="showCheckout" x-transition x-transition.duration.300ms x-transition.delay.100ms style="display: none;" 
             class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto border border-[#D2691E]/20">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-[#3E2723]">Form Checkout</h3>
                    <button @click="showCheckout = false" 
                            class="text-[#3E2723] hover:text-[#8B4513] transition-colors p-1 rounded hover:bg-[#F5F5DC]">
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
                            <label for="customer-name" class="block text-sm font-medium text-[#3E2723] mb-1">Nama Lengkap</label>
                            <input type="text" id="customer-name" name="customer_name" required
                                   class="w-full px-3 py-2 border border-[#D2691E]/30 rounded-lg focus:ring-2 focus:ring-[#8B4513] focus:border-transparent text-[#3E2723] bg-white">
                        </div>

                        <div>
                            <label for="customer-email" class="block text-sm font-medium text-[#3E2723] mb-1">Email</label>
                            <input type="email" id="customer-email" name="customer_email" required
                                   class="w-full px-3 py-2 border border-[#D2691E]/30 rounded-lg focus:ring-2 focus:ring-[#8B4513] focus:border-transparent text-[#3E2723] bg-white">
                        </div>

                        <div>
                            <label for="customer-phone" class="block text-sm font-medium text-[#3E2723] mb-1">Nomor Telepon</label>
                            <input type="tel" id="customer-phone" name="customer_phone" required
                                   class="w-full px-3 py-2 border border-[#D2691E]/30 rounded-lg focus:ring-2 focus:ring-[#8B4513] focus:border-transparent text-[#3E2723] bg-white">
                        </div>

                        <div>
                            <label for="shipping-address" class="block text-sm font-medium text-[#3E2723] mb-1">Alamat Pengiriman</label>
                            <textarea id="shipping-address" name="alamat_pengiriman" rows="3" required
                                      placeholder="Masukkan alamat lengkap pengiriman"
                                      class="w-full px-3 py-2 border border-[#D2691E]/30 rounded-lg focus:ring-2 focus:ring-[#8B4513] focus:border-transparent text-[#3E2723] bg-white resize-none"></textarea>
                        </div>

                        <div>
                            <label for="payment-method" class="block text-sm font-medium text-[#3E2723] mb-1">Metode Pembayaran</label>
                            <select id="payment-method" name="metode_pembayaran" required
                                    class="w-full px-3 py-2 border border-[#D2691E]/30 rounded-lg focus:ring-2 focus:ring-[#8B4513] focus:border-transparent text-[#3E2723] bg-white">
                                <option value="">Pilih metode pembayaran</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                        </div>
                    </div>

                    <div class="bg-[#F5F5DC] rounded-lg p-4 mb-6 border border-[#D2691E]/20">
                        <h4 class="font-semibold text-[#3E2723] mb-2">Ringkasan Pesanan</h4>
                        <div class="space-y-1 text-sm text-[#3E2723]">
                            <div class="flex justify-between">
                                <span class="opacity-80">Total Item:</span>
                                <span class="font-semibold" x-text="cart.length + ' item'"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="opacity-80">Total Harga:</span>
                                <span class="font-semibold" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(total)"></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" @click="showCheckout = false"
                                class="flex-1 bg-[#F5F5DC] text-[#3E2723] px-4 py-2 rounded-lg font-semibold hover:bg-[#D2691E] hover:text-white transition-colors border border-[#D2691E]/30">
                            Batal
                        </button>
                        <button type="submit"
                                class="flex-1 bg-[#8B4513] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#D2691E] transition-colors">
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
        cart: @json($cart),
        pendingOrders: @json($pendingOrders),
        cartCount: 0,
        showCheckout: false,

        init() {
            console.log('Cart component initialized with:', this.cart.length, 'items');
            console.log('Cart data:', this.cart);
            this.showCheckout = false;
            this.updateCartCount();
            this.$nextTick(() => {
                const modals = document.querySelectorAll('[x-show="showCheckout"]');
                modals.forEach(modal => modal.style.display = 'none');
            });
        },

        updateCartCount() {
            this.cartCount = this.cart.reduce((sum, item) => sum + item.quantity, 0) + this.pendingOrders.length;
            // Update navbar cart count
            const desktopCartCount = document.getElementById('cart-count-desktop');
            const mobileCartCount = document.getElementById('cart-count-mobile');
            if (desktopCartCount) desktopCartCount.textContent = this.cartCount;
            if (mobileCartCount) mobileCartCount.textContent = this.cartCount;
        },

        get subtotal() {
            const cartTotal = this.cart.reduce((sum, item) => sum + (item.harga * item.quantity), 0);
            const pendingTotal = this.pendingOrders.reduce((sum, order) => sum + order.total_harga, 0);
            return cartTotal + pendingTotal;
        },

        get total() {
            return this.subtotal;
        },

        updateQuantity(index, newQuantity) {
            if (newQuantity < 1) return;
            this.cart[index].quantity = newQuantity;
            this.updateCartCount();

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
                    this.cart[index].quantity = this.cart[index].quantity;
                    this.updateCartCount();
                }
            })
            .catch(error => {
                console.error('Error updating cart:', error);
                this.cart[index].quantity = this.cart[index].quantity;
                this.updateCartCount();
            });
        },

        removeItem(index) {
            const item = this.cart[index];
            const removedItem = this.cart.splice(index, 1)[0];
            this.updateCartCount();

            if (item.type === 'custom') {
                // For custom items, just remove from session
                fetch('/cart/remove-custom', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        index: index
                    })
                })
                .catch(error => {
                    console.error('Error removing custom item:', error);
                    // Restore if failed
                    this.cart.splice(index, 0, removedItem);
                    this.updateCartCount();
                });
            } else {
                // For product items
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
                        this.cart.splice(index, 0, removedItem);
                        this.updateCartCount();
                    }
                })
                .catch(error => {
                    console.error('Error removing item:', error);
                    this.cart.splice(index, 0, removedItem);
                    this.updateCartCount();
                });
            }
        },

        removePendingOrder(index) {
            const order = this.pendingOrders[index];
            fetch('/cart/remove-pending/' + order.id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to remove order');
                }
            })
            .catch(error => {
                console.error('Error removing order:', error);
                alert('Error removing order');
            });
        },

        processCheckout() {
            const form = document.querySelector('form[action="/orders"]');
            form.querySelectorAll('input[name^="items"]').forEach(input => input.remove());

            this.cart.forEach((item, index) => {
                if (item.type === 'custom') {
                    // For custom items
                    const typeInput = document.createElement('input');
                    typeInput.type = 'hidden';
                    typeInput.name = `items[${index}][type]`;
                    typeInput.value = 'custom';
                    form.appendChild(typeInput);

                    const keteranganInput = document.createElement('input');
                    keteranganInput.type = 'hidden';
                    keteranganInput.name = `items[${index}][keterangan]`;
                    keteranganInput.value = item.deskripsi;
                    form.appendChild(keteranganInput);

                    const hargaInput = document.createElement('input');
                    hargaInput.type = 'hidden';
                    hargaInput.name = `items[${index}][harga]`;
                    hargaInput.value = item.harga;
                    form.appendChild(hargaInput);

                    const categoryInput = document.createElement('input');
                    categoryInput.type = 'hidden';
                    categoryInput.name = `items[${index}][product_category]`;
                    categoryInput.value = item.product_category;
                    form.appendChild(categoryInput);


                    const fotoInput = document.createElement('input');
                    fotoInput.type = 'hidden';
                    fotoInput.name = `items[${index}][foto_referensi]`;
                    fotoInput.value = item.foto;
                    form.appendChild(fotoInput);

                    const quantityInput = document.createElement('input');
                    quantityInput.type = 'hidden';
                    quantityInput.name = `items[${index}][jumlah]`;
                    quantityInput.value = item.quantity;
                    form.appendChild(quantityInput);
                } else {
                    // For product items
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
                }
            });

            form.submit();
        }
    }
}
</script>
@endsection
