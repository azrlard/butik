@extends('layouts.app')

@section('title', 'Detail Produk - ' . ($product->nama_produk ?? 'Butik Online'))

@section('content')

    <!-- Product Detail Page -->
    <div x-data="productDetailComponent()" id="product-detail-page">
        @php
            $breadcrumbs = [
                ['label' => 'Produk', 'url' => '/products']
            ];
            $currentPage = $product->nama_produk ?? 'Detail Produk';
        @endphp
        @include('shared.breadcrumb')

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if($product)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                    <!-- Product Images -->
                    <div class="space-y-4">
                        <!-- Main Image -->
                        <div class="bg-background rounded-2xl shadow-lg overflow-hidden">
                            <div class="aspect-square bg-accent flex items-center justify-center">
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
                                <div class="bg-background rounded-lg shadow-md overflow-hidden cursor-pointer hover:shadow-lg transition-shadow">
                                    <div class="aspect-square bg-accent flex items-center justify-center">
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
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-secondary text-background">
                                        {{ $product->category->nama_kategori }}
                                    </span>
                                @endif
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $product->tipe_produk === 'custom' ? 'bg-accent text-text' : 'bg-secondary text-background' }}">
                                    {{ $product->tipe_produk === 'custom' ? 'Custom Order' : 'Ready Stock' }}
                                </span>
                            </div>

                            <h1 class="text-3xl lg:text-4xl font-bold text-text mb-4 leading-tight">{{ $product->nama_produk }}</h1>

                            <!-- Sales Info -->
                            <div class="flex items-center gap-4 mb-6">
                                <span class="text-sm text-accent">{{ $product->terjual ?? 0 }} terjual</span>
                                <span class="text-secondary">|</span>
                                <span id="availability-text" class="text-sm text-secondary">✓ Stok tersedia</span>
                            </div>

                            <!-- Price -->
                            <div class="mb-6">
                                @if($product->tipe_produk === 'ready' && $product->variants && $product->variants->count() > 0)
                                    <div class="flex items-baseline gap-3">
                                        <span id="product-price" class="text-3xl lg:text-4xl font-bold text-primary">
                                            Rp {{ number_format($product->variants->first()->price_adjustment, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @else
                                    <span id="product-price" class="text-3xl lg:text-4xl font-bold text-primary">
                                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Size Selection -->
                        @if($product->tipe_produk === 'ready' && $product->variants && $product->variants->count() > 0)
                            <div>
                                <h3 class="text-lg font-semibold text-text mb-4">Pilih Ukuran</h3>
                                <div class="grid grid-cols-4 gap-3 mb-6" id="size-buttons">
                                    @foreach($product->variants as $variant)
                                        <button @click="selectSize('{{ $variant->size }}', {{ $variant->id }}, {{ $variant->stock }}, {{ $variant->price_adjustment }})"
                                                class="size-btn border-2 border-secondary px-4 py-3 rounded-xl hover:border-primary hover:text-primary transition-all font-medium {{ $loop->first ? 'border-primary text-primary bg-accent' : '' }} {{ $variant->stock === 0 ? 'opacity-50 cursor-not-allowed bg-accent' : '' }}"
                                                {{ $variant->stock === 0 ? 'disabled' : '' }}>
                                            <div class="text-center">
                                                <div class="font-semibold">{{ $variant->size }}</div>
                                                <div class="text-xs text-accent mt-1">Stok: {{ $variant->stock }}</div>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="space-y-4">
                            <div class="flex gap-4">
                                <button @click="addToCart({{ $product->id }}, {{ ($product->tipe_produk === 'ready' && $product->variants && $product->variants->count() > 0) ? $product->variants->first()->id : 'null' }}, {{ auth()->check() ? 'true' : 'false' }})"
                                        class="flex-1 bg-primary text-background px-8 py-4 rounded-xl font-semibold hover:bg-secondary transition-all transform hover:scale-105 shadow-lg">
                                    <div class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13v8a2 2 0 002 2h10a2 2 0 002-2v-3"></path>
                                        </svg>
                                        {{ $product->tipe_produk === 'custom' ? 'Pesan Custom' : 'Tambah ke Keranjang' }}
                                    </div>
                                </button>

                                @if($product->tipe_produk === 'custom')
                                    <button onclick="navigateTo('custom'); showNotification('Melanjutkan ke custom request...');"
                                            class="flex-1 bg-gradient-to-r from-secondary to-accent text-text px-8 py-4 rounded-xl font-semibold hover:from-primary hover:to-secondary hover:text-background transition-all transform hover:scale-105 shadow-lg">
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
                            <h3 class="text-lg font-semibold text-text mb-4">Deskripsi Produk</h3>
                            <div class="prose prose-lg max-w-none text-accent leading-relaxed">
                                <p class="mb-4">{{ $product->deskripsi }}</p>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-text mb-4">Detail Produk</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="flex justify-between py-2 border-b border-secondary">
                                    <span class="text-accent">Kategori</span>
                                    <span class="text-text font-medium">{{ $product->category->nama_kategori ?? 'Tidak dikategorikan' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-secondary">
                                    <span class="text-accent">Tipe Produk</span>
                                    <span class="text-text font-medium">{{ $product->tipe_produk === 'custom' ? 'Custom Order' : 'Ready Stock' }}</span>
                                </div>
                                @if($product->tipe_produk === 'ready')
                                    <div class="flex justify-between py-2 border-b border-secondary">
                                        <span class="text-accent">Ketersediaan</span>
                                        <span id="detail-availability" class="text-secondary font-medium">{{ $product->variants->sum('stock') ?? 0 }} unit tersedia</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-secondary">
                                        <span class="text-accent">Pengiriman</span>
                                        <span class="text-text font-medium">Estimasi 2-5 hari kerja</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Similar Products -->
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold text-text">Produk Serupa</h2>
                        <a href="/products" class="text-primary hover:text-secondary font-medium flex items-center gap-2">
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
                    <div class="w-24 h-24 bg-accent rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-5v2m0 0v2m0-2h2m-2 0h-2"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-text mb-4">Produk Tidak Ditemukan</h2>
                    <p class="text-accent mb-8">Produk yang Anda cari tidak tersedia atau telah dihapus.</p>
                    <div class="flex gap-4 justify-center">
                        <a href="/" class="bg-primary text-background px-6 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            Kembali ke Beranda
                        </a>
                        <a href="/products" class="border border-secondary text-text px-6 py-3 rounded-lg font-semibold hover:bg-accent transition-colors">
                            Lihat Produk Lain
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('shared.notification')

    <script>
        function productDetailComponent() {
            return {
                selectedVariantId: {{ ($product->tipe_produk === 'ready' && $product->variants && $product->variants->count() > 0) ? $product->variants->first()->id : 'null' }},

                addToCart(productId, variantId, isLoggedIn) {
                    console.log('addToCart called with:', { productId, variantId, isLoggedIn });

                    if (!isLoggedIn) {
                        // Redirect to login page if not logged in
                        window.location.href = '/login';
                        return;
                    }

                    // Use selected variant if available
                    const finalVariantId = variantId !== 'null' ? variantId : this.selectedVariantId;

                    // If logged in, add to cart via AJAX and redirect to cart
                    console.log('Sending AJAX request to /cart/add with variant:', finalVariantId);
                    fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            variant_id: finalVariantId,
                            quantity: 1
                        })
                    })
                    .then(response => {
                        console.log('Response received:', response);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data received:', data);
                        if (data.success) {
                            console.log('Success! Redirecting to cart...');
                            // Redirect to cart page
                            window.location.href = '/cart';
                        } else {
                            console.error('Failed to add to cart:', data.error);
                            alert('Gagal menambahkan ke keranjang: ' + (data.error || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menambahkan ke keranjang');
                    });
                },

                selectSize(size, variantId, stock, priceAdjustment) {
                    console.log('Size selected:', { size, variantId, stock, priceAdjustment });
                    this.selectedVariantId = variantId;

                    // Update UI to show selected size
                    document.querySelectorAll('.size-btn').forEach(btn => {
                        btn.classList.remove('border-primary', 'text-primary', 'bg-accent');
                        btn.classList.add('border-secondary');
                    });

                    event.target.closest('.size-btn').classList.remove('border-secondary');
                    event.target.closest('.size-btn').classList.add('border-primary', 'text-primary', 'bg-accent');
                }
            }
        }
    </script>
@endsection