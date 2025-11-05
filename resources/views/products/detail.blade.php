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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if($product)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div>
                        <div class="bg-gray-100 rounded-xl h-96 flex items-center justify-center mb-6">
                            @if($product->foto && file_exists(public_path('storage/' . $product->foto)))
                                <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover rounded-xl">
                            @else
                                <span class="text-8xl">{{ $product->foto ?: '📦' }}</span>
                            @endif
                        </div>
                        <div class="grid grid-cols-4 gap-2 mb-6">
                            @for($i = 0; $i < 4; $i++)
                                <div class="bg-gray-100 rounded-lg h-20 flex items-center justify-center cursor-pointer hover:bg-gray-200 transition-colors">
                                    <span class="text-2xl">{{ $product->foto ?: '📦' }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $product->nama_produk }}</h1>
                            <div class="flex items-center mb-4">
                                <span class="text-gray-600 mr-4">{{ $product->terjual ?? 0 }} terjual</span>
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $product->tipe_produk === 'custom' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $product->tipe_produk === 'custom' ? 'Custom' : 'Ready Stock' }}
                                </span>
                            </div>
                            @if($product->tipe_produk === 'ready' && $product->variants && $product->variants->count() > 0)
                                <p class="text-4xl font-bold text-indigo-600 mb-4" id="product-price">
                                    Rp {{ number_format($product->variants->min('price_adjustment'), 0, ',', '.') }} - Rp {{ number_format($product->variants->max('price_adjustment'), 0, ',', '.') }}
                                </p>
                            @else
                                <p class="text-4xl font-bold text-indigo-600 mb-4" id="product-price">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </p>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
                            <p class="text-gray-600 leading-relaxed text-lg">{{ $product->deskripsi }}</p>
                        </div>

                        @if($product->tipe_produk === 'ready' && $product->variants && $product->variants->count() > 0)
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Ukuran</h3>
                                <div class="flex space-x-2 mb-6" id="size-buttons">
                                    @foreach($product->variants as $variant)
                                        <button onclick="selectSize('{{ $variant->size }}', {{ $variant->id }}, {{ $variant->stock }}, {{ $variant->price_adjustment }})"
                                                class="size-btn border border-gray-300 px-4 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors {{ $loop->first ? 'border-indigo-600 text-indigo-600 bg-indigo-50' : '' }} {{ $variant->stock === 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                {{ $variant->stock === 0 ? 'disabled' : '' }}>
                                            {{ $variant->size }} {{ $variant->stock === 0 ? '(Habis)' : "({$variant->stock})" }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="flex space-x-4">
                            <button onclick="addToCart({{ $product->id }}, {{ ($product->tipe_produk === 'ready' && $product->variants && $product->variants->count() > 0) ? $product->variants->first()->id : 'null' }}); showNotification('{{ $product->nama_produk }} berhasil ditambahkan ke keranjang!');"
                                    class="flex-1 bg-indigo-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-indigo-700 transition-colors">
                                {{ $product->tipe_produk === 'custom' ? 'Pesan Custom' : 'Tambah ke Keranjang' }}
                            </button>
                            @if($product->tipe_produk === 'ready')
                                <button onclick="buyNow({{ $product->id }}, {{ ($product->variants && $product->variants->count() > 0) ? $product->variants->first()->id : 'null' }}); showNotification('Melanjutkan ke checkout...');"
                                        class="flex-1 bg-yellow-400 text-gray-800 px-8 py-3 rounded-xl font-semibold hover:bg-yellow-300 transition-colors">
                                    Beli Sekarang
                                </button>
                            @else
                                <button onclick="navigateTo('custom'); showNotification('Melanjutkan ke custom request...');"
                                        class="flex-1 bg-yellow-400 text-gray-800 px-8 py-3 rounded-xl font-semibold hover:bg-yellow-300 transition-colors">
                                    Custom Request
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Similar Products -->
                <div class="mt-20">
                    <h3 class="text-2xl font-bold text-gray-800 mb-8">Produk Serupa</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="similar-products">
                        <!-- Similar products will be loaded here -->
                    </div>
                </div>
            @else
                <div class="text-center py-20">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Produk Tidak Ditemukan</h2>
                    <p class="text-gray-600 mb-8">Produk yang Anda cari tidak tersedia.</p>
                    <a href="/" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                        Kembali ke Beranda
                    </a>
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
        let cart = [];
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

            return `
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all transform hover:scale-105 cursor-pointer" onclick="window.location.href='/products/${product.id}'">
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

        function loadSimilarProducts(currentProduct) {
            // Load similar products from API
            fetch('/api/products')
                .then(response => response.json())
                .then(allProducts => {
                    const similarProducts = allProducts.filter(p =>
                        p.category?.nama_kategori === currentProduct.category?.nama_kategori &&
                        p.id !== currentProduct.id
                    ).slice(0, 4);

                    const similarContainer = document.getElementById('similar-products');
                    if (similarContainer && similarProducts.length > 0) {
                        similarContainer.innerHTML = similarProducts.map(p => createProductCard(p)).join('');
                    }
                })
                .catch(error => {
                    console.error('Error loading similar products:', error);
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