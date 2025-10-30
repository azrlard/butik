// Product detail functions
function showProductDetail(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    const isCustom = product.tipe_produk === 'custom';
    const stockText = isCustom ? 'Custom Order Available' : (availableSizes.length > 0 ? `Stok tersedia: ${availableSizes[0].stock} pcs` : `Stok tersedia: ${product.stok} pcs`);
    const stockClass = isCustom ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800';

    // Get selected size and variant info
    let selectedSize = null;
    let selectedVariant = null;
    let availableSizes = [];
    let displayPrice = product.harga;

    if (!isCustom && product.variants && product.variants.length > 0) {
        availableSizes = product.variants;
        selectedSize = availableSizes[0].size; // Default to first size
        selectedVariant = availableSizes[0];
        displayPrice = selectedVariant.price_adjustment; // Use variant price
    }

    document.getElementById('modal-content').innerHTML = `
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                <div class="bg-gray-100 rounded-xl h-96 flex items-center justify-center mb-4">
                    <span class="text-8xl">${product.foto}</span>
                </div>
                <div class="grid grid-cols-4 gap-2">
                    ${Array(4).fill().map(() => `
                        <div class="bg-gray-100 rounded-lg h-20 flex items-center justify-center cursor-pointer hover:bg-gray-200 transition-colors">
                            <span class="text-2xl">${product.foto}</span>
                        </div>
                    `).join('')}
                </div>
            </div>
            <div class="space-y-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">${product.nama_produk}</h2>
                    <div class="flex items-center mb-4">
                        <span class="text-gray-600 mr-4">${product.terjual} terjual</span>
                        <span class="${stockClass} px-3 py-1 rounded-full text-sm font-medium">${isCustom ? 'Custom' : 'Ready Stock'}</span>
                    </div>
                    <p class="text-3xl font-bold text-indigo-600 mb-4" id="product-price">Rp ${displayPrice.toLocaleString('id-ID')}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
                    <p class="text-gray-600 leading-relaxed">${product.deskripsi}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600 mb-4" id="stock-display">${stockText}</p>
                </div>

                ${!isCustom && availableSizes.length > 0 ? `
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Ukuran</h3>
                        <div class="flex space-x-2 mb-6" id="size-buttons">
                            ${availableSizes.map(variant => `
                                <button onclick="selectSize('${variant.size}', ${variant.id}, ${variant.stock}, ${variant.price_adjustment})"
                                        class="size-btn border border-gray-300 px-4 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors ${variant.size === selectedSize ? 'border-indigo-600 text-indigo-600 bg-indigo-50' : ''} ${variant.stock === 0 ? 'opacity-50 cursor-not-allowed' : ''}"
                                        ${variant.stock === 0 ? 'disabled' : ''}>
                                    ${variant.size} ${variant.stock === 0 ? '(Habis)' : `(${variant.stock})`}
                                </button>
                            `).join('')}
                        </div>
                    </div>
                ` : ''}

                <div class="flex space-x-4">
                    <button onclick="addToCart(${product.id}, ${selectedVariant ? selectedVariant.id : 'null'}); closeModal();" class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-colors ${!isCustom && selectedVariant && selectedVariant.stock === 0 ? 'opacity-50 cursor-not-allowed' : ''}" ${!isCustom && selectedVariant && selectedVariant.stock === 0 ? 'disabled' : ''}>
                        ${isCustom ? 'Pesan Custom' : 'Tambah ke Keranjang'}
                    </button>
                    ${!isCustom ? `
                        <button onclick="buyNow(${product.id}, ${selectedVariant ? selectedVariant.id : 'null'}); closeModal();" class="flex-1 bg-yellow-400 text-gray-800 px-6 py-3 rounded-xl font-semibold hover:bg-yellow-300 transition-colors ${selectedVariant && selectedVariant.stock === 0 ? 'opacity-50 cursor-not-allowed' : ''}" ${selectedVariant && selectedVariant.stock === 0 ? 'disabled' : ''}>
                            Beli Sekarang
                        </button>
                    ` : `
                        <button onclick="navigateTo('custom'); closeModal();" class="flex-1 bg-yellow-400 text-gray-800 px-6 py-3 rounded-xl font-semibold hover:bg-yellow-300 transition-colors">
                            Custom Request
                        </button>
                    `}
                </div>
            </div>
        </div>
    `;

    // Load similar products
    const similarProducts = products.filter(p => p.kategori === product.kategori && p.id !== product.id).slice(0, 4);
    if (similarProducts.length > 0) {
        document.getElementById('modal-content').innerHTML += `
            <div class="mt-12">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Produk Serupa</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    ${similarProducts.map(p => `
                        <div class="bg-gray-50 rounded-lg p-4 text-center hover:bg-gray-100 transition-colors cursor-pointer" onclick="showProductDetail(${p.id})">
                            <div class="text-3xl mb-2">${p.foto}</div>
                            <h4 class="font-semibold text-sm text-gray-800 mb-1">${p.nama_produk}</h4>
                            <p class="text-indigo-600 font-bold text-sm">Rp ${p.harga.toLocaleString('id-ID')}</p>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    }

    const modal = document.getElementById('product-modal');
    if (modal) {
        modal.style.display = 'flex';
        modal.classList.add('show');
        console.log('Modal opened successfully for product:', productId);
    } else {
        console.error('Modal element not found! Cannot open modal for product:', productId);
    }
}

function selectSize(size, variantId, stock, price) {
    if (stock === 0) return; // Don't allow selection of out-of-stock items

    selectedSize = size;
    selectedVariant = { id: variantId, size: size, stock: stock, price_adjustment: price };

    // Update price display
    const priceElement = document.getElementById('product-price');
    if (priceElement) {
        priceElement.textContent = `Rp ${price.toLocaleString('id-ID')}`;
    }

    // Update stock display
    const stockElement = document.getElementById('stock-display');
    if (stockElement) {
        stockElement.textContent = `Stok tersedia: ${stock} pcs`;
    }

    // Update button styles
    const buttons = document.querySelectorAll('#size-buttons .size-btn');
    buttons.forEach(btn => {
        btn.classList.remove('border-indigo-600', 'text-indigo-600', 'bg-indigo-50');
    });

    // Highlight selected button
    event.target.classList.add('border-indigo-600', 'text-indigo-600', 'bg-indigo-50');
}

function buyNow(productId, variantId) {
    // For now, just add to cart and redirect to cart
    addToCart(productId, variantId);
    navigateTo('cart');
}

function closeModal() {
    const modal = document.getElementById('product-modal');
    if (modal) {
        modal.classList.remove('show');
        modal.classList.add('hidden');
    }
}