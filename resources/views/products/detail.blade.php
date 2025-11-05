<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Produk - Butik Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="h-full bg-gray-50">
    @include('shared.navbar')

    <!-- Product Detail Page -->
    <div id="product-detail-page">
        <!-- Breadcrumb -->
        <div class="bg-gray-50 py-4 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="/" class="text-gray-500 hover:text-indigo-600">Home</a></li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="/products" class="text-gray-500 hover:text-indigo-600">Produk</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-900">{{ $product->nama_produk ?? 'Detail Produk' }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if($product)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                    <!-- Product Images -->
                    <div class="space-y-4">
                        <!-- Main Image -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <div class="aspect-square bg-gray-100 flex items-center justify-center">
                                @php
                                    $imagePath = $product->foto;
                                    $fullImagePath = str_contains($imagePath, 'products/') ? $imagePath : 'products/' . $imagePath;
                                    $filePath = storage_path('app/public/' . $fullImagePath);
                                @endphp
                                @if($product->foto && file_exists($filePath))
                                    <img src="{{ asset('storage/' . $fullImagePath) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-8xl">{{ $product->foto ?: '📦' }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Thumbnail Images -->
                        <div class="grid grid-cols-4 gap-3">
                            @for($i = 0; $i < 4; $i++)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:shadow-lg transition-shadow">
                                    <div class="aspect-square bg-gray-100 flex items-center justify-center">
                                        @php
                                            $imagePath = $product->foto;
                                            $fullImagePath = str_contains($imagePath, 'products/') ? $imagePath : 'products/' . $imagePath;
                                            $filePath = storage_path('app/public/' . $fullImagePath);
                                        @endphp
                                        @if($product->foto && file_exists($filePath))
                                            <img src="{{ asset('storage/' . $fullImagePath) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-3xl">{{ $product->foto ?: '📦' }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Product Information -->
                    <div class="space-y-8">
                        <!-- Product Header -->
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                @if($product->category)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                        {{ $product->category->nama_kategori }}
                                    </span>
                                @endif
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $product->tipe_produk === 'custom' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $product->tipe_produk === 'custom' ? 'Custom Order' : 'Ready Stock' }}
                                </span>
                            </div>

                            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $product->nama_produk }}</h1>

                            <!-- Sales Info -->
                            <div class="flex items-center gap-4 mb-6">
                                <span class="text-sm text-gray-600">{{ $product->terjual ?? 0 }} terjual</span>
                                <span class="text-gray-300">|</span>
                                <span id="availability-text" class="text-sm text-green-600">✓ Stok tersedia</span>
                            </div>

                            <!-- Price -->
                            <div class="mb-6">
                                @if($product->tipe_produk === 'ready' && $product->variants && $product->variants->count() > 0)
                                    <div class="flex items-baseline gap-3">
                                        <span id="product-price" class="text-3xl lg:text-4xl font-bold text-indigo-600">
                                            Rp {{ number_format($product->variants->first()->price_adjustment, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @else
                                    <span id="product-price" class="text-3xl lg:text-4xl font-bold text-indigo-600">
                                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Size Selection -->
                        @if($product->tipe_produk === 'ready' && $product->variants && $product->variants->count() > 0)
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pilih Ukuran</h3>
                                <div class="grid grid-cols-4 gap-3 mb-6" id="size-buttons">
                                    @foreach($product->variants as $variant)
                                        <button onclick="selectSize('{{ $variant->size }}', {{ $variant->id }}, {{ $variant->stock }}, {{ $variant->price_adjustment }})"
                                                class="size-btn border-2 border-gray-200 px-4 py-3 rounded-xl hover:border-indigo-600 hover:text-indigo-600 transition-all font-medium {{ $loop->first ? 'border-indigo-600 text-indigo-600 bg-indigo-50' : '' }} {{ $variant->stock === 0 ? 'opacity-50 cursor-not-allowed bg-gray-100' : '' }}"
                                                {{ $variant->stock === 0 ? 'disabled' : '' }}>
                                            <div class="text-center">
                                                <div class="font-semibold">{{ $variant->size }}</div>
                                                <div class="text-xs text-gray-500 mt-1">Stok: {{ $variant->stock }}</div>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="space-y-4">
                            <div class="flex gap-4">
                                <button onclick="addToCart({{ $product->id }}, {{ ($product->tipe_produk === 'ready' && $product->variants && $product->variants->count() > 0) ? $product->variants->first()->id : 'null' }}); showNotification('{{ $product->nama_produk }} berhasil ditambahkan ke keranjang!'); updateCartCount();"
                                        class="flex-1 bg-indigo-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-indigo-700 transition-all transform hover:scale-105 shadow-lg">
                                    <div class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13v8a2 2 0 002 2h10a2 2 0 002-2v-3"></path>
                                        </svg>
                                        {{ $product->tipe_produk === 'custom' ? 'Pesan Custom' : 'Tambah ke Keranjang' }}
                                    </div>
                                </button>

                                @if($product->tipe_produk === 'ready')
                                    <button onclick="buyNow({{ $product->id }}, {{ ($product->variants && $product->variants->count() > 0) ? $product->variants->first()->id : 'null' }}); showNotification('Melanjutkan ke checkout...'); updateCartCount(); navigateTo('cart');"
                                            class="flex-1 bg-gradient-to-r from-yellow-400 to-orange-400 text-gray-900 px-8 py-4 rounded-xl font-semibold hover:from-yellow-500 hover:to-orange-500 transition-all transform hover:scale-105 shadow-lg">
                                        <div class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            Beli Sekarang
                                        </div>
                                    </button>
                                @else
                                    <button onclick="navigateTo('custom'); showNotification('Melanjutkan ke custom request...');"
                                            class="flex-1 bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-8 py-4 rounded-xl font-semibold hover:from-purple-600 hover:to-indigo-600 transition-all transform hover:scale-105 shadow-lg">
                                        <div class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Custom Request
                                        </div>
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Product Description -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Produk</h3>
                            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                <p class="mb-4">{{ $product->deskripsi }}</p>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Produk</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Kategori</span>
                                    <span class="text-gray-900 font-medium">{{ $product->category->nama_kategori ?? 'Tidak dikategorikan' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Tipe Produk</span>
                                    <span class="text-gray-900 font-medium">{{ $product->tipe_produk === 'custom' ? 'Custom Order' : 'Ready Stock' }}</span>
                                </div>
                                @if($product->tipe_produk === 'ready')
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Ketersediaan</span>
                                        <span id="detail-availability" class="text-green-600 font-medium">{{ $product->variants->sum('stock') ?? 0 }} unit tersedia</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Pengiriman</span>
                                        <span class="text-gray-900 font-medium">Estimasi 2-5 hari kerja</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Similar Products -->
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">Produk Serupa</h2>
                        <a href="/products" class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-2">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="similar-products">
                        <!-- Similar products will be loaded here -->
                    </div>
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-5v2m0 0v2m0-2h2m-2 0h-2"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Produk Tidak Ditemukan</h2>
                    <p class="text-gray-600 mb-8">Produk yang Anda cari tidak tersedia atau telah dihapus.</p>
                    <div class="flex gap-4 justify-center">
                        <a href="/" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                            Kembali ke Beranda
                        </a>
                        <a href="/products" class="border border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-50 transition-colors">
                            Lihat Produk Lain
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('shared.notification')
    @include('shared.footer')
    @include('shared.scroll-to-top')

    <script>
        // Global variables
        let categories = [];
        let products = [];
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let currentProduct = @json($product);

        // Load data from API
        async function loadDataFromAPI() {
            try {
                // Load categories
                const categoriesResponse = await fetch('/api/categories');
                categories = await categoriesResponse.json();

                // Add icons and colors to categories (since not in DB)
                const categoryIcons = {
                    'Pakaian': { icon: '👗', color: 'from-pink-400 to-pink-600' },
                    'Aksesoris': { icon: '💍', color: 'from-yellow-400 to-yellow-600' },
                    'Elektronik': { icon: '📱', color: 'from-green-400 to-green-600' }
                };

                categories = categories.map(cat => ({
                    ...cat,
                    icon: categoryIcons[cat.nama_kategori]?.icon || '📦',
                    color: categoryIcons[cat.nama_kategori]?.color || 'from-gray-400 to-gray-600'
                }));

                // Load products
                const productsResponse = await fetch('/api/products');
                products = await productsResponse.json();

                // Transform product data for frontend compatibility
                products = products.map(product => ({
                    ...product,
                    kategori: product.category?.nama_kategori.toLowerCase() || 'unknown',
                    rating: 4.5, // Default rating since not in DB
                    terjual: Math.floor(Math.random() * 100) + 10 // Random sales count
                }));

                // Load product detail with data from server
                loadProductDetailFromServer(currentProduct);

            } catch (error) {
                console.error('Error loading data from API:', error);
            }
        }

        function loadProductDetailFromServer(product) {
            if (!product) {
                document.getElementById('product-detail-content').innerHTML = '<p class="text-center text-gray-500">Produk tidak ditemukan</p>';
                return;
            }

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

            document.getElementById('product-detail-content').innerHTML = `
                <div>
                    <div class="bg-gray-100 rounded-xl h-96 flex items-center justify-center mb-6">
                        <span class="text-8xl">${product.foto}</span>
                    </div>
                    <div class="grid grid-cols-4 gap-2 mb-6">
                        ${Array(4).fill().map(() => `
                            <div class="bg-gray-100 rounded-lg h-20 flex items-center justify-center cursor-pointer hover:bg-gray-200 transition-colors">
                                <span class="text-2xl">${product.foto}</span>
                            </div>
                        `).join('')}
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800 mb-2">${product.nama_produk}</h1>
                        <div class="flex items-center mb-4">
                            <span class="text-gray-600 mr-4">${product.terjual} terjual</span>
                            <span class="${stockClass} px-3 py-1 rounded-full text-sm font-medium">${isCustom ? 'Custom' : 'Ready Stock'}</span>
                        </div>
                        <p class="text-4xl font-bold text-indigo-600 mb-4" id="product-price">Rp ${displayPrice.toLocaleString('id-ID')}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-600 leading-relaxed text-lg">${product.deskripsi}</p>
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
                        <button onclick="addToCart(${product.id}, ${selectedVariant ? selectedVariant.id : 'null'}); showNotification('${product.nama_produk} berhasil ditambahkan ke keranjang!');" class="flex-1 bg-indigo-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-indigo-700 transition-colors ${!isCustom && selectedVariant && selectedVariant.stock === 0 ? 'opacity-50 cursor-not-allowed' : ''}" ${!isCustom && selectedVariant && selectedVariant.stock === 0 ? 'disabled' : ''}>
                            ${isCustom ? 'Pesan Custom' : 'Tambah ke Keranjang'}
                        </button>
                        ${!isCustom ? `
                            <button onclick="buyNow(${product.id}, ${selectedVariant ? selectedVariant.id : 'null'}); showNotification('Melanjutkan ke checkout...');" class="flex-1 bg-yellow-400 text-gray-800 px-8 py-3 rounded-xl font-semibold hover:bg-yellow-300 transition-colors ${selectedVariant && selectedVariant.stock === 0 ? 'opacity-50 cursor-not-allowed' : ''}" ${selectedVariant && selectedVariant.stock === 0 ? 'disabled' : ''}>
                                Beli Sekarang
                            </button>
                        ` : `
                            <button onclick="navigateTo('custom'); showNotification('Melanjutkan ke custom request...');" class="flex-1 bg-yellow-400 text-gray-800 px-8 py-3 rounded-xl font-semibold hover:bg-yellow-300 transition-colors">
                                Custom Request
                            </button>
                        `}
                    </div>
                </div>
            `;

            // Show/hide size-price section based on product type
            const sizePriceSection = document.getElementById('size-price-section');
            if (sizePriceSection) {
                sizePriceSection.style.display = (!isCustom && product.variants && product.variants.length > 0) ? 'block' : 'none';
            }

            // Load similar products from API
            loadSimilarProducts(product);
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

            // Update availability text in sales info
            const availabilityElement = document.getElementById('availability-text');
            if (availabilityElement) {
                if (stock > 0) {
                    availabilityElement.textContent = `✓ ${stock} unit tersedia`;
                    availabilityElement.className = 'text-sm text-green-600';
                } else {
                    availabilityElement.textContent = '✗ Stok habis';
                    availabilityElement.className = 'text-sm text-red-600';
                }
            }

            // Update availability in detail section
            const detailAvailabilityElement = document.getElementById('detail-availability');
            if (detailAvailabilityElement) {
                if (stock > 0) {
                    detailAvailabilityElement.textContent = `${stock} unit tersedia`;
                    detailAvailabilityElement.className = 'text-green-600 font-medium';
                } else {
                    detailAvailabilityElement.textContent = 'Stok habis';
                    detailAvailabilityElement.className = 'text-red-600 font-medium';
                }
            }

            // Update button styles
            const buttons = document.querySelectorAll('#size-buttons .size-btn');
            buttons.forEach(btn => {
                btn.classList.remove('border-indigo-600', 'text-indigo-600', 'bg-indigo-50');
            });

            // Highlight selected button
            event.target.classList.add('border-indigo-600', 'text-indigo-600', 'bg-indigo-50');
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

            // Handle image path - same logic as PHP version
            let imagePath = product.foto || '';
            let fullImagePath = imagePath.includes('products/') ? imagePath : 'products/' + imagePath;
            let imageUrl = `/storage/${fullImagePath}`;

            // Always show image tag, let browser handle loading
            console.log('Creating image for product:', product.nama_produk, 'with foto:', product.foto, 'and URL:', imageUrl);
            let imageDisplay = `<img src="${imageUrl}" alt="${product.nama_produk}" class="w-full h-full object-cover rounded-lg" onerror="console.log('Image failed for:', '${product.nama_produk}', 'URL:', '${imageUrl}'); this.outerHTML='<span class=text-6xl>${product.foto || '👕'}</span>'" />`;

            return `
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all transform hover:scale-105 cursor-pointer" onclick="window.location.href='/products/${product.id}'">
                    <div class="relative bg-gray-100 h-48 flex items-center justify-center">
                        ${imageDisplay}
                        <div class="absolute top-3 right-3">
                            <span class="${isCustom ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800'} px-2 py-1 rounded-full text-xs font-bold">${isCustom ? 'Custom' : 'Ready'}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">${product.nama_produk}</h4>
                        <div class="flex items-center mb-3">
                            <span class="text-sm text-gray-600">${product.terjual || 0} terjual</span>
                        </div>
                        <p class="text-2xl font-bold text-indigo-600 mb-4">${priceDisplay}</p>
                    </div>
                </div>
            `;
        }

        function loadSimilarProducts(currentProduct) {
            // Load similar products from API
            fetch('/api/products')
                .then(response => response.json())
                .then(allProducts => {
                    console.log('All products from API:', allProducts);
                    console.log('Current product:', currentProduct);

                    // Filter products with same category and different ID
                    const similarProducts = allProducts.filter(p => {
                        const sameCategory = p.category?.nama_kategori === currentProduct.category?.nama_kategori;
                        const differentId = p.id !== currentProduct.id;
                        console.log(`Product ${p.id}: sameCategory=${sameCategory}, differentId=${differentId}, category=${p.category?.nama_kategori}, foto=${p.foto}`);
                        return sameCategory && differentId;
                    }).slice(0, 4);

                    console.log('Filtered similar products:', similarProducts);

                    const similarContainer = document.getElementById('similar-products');
                    if (similarContainer) {
                        if (similarProducts.length > 0) {
                            similarContainer.innerHTML = similarProducts.map(p => {
                                console.log('Creating card for product:', p);
                                return createProductCard(p);
                            }).join('');
                            console.log('Similar products HTML rendered');
                        } else {
                            similarContainer.innerHTML = '<p class="text-center text-gray-500 col-span-full">Tidak ada produk serupa ditemukan</p>';
                            console.log('No similar products found');
                        }
                    } else {
                        console.log('Similar products container not found');
                    }
                })
                .catch(error => {
                    console.error('Error loading similar products:', error);
                    const similarContainer = document.getElementById('similar-products');
                    if (similarContainer) {
                        similarContainer.innerHTML = '<p class="text-center text-red-500">Error loading similar products</p>';
                    }
                });
        }

        function buyNow(productId, variantId) {
            // For now, just add to cart and redirect to cart
            addToCart(productId, variantId);
            navigateTo('cart');
        }

        function navigateTo(page) {
            // Update URL without triggering page reload
            const newUrl = page === 'home' ? '/' : '/' + page;
            if (window.location.pathname !== newUrl) {
                window.location.href = newUrl;
            }
        }

        // Initialize app when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Load similar products
            loadSimilarProducts(currentProduct);
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/products.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/utils.js') }}"></script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9930afa44532051a',t:'MTc2MTIxNjc1OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>