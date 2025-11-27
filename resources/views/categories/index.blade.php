@extends('layouts.app')

@section('title', 'Kategori Produk - Butik Online')

@section('content')
<!-- Page: Categories -->
<div id="categories">
    @php
        $currentPage = 'Kategori';
    @endphp
    @include('shared.breadcrumb')

    <!-- Hero Section -->
    <section class="bg-surface text-text py-24 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -translate-y-48 translate-x-48"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-secondary/10 rounded-full blur-3xl translate-y-32 -translate-x-32"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-8">
                <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                    Kategori Produk
                </h1>
                <p class="text-xl md:text-2xl text-text max-w-4xl mx-auto leading-relaxed">
                    Temukan berbagai kategori fashion yang sesuai dengan gaya dan kebutuhan Anda. Dari pakaian hingga aksesoris, semua ada di sini.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button onclick="scrollToSection('categories')" class="inline-flex items-center px-8 py-4 bg-primary text-white font-bold rounded-2xl hover:bg-primary/90 transition-all duration-300 transform hover:scale-105 shadow-xl">
                    <span>Jelajahi Kategori</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </button>
                <button onclick="scrollToSection('featured')" class="inline-flex items-center px-8 py-4 bg-background border-2 border-primary text-text font-bold rounded-2xl hover:bg-primary hover:text-white transition-all duration-300">
                    <span>Produk Unggulan</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Categories Grid Section -->
    <section id="categories" class="py-24 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black text-text mb-6">
                    Pilih Kategori Favorit Anda
                </h2>
                <p class="text-xl text-text max-w-3xl mx-auto">
                    Jelajahi berbagai kategori produk fashion kami yang telah dikurasi khusus untuk memenuhi kebutuhan gaya Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @forelse($categories as $category)
                    <div class="bg-background rounded-3xl p-8 shadow-xl border border-secondary hover:shadow-2xl transition-all duration-300 transform hover:scale-105 group">
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-secondary to-primary rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <span class="text-3xl">
                                    @switch($category->nama_kategori)
                                        @case('Pakaian')
                                            👗
                                            @break
                                        @case('Aksesoris')
                                            💍
                                            @break
                                        @case('Elektronik')
                                            📱
                                            @break
                                        @default
                                            📦
                                    @endswitch
                                </span>
                            </div>
                            <h3 class="text-2xl font-bold text-text mb-2">{{ $category->nama_kategori }}</h3>
                            <p class="text-text text-center leading-relaxed">
                                @switch($category->nama_kategori)
                                    @case('Pakaian')
                                        Koleksi pakaian terbaru dengan desain modern dan bahan berkualitas tinggi.
                                        @break
                                    @case('Aksesoris')
                                        Lengkapi gaya Anda dengan aksesoris fashion yang stylish dan fungsional.
                                        @break
                                    @case('Elektronik')
                                        Gadget dan elektronik terbaru untuk melengkapi kebutuhan sehari-hari.
                                        @break
                                    @default
                                        Kategori produk dengan berbagai pilihan menarik.
                                @endswitch
                            </p>
                        </div>
                        <div class="text-center text-sm text-text">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $category->products->count() }} Produk
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-5v2m0 0v2m0-2h2m-2 0h-2"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada kategori</h3>
                        <p class="text-gray-600">Kategori produk akan segera ditambahkan.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center">
                <a href="/products" class="inline-flex items-center px-8 py-4 bg-primary text-white font-bold rounded-2xl hover:bg-primary/90 transition-all duration-300 transform hover:scale-105 shadow-xl">
                    <span>Lihat Semua Produk</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products by Category Section -->
    <section id="featured" class="py-24 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black text-text mb-6">
                    Produk Unggulan per Kategori
                </h2>
                <p class="text-xl text-text max-w-3xl mx-auto">
                    Temukan produk terbaik dari setiap kategori yang telah dipilih khusus untuk Anda.
                </p>
            </div>

            @forelse($categories as $category)
                @if($category->products->count() > 0)
                    <div class="mb-20">
                        <div class="flex items-center justify-between mb-12">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-secondary to-primary rounded-2xl flex items-center justify-center mr-4">
                                    <span class="text-2xl">
                                        @switch($category->nama_kategori)
                                            @case('Pakaian')
                                                👗
                                                @break
                                            @case('Aksesoris')
                                                💍
                                                @break
                                            @case('Elektronik')
                                                📱
                                                @break
                                            @default
                                                📦
                                        @endswitch
                                    </span>
                                </div>
                                <div>
                                    <h3 class="text-3xl font-bold text-text">{{ $category->nama_kategori }}</h3>
                                    <p class="text-text">{{ $category->products->count() }} produk tersedia</p>
                                </div>
                            </div>
                            <a href="/products?category={{ $category->id }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:bg-primary/90 transition-all duration-300">
                                <span>Lihat Semua</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($category->products->take(4) as $product)
                                <div onclick="openProductModal('{{ $product->id }}')" class="bg-background rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer group overflow-hidden border border-secondary">
                                    <div class="aspect-square bg-surface flex items-center justify-center text-6xl group-hover:scale-110 transition-transform duration-300">
                                        @if($product->foto && file_exists(public_path('storage/' . $product->foto)))
                                            <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover rounded-lg">
                                        @else
                                            {{ $product->foto ?? '📦' }}
                                        @endif
                                    </div>
                                    <div class="p-6">
                                        <div class="flex justify-between items-start mb-3">
                                            <h3 class="text-lg font-bold text-text group-hover:text-primary transition-colors line-clamp-2">{{ $product->nama_produk }}</h3>
                                            <span class="bg-primary text-white text-xs px-2 py-1 rounded-full font-semibold ml-2 flex-shrink-0">
                                                {{ ucfirst($product->tipe_produk) }}
                                            </span>
                                        </div>
                                        <p class="text-text text-sm mb-4 line-clamp-2">{{ $product->deskripsi ?? 'Deskripsi produk tidak tersedia' }}</p>
                                        <div class="text-2xl font-black text-primary">
                                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                                        </div>
                                        <button onclick="event.stopPropagation(); window.location.href='/products/{{ $product->id }}'" class="mt-4 w-full bg-primary text-white py-2 px-4 rounded-lg font-semibold hover:bg-primary/90 transition-colors">
                                            View
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @empty
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-5v2m0 0v2m0-2h2m-2 0h-2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada produk</h3>
                    <p class="text-gray-600">Produk akan segera ditambahkan ke setiap kategori.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Category Benefits Section -->
    <section class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-1 bg-primary/10 rounded-full mb-4">
                    <span class="text-sm font-medium text-primary">Keuntungan Belanja</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Belanja per Kategori?
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Sistem kategori memudahkan Anda menemukan produk yang tepat dengan lebih cepat dan efisien.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Benefit 1 -->
                <div class="group bg-white p-8 rounded-xl border border-gray-200 hover:border-primary/50 hover:shadow-lg transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary to-primary/80 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pencarian Mudah</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Filter produk berdasarkan kategori untuk menemukan item yang Anda cari dengan cepat.
                    </p>
                </div>

                <!-- Benefit 2 -->
                <div class="group bg-white p-8 rounded-xl border border-gray-200 hover:border-primary/50 hover:shadow-lg transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-secondary to-secondary/80 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Produk Terorganisir</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Semua produk tersusun rapi dalam kategori yang jelas dan mudah dinavigasi.
                    </p>
                </div>

                <!-- Benefit 3 -->
                <div class="group bg-white p-8 rounded-xl border border-gray-200 hover:border-primary/50 hover:shadow-lg transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary to-primary/80 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Hemat Waktu</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Langsung ke kategori yang Anda butuhkan tanpa harus melihat semua produk.
                    </p>
                </div>

                <!-- Benefit 4 -->
                <div class="group bg-white p-8 rounded-xl border border-gray-200 hover:border-primary/50 hover:shadow-lg transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-secondary to-secondary/80 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Mudah Dibandingkan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Bandingkan produk dalam kategori yang sama untuk pilihan yang lebih baik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-br from-primary/5 via-white to-secondary/5 border-t border-gray-200 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/5 rounded-full blur-3xl"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200 p-10 md:p-14 shadow-lg">
                <div class="inline-block px-4 py-1 bg-primary/10 rounded-full mb-4">
                    <span class="text-sm font-medium text-primary">Mulai Sekarang</span>
                </div>
                
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Siap Menemukan Produk Favorit Anda?
                </h2>
                <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                    Jelajahi koleksi lengkap kami dan temukan produk yang sesuai dengan kebutuhan dan gaya Anda.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="/products" class="group inline-flex items-center px-8 py-4 bg-primary text-white font-semibold rounded-xl hover:bg-primary/90 transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5">
                        <span>Lihat Semua Produk</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="/custom" class="inline-flex items-center px-8 py-4 bg-white text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:border-primary hover:text-primary transition-all duration-300">
                        <span>Custom Order</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
}

function filterByCategory(categoryId) {
    // Redirect to products page with category filter
    window.location.href = '/products?category=' + categoryId;
}
</script>

@endsection