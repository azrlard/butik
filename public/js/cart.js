// Helper function to check if user is logged in
function isUserLoggedIn() {
    // Check if user is authenticated via Laravel session
    const loggedIn = (typeof window.isLoggedIn !== 'undefined' && window.isLoggedIn === true) ||
                     (typeof isLoggedIn !== 'undefined' && isLoggedIn === true);
    const userIdValid = (typeof window.userId !== 'undefined' && window.userId !== null && window.userId !== 'null') ||
                        (typeof userId !== 'undefined' && userId !== null && userId !== 'null');

    console.log('Checking login status:', {
        window_isLoggedIn: window.isLoggedIn,
        global_isLoggedIn: isLoggedIn,
        window_userId: window.userId,
        global_userId: userId,
        loggedIn,
        userIdValid
    });

    return loggedIn && userIdValid;
}

// Cart functions
function addToCart(productId, variantId = null) {
    // Check if user is logged in
    if (!isUserLoggedIn()) {
        showNotification('Silakan login terlebih dahulu untuk menambahkan produk ke keranjang');
        window.location.href = '/login';
        return;
    }

    const product = products.find(p => p.id === productId);
    if (!product) {
        console.error('Product not found:', productId, 'Available products:', products);
        return;
    }

    if (product.tipe_produk === 'custom') {
        showNotification(`${product.nama_produk} - Silakan buat custom request untuk produk ini`);
        navigateTo('custom');
        return;
    }

    // For products with variants, variantId is required
    if (product.tipe_produk === 'ready' && product.variants && product.variants.length > 0 && !variantId) {
        showNotification('Silakan pilih ukuran terlebih dahulu!');
        return;
    }

    const cartItemId = variantId ? `${productId}-${variantId}` : productId;
    const existingItem = cart.find(item => item.cartItemId === cartItemId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        let selectedVariant = null;
        if (variantId) {
            selectedVariant = product.variants.find(v => v.id === variantId);
        }

        cart.push({
            cartItemId: cartItemId,
            id: product.id,
            variant_id: variantId,
            nama_produk: product.nama_produk,
            harga: product.harga + (selectedVariant ? selectedVariant.price_adjustment : 0),
            foto: product.foto,
            quantity: 1,
            size: selectedVariant ? selectedVariant.size : null,
            variant: selectedVariant
        });
    }

    updateCartCount();
    initializeCartDisplay(); // Update navbar display immediately
    console.log('Cart updated, current cart:', cart);
    showNotification(`${product.nama_produk}${selectedVariant ? ` (${selectedVariant.size})` : ''} berhasil ditambahkan ke keranjang!`);
}

function removeFromCart(cartItemId) {
    cart = cart.filter(item => item.cartItemId !== cartItemId);
    updateCartCount();
    initializeCartDisplay(); // Update navbar display immediately
    loadCartItems();
    showNotification('Produk berhasil dihapus dari keranjang');
}

function updateQuantity(cartItemId, change) {
    const item = cart.find(item => item.cartItemId === cartItemId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(cartItemId);
        } else {
            updateCartCount();
            initializeCartDisplay(); // Update navbar display immediately
            loadCartItems();
        }
    }
}

function updateCartCount() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = totalItems;
    }
    // Save to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
}

function loadCartItems() {
    const emptyCart = document.getElementById('cart-empty');
    const cartContent = document.getElementById('cart-content');
    const cartItems = document.getElementById('cart-items');
    const subtotalElement = document.getElementById('cart-subtotal');
    const taxElement = document.getElementById('cart-tax');
    const totalElement = document.getElementById('cart-total');

    if (cart.length === 0) {
        emptyCart.classList.remove('hidden');
        cartContent.classList.add('hidden');
        return;
    }

    emptyCart.classList.add('hidden');
    cartContent.classList.remove('hidden');

    let subtotal = 0;
    cartItems.innerHTML = cart.map(item => {
        const itemTotal = item.harga * item.quantity;
        subtotal += itemTotal;

        return `
            <div class="p-6 flex items-center space-x-4">
                <div class="bg-gray-100 rounded-lg p-3 flex-shrink-0">
                    <span class="text-3xl">${item.foto}</span>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-800 text-lg">${item.nama_produk}${item.size ? ` (${item.size})` : ''}</h4>
                    <p class="text-gray-600">Rp ${item.harga.toLocaleString('id-ID')}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <button onclick="updateQuantity('${item.cartItemId}', -1)" class="bg-gray-200 hover:bg-gray-300 rounded-full w-10 h-10 flex items-center justify-center transition-colors font-bold">-</button>
                    <span class="font-semibold text-lg w-8 text-center">${item.quantity}</span>
                    <button onclick="updateQuantity('${item.cartItemId}', 1)" class="bg-gray-200 hover:bg-gray-300 rounded-full w-10 h-10 flex items-center justify-center transition-colors font-bold">+</button>
                </div>
                <div class="text-right">
                    <p class="font-bold text-gray-800 text-lg">Rp ${itemTotal.toLocaleString('id-ID')}</p>
                    <button onclick="removeFromCart('${item.cartItemId}')" class="text-red-600 hover:text-red-800 transition-colors text-sm font-medium">Hapus</button>
                </div>
            </div>
        `;
    }).join('');

    const shipping = 15000;
    const tax = Math.round(subtotal * 0.1); // 10% tax
    const total = subtotal + shipping + tax;

    subtotalElement.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
    taxElement.textContent = `Rp ${tax.toLocaleString('id-ID')}`;
    totalElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
}

function showCheckoutForm() {
    // Check if user is logged in
    if (!isUserLoggedIn()) {
        showNotification('Silakan login terlebih dahulu untuk melakukan checkout');
        window.location.href = '/login';
        return;
    }

    if (cart.length === 0) {
        showNotification('Keranjang kosong. Silakan tambahkan produk terlebih dahulu.');
        return;
    }

    // Update modal summary
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const totalPrice = cart.reduce((sum, item) => sum + (item.harga * item.quantity), 0);

    document.getElementById('modal-total-items').textContent = `${totalItems} item`;
    document.getElementById('modal-total-price').textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;

    // Show modal
    document.getElementById('checkout-modal').classList.remove('hidden');
}

function closeCheckoutModal() {
    document.getElementById('checkout-modal').classList.add('hidden');
}

function closeSuccessModal() {
    document.getElementById('success-modal').classList.add('hidden');
}

async function processCheckout(event) {
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
    formData.append('user_id', '1');

    try {
        // Send order to API
        const response = await fetch('/api/orders', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: formData
        });

        if (response.ok) {
            const result = await response.json();

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
            const errorData = await response.json();
            throw new Error(errorData.message || 'Failed to create order');
        }
    } catch (error) {
        console.error('Checkout error:', error);
        showNotification('Terjadi kesalahan saat checkout. Silakan coba lagi.');
    }
}

function createCheckoutModal() {
    const modalHTML = `
        <div id="checkout-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Informasi Pengiriman</h3>
                        <button onclick="closeCheckoutModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form id="checkout-form" onsubmit="processCheckout(event)">
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
                                    <span id="modal-total-items">${cart.reduce((sum, item) => sum + item.quantity, 0)} item</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total Harga:</span>
                                    <span id="modal-total-price">Rp ${cart.reduce((sum, item) => sum + (item.harga * item.quantity), 0).toLocaleString('id-ID')}</span>
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
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);
}

function closeCheckoutModal() {
    const modal = document.getElementById('checkout-modal');
    if (modal) {
        modal.remove();
    }
}

function processCheckout(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    // Add cart items to form data
    cart.forEach((item, index) => {
        formData.append(`items[${index}][product_id]`, item.id);
        formData.append(`items[${index}][jumlah]`, item.quantity);
    });

    // Add user_id
    formData.append('user_id', '1');

    // Submit form via AJAX to API
    submitCheckout(formData);
}

async function submitCheckout(formData) {
    // Check if user is logged in before submitting
    if (!isUserLoggedIn()) {
        showNotification('Silakan login terlebih dahulu untuk menyelesaikan pesanan');
        window.location.href = '/login';
        return;
    }

    try {
        const response = await fetch('/api/orders', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: formData
        });

        if (response.ok) {
            const result = await response.json();

            // Close checkout modal
            closeCheckoutModal();

            // Show success notification
            showNotification(result.message);

            // Clear cart
            cart = [];
            updateCartCount();
            loadCartItems();

            // Navigate to cart page
            navigateTo('cart');

        } else {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Failed to create order');
        }
    } catch (error) {
        console.error('Checkout error:', error);
        showNotification('Terjadi kesalahan saat checkout. Silakan coba lagi.');
    }
}