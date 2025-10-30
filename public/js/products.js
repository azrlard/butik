// Load functions
function loadCategories() {
    const container = document.getElementById('categories-grid');
    if (!container) return; // Safety check

    container.innerHTML = categories.map(category => `
        <div onclick="filterByCategory('${category.id}')" class="bg-gray-100 rounded-xl p-8 text-center hover:shadow-xl transition-all transform hover:scale-105 cursor-pointer">
            <h3 class="text-xl font-bold mb-3 text-gray-800">${category.nama_kategori}</h3>
            <p class="text-sm text-gray-600">${category.deskripsi || 'Kategori produk'}</p>
        </div>
    `).join('');
}

function loadFeaturedProducts() {
    const container = document.getElementById('featured-products');
    if (!container) return; // Safety check

    const featured = products.filter(p => p.tipe_produk === 'ready').slice(0, 4);
    container.innerHTML = featured.map(product => createProductCard(product)).join('');
}

function navigateToProductDetail(productId) {
    // Navigate to product detail page
    window.location.href = `/products/${productId}`;
}

function showProductDetail(productId) {
    // Show modal with product detail
    const modal = document.getElementById('product-modal');
    const modalContent = document.getElementById('modal-content');

    if (!modal || !modalContent) {
        console.error('Modal elements not found');
        return;
    }

    // Load product detail from API
    fetch(`/api/products/${productId}`)
        .then(response => response.json())
        .then(product => {
            modalContent.innerHTML = createProductDetailModal(product);
            modal.classList.remove('hidden');
            modal.classList.add('show');
            console.log('Modal opened for product:', productId);
        })
        .catch(error => {
            console.error('Error loading product detail:', error);
            modalContent.innerHTML = '<p class="text-center text-gray-500">Gagal memuat detail produk</p>';
            modal.classList.remove('hidden');
            modal.classList.add('show');
        });
}

function createProductDetailModal(product) {
    if (!product) return '<p class="text-center text-gray-500">Produk tidak ditemukan</p>';

    const isCustom = product.tipe_produk === 'custom';
    const stockText = isCustom ? 'Custom Order Available' : (product.variants && product.variants.length > 0 ? `Stok tersedia: ${product.variants[0].stock} pcs` : `Stok tersedia: ${product.stok} pcs`);
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

    return `
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                <div class="bg-gray-100 rounded-xl h-80 flex items-center justify-center mb-4">
                    <span class="text-6xl">${product.foto}</span>
                </div>
                <div class="grid grid-cols-4 gap-2">
                    ${Array(4).fill().map(() => `
                        <div class="bg-gray-100 rounded-lg h-16 flex items-center justify-center cursor-pointer hover:bg-gray-200 transition-colors">
                            <span class="text-xl">${product.foto}</span>
                        </div>
                    `).join('')}
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">${product.nama_produk}</h2>
                    <div class="flex items-center mb-3">
                        <span class="text-gray-600 mr-3">${product.terjual ?? 0} terjual</span>
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${stockClass}">
                            ${isCustom ? 'Custom' : 'Ready Stock'}
                        </span>
                    </div>
                    <p class="text-3xl font-bold text-indigo-600 mb-4" id="modal-product-price">Rp ${displayPrice.toLocaleString('id-ID')}</p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">${product.deskripsi}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600 mb-3" id="modal-stock-display">${stockText}</p>
                </div>

                ${!isCustom && availableSizes.length > 0 ? `
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Ukuran</h4>
                        <div class="flex space-x-2 mb-4" id="modal-size-buttons">
                            ${availableSizes.map(variant => `
                                <button onclick="selectModalSize('${variant.size}', ${variant.id}, ${variant.stock}, ${variant.price_adjustment})"
                                        class="modal-size-btn border border-gray-300 px-3 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors text-sm ${variant.size === selectedSize ? 'border-indigo-600 text-indigo-600 bg-indigo-50' : ''} ${variant.stock === 0 ? 'opacity-50 cursor-not-allowed' : ''}"
                                        ${variant.stock === 0 ? 'disabled' : ''}>
                                    ${variant.size} ${variant.stock === 0 ? '(Habis)' : `(${variant.stock})`}
                                </button>
                            `).join('')}
                        </div>
                    </div>
                ` : ''}

                <div class="flex space-x-3">
                    <button onclick="addToCart(${product.id}, ${selectedVariant ? selectedVariant.id : 'null'}); closeModal(); showNotification('${product.nama_produk} berhasil ditambahkan ke keranjang!');"
                            class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors text-sm ${!isCustom && selectedVariant && selectedVariant.stock === 0 ? 'opacity-50 cursor-not-allowed' : ''}" ${!isCustom && selectedVariant && selectedVariant.stock === 0 ? 'disabled' : ''}>
                        Tambah ke Keranjang
                    </button>
                    ${!isCustom ? `
                        <button onclick="buyNow(${product.id}, ${selectedVariant ? selectedVariant.id : 'null'}); closeModal();"
                                class="flex-1 bg-yellow-400 text-gray-800 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition-colors text-sm ${selectedVariant && selectedVariant.stock === 0 ? 'opacity-50 cursor-not-allowed' : ''}" ${selectedVariant && selectedVariant.stock === 0 ? 'disabled' : ''}>
                            Beli Sekarang
                        </button>
                    ` : `
                        <button onclick="navigateTo('custom'); closeModal();"
                                class="flex-1 bg-yellow-400 text-gray-800 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition-colors text-sm">
                            Custom Request
                        </button>
                    `}
                </div>
            </div>
        </div>
    `;
}

function loadAllProducts() {
    const container = document.getElementById('products-grid');
    const loadingIndicator = document.getElementById('loading-indicator');

    if (!container) return; // Safety check

    // Show loading
    if (loadingIndicator) {
        loadingIndicator.style.display = 'block';
    }

    // Load products
    container.innerHTML = filteredProducts.map(product => createProductCard(product)).join('');

    // Hide loading
    if (loadingIndicator) {
        loadingIndicator.style.display = 'none';
    }

    // Load type filter options after products are loaded
    loadTypeFilter();
}


function createProductCard(product) {
    const isCustom = product.tipe_produk === 'custom';

    // Calculate price range for products with variants
    let priceDisplay = `Rp ${product.harga.toLocaleString('id-ID')}`;
    if (!isCustom && product.variants && product.variants.length > 0) {
        const prices = product.variants.map(v => v.price_adjustment);
        const minPrice = Math.min(...prices);
        const maxPrice = Math.max(...prices);
        if (minPrice !== maxPrice) {
            priceDisplay = `Rp ${minPrice.toLocaleString('id-ID')} - Rp ${maxPrice.toLocaleString('id-ID')}`;
        } else {
            priceDisplay = `Rp ${minPrice.toLocaleString('id-ID')}`;
        }
    }

    return `
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all transform hover:scale-105 cursor-pointer" onclick="showProductDetail(${product.id})">
            <div class="relative bg-gray-100 h-48 flex items-center justify-center">
                <span class="text-6xl">${product.foto}</span>
                <div class="absolute top-3 right-3">
                    <span class="${isCustom ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800'} px-2 py-1 rounded-full text-xs font-bold">${isCustom ? 'Custom' : 'Ready'}</span>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">${product.nama_produk}</h4>
                <div class="flex items-center mb-3">
                    <span class="text-sm text-gray-600">${product.terjual} terjual</span>
                </div>
                <p class="text-2xl font-bold text-indigo-600 mb-4">${priceDisplay}</p>
            </div>
        </div>
    `;
}

// Filter functions
function filterByCategory(category) {
    navigateTo('products');
    setTimeout(() => {
        document.getElementById('category-filter').value = category;
        filterProducts();
    }, 100);
}

function filterProducts() {
    const categoryFilter = document.getElementById('category-filter').value;
    const typeFilter = document.getElementById('type-filter').value;

    filteredProducts = products.filter(product => {
        const categoryMatch = categoryFilter === 'all' || product.category_id == categoryFilter;
        const typeMatch = typeFilter === 'all' || product.tipe_produk === typeFilter;
        return categoryMatch && typeMatch;
    });

    loadAllProducts();
}

function loadCategoryFilter() {
    const container = document.getElementById('category-filter');
    if (!container) return; // Safety check

    const currentValue = container.value || 'all';
    container.innerHTML = '<option value="all">Semua Kategori</option>' +
        categories.map(category => `<option value="${category.id}">${category.nama_kategori}</option>`).join('');
    container.value = currentValue;
}

function selectModalSize(size, variantId, stock, price) {
    if (stock === 0) return; // Don't allow selection of out-of-stock items

    // Update price display
    const priceElement = document.getElementById('modal-product-price');
    if (priceElement) {
        priceElement.textContent = `Rp ${price.toLocaleString('id-ID')}`;
    }

    // Update stock display
    const stockElement = document.getElementById('modal-stock-display');
    if (stockElement) {
        stockElement.textContent = `Stok tersedia: ${stock} pcs`;
    }

    // Update button styles
    const buttons = document.querySelectorAll('#modal-size-buttons .modal-size-btn');
    buttons.forEach(btn => {
        btn.classList.remove('border-indigo-600', 'text-indigo-600', 'bg-indigo-50');
    });

    // Highlight selected button
    event.target.classList.add('border-indigo-600', 'text-indigo-600', 'bg-indigo-50');
}

function loadTypeFilter() {
    const container = document.getElementById('type-filter');
    if (!container) return; // Safety check

    const currentValue = container.value || 'all';

    // Get unique product types from current products
    const uniqueTypes = [...new Set(products.map(product => product.tipe_produk))];

    container.innerHTML = '<option value="all">Semua Tipe</option>' +
        uniqueTypes.map(type => {
            const label = type === 'ready' ? 'Ready Stock' : type === 'custom' ? 'Custom Order' : type;
            return `<option value="${type}">${label}</option>`;
        }).join('');

    container.value = currentValue;
}
