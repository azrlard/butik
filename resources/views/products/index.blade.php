@extends('layouts.app')

@section('title', 'Produk - Butik Online')

@section('content')
<!-- Page: Products -->
<div id="products">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-indigo-50 to-white py-16 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-6xl font-black text-gray-900 mb-6 leading-tight">
                    Semua Produk
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Temukan produk fashion terbaik untuk gaya Anda. Dari ready stock hingga custom order, semua ada di sini.
                </p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters Section -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 mb-12">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Filter & Cari Produk</h2>
                    <p class="text-gray-600">Temukan produk yang sesuai dengan preferensi Anda</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
                    <div class="relative">
                        <label for="category-filter" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <select id="category-filter" onchange="filterProducts()" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent bg-white shadow-sm hover:shadow-md transition-shadow">
                            <option value="all">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="relative">
                        <label for="type-filter" class="block text-sm font-semibold text-gray-700 mb-2">Tipe Produk</label>
                        <select id="type-filter" onchange="filterProducts()" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent bg-white shadow-sm hover:shadow-md transition-shadow">
                            <option value="all">Semua Tipe</option>
                            <option value="ready">Ready Stock</option>
                            <option value="custom">Custom Order</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="products-grid">
            @forelse($products as $product)
                <script>
                    // Initialize products array if not exists
                    if (typeof window.products === 'undefined') {
                        window.products = [];
                        window.filteredProducts = [...window.products];
                    }
                    // Add product to JavaScript array for filtering
                    window.products.push({
                        id: {{ $product->id }},
                        nama_produk: '{{ addslashes($product->nama_produk) }}',
                        deskripsi: '{{ addslashes($product->deskripsi ?? '') }}',
                        harga: {{ $product->harga }},
                        stok: {{ $product->stok ?? 0 }},
                        foto: '{{ $product->foto ?? '👕' }}',
                        tipe_produk: '{{ $product->tipe_produk }}',
                        category_id: {{ $product->category_id ?? 'null' }},
                        category: {{ $product->category ? json_encode(['nama_kategori' => $product->category->nama_kategori]) : 'null' }},
                        variants: {{ $product->variants ? json_encode($product->variants) : '[]' }}
                    });
                    window.filteredProducts = [...window.products];
                </script>
                <div onclick="openProductModal('{{ $product->id }}')" class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer group overflow-hidden border border-gray-100" data-product-id="{{ $product->id }}">
                    <!-- Product Image -->
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-6xl group-hover:scale-110 transition-transform duration-300">
                        @if($product->foto && file_exists(public_path('storage/' . $product->foto)))
                            <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover rounded-lg">
                        @else
                            {{ $product->foto ?? '👕' }}
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-700 transition-colors line-clamp-2">{{ $product->nama_produk }}</h3>
                            <span class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded-full font-semibold ml-2 flex-shrink-0">
                                {{ ucfirst($product->tipe_produk) }}
                            </span>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $product->deskripsi ?? 'Deskripsi produk tidak tersedia' }}</p>

                        <div class="text-2xl font-black text-indigo-600">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </div>

                        <!-- View Button -->
                        <button onclick="event.stopPropagation(); window.location.href='/products/{{ $product->id }}'" class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                            View
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16" id="empty-state">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-5v2m0 0v2m0-2h2m-2 0h-2"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
                        <p class="text-gray-600 mb-6">Coba ubah filter kategori atau tipe produk</p>
                        <button onclick="document.getElementById('category-filter').value='all'; document.getElementById('type-filter').value='all'; filterProducts();" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition-colors">
                            Tampilkan Semua Produk
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Product Detail Modal -->
        <div id="product-modal" class="hidden fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50 p-4" style="display: none;">
            <div class="bg-white rounded-3xl max-w-5xl w-full max-h-screen overflow-hidden shadow-2xl border border-white border-opacity-20">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold">Detail Produk</h3>
                        <p class="text-indigo-100 mt-1">Informasi lengkap produk pilihan Anda</p>
                    </div>
                    <button onclick="console.log('Close button clicked'); closeModal()" class="text-white text-opacity-80 hover:text-white hover:bg-white hover:bg-opacity-20 rounded-full p-2 transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div id="modal-content" class="p-8 overflow-y-auto max-h-screen bg-gray-50">
                    <!-- Modal content will be loaded here -->
                </div>
            </div>
        </div>

    </div>
</div>
@endsection