// Cart functions
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    if (product.tipe_produk === 'custom') {
        showNotification(`${product.nama_produk} - Silakan buat custom request untuk produk ini`);
        navigateTo('custom');
        return;
    }

    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: product.id,
            nama_produk: product.nama_produk,
            harga: product.harga,
            foto: product.foto,
            quantity: 1
        });
    }

    updateCartCount();
    showNotification(`${product.nama_produk} berhasil ditambahkan ke keranjang!`);
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCartCount();
    loadCartItems();
    showNotification('Produk berhasil dihapus dari keranjang');
}

function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(productId);
        } else {
            updateCartCount();
            loadCartItems();
        }
    }
}

function updateCartCount() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('cart-count').textContent = totalItems;
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
                    <h4 class="font-semibold text-gray-800 text-lg">${item.nama_produk}</h4>
                    <p class="text-gray-600">Rp ${item.harga.toLocaleString('id-ID')}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <button onclick="updateQuantity(${item.id}, -1)" class="bg-gray-200 hover:bg-gray-300 rounded-full w-10 h-10 flex items-center justify-center transition-colors font-bold">-</button>
                    <span class="font-semibold text-lg w-8 text-center">${item.quantity}</span>
                    <button onclick="updateQuantity(${item.id}, 1)" class="bg-gray-200 hover:bg-gray-300 rounded-full w-10 h-10 flex items-center justify-center transition-colors font-bold">+</button>
                </div>
                <div class="text-right">
                    <p class="font-bold text-gray-800 text-lg">Rp ${itemTotal.toLocaleString('id-ID')}</p>
                    <button onclick="removeFromCart(${item.id})" class="text-red-600 hover:text-red-800 transition-colors text-sm font-medium">Hapus</button>
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

function checkout() {
    if (cart.length === 0) return;

    showNotification('Checkout berhasil! Terima kasih atas pesanan Anda. Tim kami akan segera memproses pesanan.');
    cart = [];
    updateCartCount();
    loadCartItems();
}