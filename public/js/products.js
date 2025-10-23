// Load functions
function loadCategories() {
    const container = document.getElementById('categories-grid');
    container.innerHTML = categories.map(category => `
        <div onclick="filterByCategory('${category.nama_kategori.toLowerCase()}')" class="bg-gradient-to-br ${category.color} rounded-xl p-8 text-white text-center hover:shadow-xl transition-all transform hover:scale-105 cursor-pointer">
            <div class="text-5xl mb-4">${category.icon}</div>
            <h3 class="text-xl font-bold mb-3">${category.nama_kategori}</h3>
            <p class="text-sm opacity-90">${category.deskripsi}</p>
        </div>
    `).join('');
}

function loadFeaturedProducts() {
    const container = document.getElementById('featured-products');
    const featured = products.filter(p => p.tipe_produk === 'ready').slice(0, 4);
    container.innerHTML = featured.map(product => createProductCard(product)).join('');
}

function loadAllProducts() {
    const container = document.getElementById('products-grid');
    container.innerHTML = filteredProducts.map(product => createProductCard(product)).join('');
}

function createProductCard(product) {
    const isCustom = product.tipe_produk === 'custom';
    const stockText = isCustom ? 'Custom Order' : `Stok: ${product.stok}`;
    const stockClass = isCustom ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800';

    return `
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all transform hover:scale-105">
            <div class="relative bg-gray-100 h-48 flex items-center justify-center">
                <span class="text-6xl">${product.foto}</span>
                <div class="absolute top-3 right-3">
                    <span class="${stockClass} px-2 py-1 rounded-full text-xs font-bold">${isCustom ? 'Custom' : 'Ready'}</span>
                </div>
                ${product.stok <= 5 && !isCustom ? '<div class="absolute top-3 left-3"><span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">Stok Terbatas</span></div>' : ''}
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">${product.nama_produk}</h4>
                <div class="flex items-center mb-3">
                    <span class="text-yellow-400 mr-1">⭐</span>
                    <span class="text-sm text-gray-600">${product.rating} (${product.terjual} terjual)</span>
                </div>
                <p class="text-2xl font-bold text-indigo-600 mb-4">Rp ${product.harga.toLocaleString('id-ID')}</p>
                <div class="flex items-center justify-between mb-4">
                    <span class="${stockClass} px-3 py-1 rounded-full text-sm font-medium">${stockText}</span>
                </div>
                <div class="flex space-x-2">
                    <button onclick="showProductDetail(${product.id})" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                        Detail
                    </button>
                    <button onclick="addToCart(${product.id})" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                        ${isCustom ? 'Pesan' : 'Keranjang'}
                    </button>
                </div>
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
        const categoryMatch = categoryFilter === 'all' || product.kategori === categoryFilter;
        const typeMatch = typeFilter === 'all' || product.tipe_produk === typeFilter;
        return categoryMatch && typeMatch;
    });

    loadAllProducts();
}