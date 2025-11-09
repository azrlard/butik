@extends('layouts.app')

@section('title', 'Produk - Butik Online')

@section('content')
<!-- Page: Products -->
<div id="products">
    @php
        $currentPage = 'Produk';
    @endphp
    @include('shared.breadcrumb')

    <!-- Hero Section -->
    <section class="bg-accent py-16 border-b border-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-6xl font-black text-text mb-6 leading-tight">
                    Semua Produk
                </h1>
                <p class="text-xl text-text max-w-3xl mx-auto leading-relaxed">
                    Temukan produk fashion terbaik untuk gaya Anda. Dari ready stock hingga custom order, semua ada di sini.
                </p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters Section - DI RAPIKAN -->
        <div class="bg-background rounded-2xl shadow-lg border border-secondary p-6 mb-8">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-6">
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-text mb-1">Filter & Cari Produk</h2>
                    <p class="text-sm text-text">Temukan produk yang sesuai dengan preferensi Anda</p>
                </div>
            </div>

            <form method="GET" action="{{ route('products.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-text mb-2">Kategori</label>
                    <select name="category" onchange="this.form.submit()"
                            class="w-full px-3 py-2 border border-secondary rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                        <option value="all">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-text mb-2">Tipe Produk</label>
                    <select name="type" onchange="this.form.submit()"
                            class="w-full px-3 py-2 border border-secondary rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                        <option value="all">Semua Tipe</option>
                        <option value="ready" {{ request('type') == 'ready' ? 'selected' : '' }}>Ready Stock</option>
                        <option value="custom" {{ request('type') == 'custom' ? 'selected' : '' }}>Custom Order</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-text mb-2">Cari Produk</label>
                    <div class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari nama produk..."
                               class="flex-1 px-3 py-2 border border-secondary rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                        <button type="submit"
                                class="px-4 py-2 bg-primary text-background rounded-lg font-medium hover:bg-secondary transition-colors whitespace-nowrap">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Products Grid - DI RAPIKAN -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-background rounded-xl shadow-md hover:shadow-lg transition-all duration-300 group overflow-hidden border border-secondary">
                    <!-- Product Image -->
                    <div class="aspect-square bg-accent flex items-center justify-center overflow-hidden">
                        @if($product->foto && file_exists(storage_path('app/public/' . $product->foto)))
                            <img src="{{ asset('storage/' . $product->foto) }}"
                                 alt="{{ $product->nama_produk }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="text-4xl text-text">👕</div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-base font-semibold text-text line-clamp-2 flex-1 mr-2">
                                {{ $product->nama_produk }}
                            </h3>
                            <span class="bg-secondary text-background text-xs px-2 py-1 rounded-full font-medium flex-shrink-0">
                                {{ ucfirst($product->tipe_produk) }}
                            </span>
                        </div>

                        <p class="text-text text-sm mb-3 line-clamp-2">
                            {{ $product->deskripsi ?? 'Deskripsi produk tidak tersedia' }}
                        </p>

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-lg font-bold text-primary">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('products.detail', $product->id) }}"
                           class="block w-full bg-primary text-background py-2 px-4 rounded-lg text-sm font-medium hover:bg-secondary transition-colors text-center">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="max-w-md mx-auto">
                        <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-5v2m0 0v2m0-2h2m-2 0h-2"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-text mb-2">Tidak ada produk ditemukan</h3>
                        <p class="text-text text-sm">Coba ubah filter pencarian Anda</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection