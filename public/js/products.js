// Load functions
function loadCategories() {
    const container = document.getElementById('categories-grid');
    const loadingIndicator = document.getElementById('categories-loading');

    console.log('Loading categories, container:', container, 'categories:', categories);

    if (!container) {
        console.error('Categories container not found!');
        return;
    }

    // Hide loading and show content
    if (loadingIndicator) {
        loadingIndicator.style.display = 'none';
    }
    container.style.display = 'grid';

    if (!categories || categories.length === 0) {
        container.innerHTML = '<p class="text-center text-gray-500 col-span-full">Tidak ada kategori tersedia</p>';
        console.log('No categories to display');
        return;
    }

    container.innerHTML = categories.map(category => `
        <div onclick="filterByCategory('${category.id}')" class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 text-center hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-300 transform hover:scale-105 cursor-pointer border border-gray-100 hover:border-indigo-200 group">
            <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">${category.icon || '👗'}</div>
            <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-indigo-700 transition-colors">${category.nama_kategori}</h3>
            <p class="text-sm text-gray-600 group-hover:text-gray-700 transition-colors">${category.deskripsi || 'Kategori produk'}</p>
        </div>
    `).join('');

    console.log('Categories loaded successfully:', categories.length, 'categories');

    // Force visibility
    container.style.display = 'grid';
    container.style.opacity = '1';
}

function loadFeaturedProducts() {
    const container = document.getElementById('featured-products');
    const loadingIndicator = document.getElementById('featured-products-loading');

    console.log('Loading featured products, container:', container, 'products:', products);

    if (!container) {
        console.error('Featured products container not found!');
        return;
    }

    if (!products || products.length === 0) {
        if (loadingIndicator) {
            loadingIndicator.style.display = 'none';
        }
        container.style.display = 'grid';
        container.innerHTML = '<p class="text-center text-gray-500 col-span-full">Tidak ada produk tersedia</p>';
        console.log('No products array or empty products');
        return;
    }

    const featured = products.filter(p => p.tipe_produk === 'ready').slice(0, 4);
    console.log('Featured products found:', featured.length, 'products');

    // Hide loading and show content
    if (loadingIndicator) {
        loadingIndicator.style.display = 'none';
    }
    container.style.display = 'grid';

    if (featured.length === 0) {
        container.innerHTML = '<p class="text-center text-gray-500 col-span-full">Tidak ada produk ready stock tersedia</p>';
        console.log('No featured products to display');
        return;
    }

    container.innerHTML = featured.map(product => createProductCard(product)).join('');
    console.log('Featured products loaded successfully');

    // Force visibility
    container.style.display = 'grid';
    container.style.opacity = '1';
}

function navigateToProductDetail(productId) {
    // Navigate to product detail page
    window.location.href = `/products/${productId}`;
}

function showProductDetail(productId) {
    console.log('showProductDetail called with productId:', productId);

    // Find product in local data first
    let product = products.find(p => p.id === productId);

    if (!product) {
        console.log('Product not found in local data, fetching from API...');
        // Fallback to API if not found locally
        fetch(`/api/products/${productId}`)
            .then(response => response.json())
            .then(data => {
                product = data;
                openProductModal(product, productId);
            })
            .catch(error => {
                console.error('Error loading product detail:', error);
                showErrorModal('Gagal memuat detail produk');
            });
    } else {
        console.log('Product found in local data:', product);
        openProductModal(product, productId);
    }
}

function openProductModal(product, productId) {
    console.log('Opening modal for product:', productId, product);

    const modal = document.getElementById('product-modal');
    const modalContent = document.getElementById('modal-content');

    if (!modal || !modalContent) {
        console.error('Modal elements not found! Modal:', modal, 'ModalContent:', modalContent);
        console.error('Available elements:', document.querySelectorAll('[id*="modal"]'));
        return;
    }

    try {
        // Create modal content
        const modalHTML = createProductDetailModal(product);
        console.log('Generated modal HTML:', modalHTML.substring(0, 200) + '...');

        modalContent.innerHTML = modalHTML;

        // Force display with multiple methods
        modal.style.cssText = 'display: flex !important; z-index: 9999 !important; position: fixed !important;';
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Add backdrop click to close
        modal.onclick = function(e) {
            if (e.target === modal) {
                closeModal();
            }
        };

        console.log('Modal opened successfully for product:', productId);
        console.log('Modal element:', modal);
        console.log('Modal computed display:', window.getComputedStyle(modal).display);
        console.log('Modal computed z-index:', window.getComputedStyle(modal).zIndex);

        // Force visibility check
        setTimeout(() => {
            console.log('Modal visibility after timeout:', window.getComputedStyle(modal).visibility);
            console.log('Modal display after timeout:', window.getComputedStyle(modal).display);
        }, 100);

    } catch (error) {
        console.error('Error opening modal:', error);
    }
}

function showErrorModal(message) {
    const modal = document.getElementById('product-modal');
    const modalContent = document.getElementById('modal-content');

    if (modal && modalContent) {
        modalContent.innerHTML = `<p class="text-center text-gray-500 py-8">${message}</p>`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
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
                <p class="text-2xl font-bold text-indigo-600 mb-4">${priceDisplay}</p>
                <button class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors text-sm font-medium" onclick="event.stopPropagation(); showProductDetail(${product.id})">
                    Lihat Detail
                </button>
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

    console.log('Filtering products:', { categoryFilter, typeFilter, productsCount: window.products.length });

    // Reset to all products first
    window.filteredProducts = [...window.products];

    // Apply category filter
    if (categoryFilter !== 'all') {
        window.filteredProducts = window.filteredProducts.filter(product => product.category_id == categoryFilter);
        console.log('After category filter:', window.filteredProducts.length, 'products');
    }

    // Apply type filter
    if (typeFilter !== 'all') {
        window.filteredProducts = window.filteredProducts.filter(product => product.tipe_produk === typeFilter);
        console.log('After type filter:', window.filteredProducts.length, 'products');
    }

    console.log('Final filtered products count:', window.filteredProducts.length);

    // Update products grid
    loadFilteredProducts();
}

function loadFilteredProducts() {
    const productsGrid = document.getElementById('products-grid');
    const emptyState = document.getElementById('empty-state');

    if (window.filteredProducts.length === 0) {
        if (emptyState) emptyState.classList.remove('hidden');
        if (productsGrid) productsGrid.innerHTML = '';
    } else {
        if (emptyState) emptyState.classList.add('hidden');
        if (productsGrid) {
            productsGrid.innerHTML = window.filteredProducts.map(product => `
                <div onclick="openProductModal('${product.id}')" class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer group overflow-hidden border border-gray-100" data-product-id="${product.id}">
                    <!-- Product Image -->
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-6xl group-hover:scale-110 transition-transform duration-300">
                        ${product.foto}
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-700 transition-colors line-clamp-2">${product.nama_produk}</h3>
                            <span class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded-full font-semibold ml-2 flex-shrink-0">
                                ${product.tipe_produk.charAt(0).toUpperCase() + product.tipe_produk.slice(1)}
                            </span>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">${product.deskripsi || 'Deskripsi produk tidak tersedia'}</p>

                        <div class="text-2xl font-black text-indigo-600">
                            Rp ${product.harga.toLocaleString('id-ID')}
                        </div>

                        ${product.category ? `
                            <div class="mt-3 text-xs text-gray-500 bg-gray-50 px-3 py-1 rounded-full inline-block">
                                ${product.category.nama_kategori}
                            </div>
                        ` : ''}
                    </div>
                </div>
            `).join('');
        }
    }
}

function openProductModal(productId) {
    console.log('Opening modal for product:', productId);

    // Find product in the filtered products array
    const product = window.filteredProducts.find(p => p.id == productId);
    if (!product) {
        console.error('Product not found:', productId);
        return;
    }

    console.log('Found product:', product);

    // Show modal
    const modal = document.getElementById('product-modal');
    if (modal) {
        modal.style.display = 'flex';
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Load modal content
        loadProductModalContent(product);
    } else {
        console.error('Modal element not found!');
    }
}

function loadProductModalContent(product) {
    const modalContent = document.getElementById('modal-content');
    if (!modalContent) return;

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

    modalContent.innerHTML = `
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
                        <span class="text-gray-600 mr-4">${Math.floor(Math.random() * 100) + 10} terjual</span>
                        <span class="${stockClass} px-3 py-1 rounded-full text-sm font-medium">${isCustom ? 'Custom' : 'Ready Stock'}</span>
                    </div>
                    <p class="text-3xl font-bold text-indigo-600 mb-4" id="product-price">Rp ${displayPrice.toLocaleString('id-ID')}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
                    <p class="text-gray-600 leading-relaxed">${product.deskripsi || 'Deskripsi produk tidak tersedia'}</p>
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
