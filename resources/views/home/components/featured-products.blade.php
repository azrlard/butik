<!-- Featured Products -->
<section class="py-24 bg-surface relative">
    <!-- Background Elements -->
    <div
        class="absolute top-0 right-0 w-96 h-96 bg-secondary/15 rounded-full blur-3xl -translate-y-48 translate-x-48">
    </div>
    <div
        class="absolute bottom-0 left-0 w-80 h-80 bg-primary/15 rounded-full blur-3xl translate-y-32 -translate-x-32">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-20 gap-8">
            <div class="flex-1">
                <h2 class="text-4xl md:text-5xl font-black text-text mb-6 leading-tight">
                    Produk Terbaru
                </h2>
                <p class="text-xl text-text max-w-2xl leading-relaxed">
                    Koleksi terbaru yang sedang trending di kalangan fashionista. Jangan sampai ketinggalan!
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                <button onclick="window.location.href='/products'"
                    class="inline-flex items-center px-8 py-4 bg-primary border-2 border-primary text-white font-semibold rounded-2xl hover:bg-primary/90 transition-all duration-300 shadow-lg hover:shadow-xl group">
                    <span>Lihat Semua</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $featuredProducts = $products->where('tipe_produk', 'ready')->take(4);
            @endphp
            @forelse($featuredProducts as $product)
                <div x-data="{ showModal: false }" class="bg-background rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer group overflow-hidden border border-secondary">
                    <!-- Product Image -->
                    <div
                        class="aspect-square bg-surface flex items-center justify-center overflow-hidden rounded-t-2xl">
                        @if ($product->foto && Storage::disk('public')->exists($product->foto))
                            <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_produk }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="text-4xl text-text">👕</div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3
                                class="text-lg font-bold text-text group-hover:text-primary transition-colors line-clamp-2">
                                {{ $product->nama_produk }}</h3>
                            <span
                                class="bg-primary text-white text-xs px-2 py-1 rounded-full font-semibold ml-2 flex-shrink-0">
                                {{ ucfirst($product->tipe_produk) }}
                            </span>
                        </div>

                        <p class="text-text text-sm mb-4 line-clamp-2">
                            {{ $product->deskripsi ?? 'Deskripsi produk tidak tersedia' }}</p>

                        <div class="text-2xl font-black text-primary">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </div>

                        <!-- View Button -->
                        <button @click="window.location.href='/products/{{ $product->id }}'"
                            class="mt-4 w-full bg-primary text-white py-2 px-4 rounded-lg font-semibold hover:bg-primary/90 transition-colors">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-center text-text col-span-full">Tidak ada produk ready stock tersedia</p>
            @endforelse
        </div>


    </div>
</section>
