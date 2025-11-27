<!-- Categories Section -->
<section class="py-24 bg-background relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-30" style="background-image: url('data:image/svg+xml,%3csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1000 600%22%3e%3cdefs%3e%3cpattern id=%22grid%22 patternUnits=%22userSpaceOnUse%22 width=%2250%22 height=%2250%22%3e%3ccircle cx=%2225%22 cy=%2225%22 r=%221%22 fill=%22rgba(199,160,122,0.15)%22/%3e%3c/pattern%3e%3c/defs%3e%3crect width=%221000%22 height=%22600%22 fill=%22url(%23grid)%22/%3e%3c/svg%3e')"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-black text-text mb-6 leading-tight">
                Kategori Produk
            </h2>
            <p class="text-xl text-text max-w-3xl mx-auto leading-relaxed">
                Pilih kategori sesuai dengan gaya dan kebutuhan Anda. Temukan berbagai pilihan fashion yang sesuai dengan personality Anda.
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-8">
            @forelse($categories as $category)
                        <div class="bg-background rounded-3xl p-8 text-center hover:shadow-2xl hover:shadow-primary/20 transition-all duration-500 transform hover:scale-105 border border-border group min-w-[350px] max-w-[400px] flex-1 hover:border-primary/30">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <span class="text-2xl text-white">📦</span>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-text group-hover:text-primary transition-colors duration-300">{{ $category->nama_kategori }}</h3>
                            <p class="text-sm text-textSecondary group-hover:text-text transition-colors duration-300">{{ $category->deskripsi ?? 'Kategori produk' }}</p>
                        </div>
                    @empty
                <p class="text-center text-text w-full">Tidak ada kategori tersedia</p>
            @endforelse
        </div>
    </div>
</section>