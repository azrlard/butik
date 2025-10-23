<!-- Page: Cart -->
<div id="cart" class="page">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Keranjang Belanja</h1>

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

                        <button onclick="checkout()" class="w-full bg-indigo-600 text-white px-6 py-4 rounded-xl text-lg font-semibold hover:bg-indigo-700 transition-colors mb-4">
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