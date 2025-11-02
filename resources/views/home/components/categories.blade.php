<!-- Categories Section -->
<section class="py-24 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-40" style="background-image: url('data:image/svg+xml,%3csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1000 600%22%3e%3cdefs%3e%3cpattern id=%22grid%22 patternUnits=%22userSpaceOnUse%22 width=%2250%22 height=%2250%22%3e%3ccircle cx=%2225%22 cy=%2225%22 r=%221%22 fill=%22rgba(99,102,241,0.1)%22/%3e%3c/pattern%3e%3c/defs%3e%3crect width=%221000%22 height=%22600%22 fill=%22url(%23grid)%22/%3e%3c/svg%3e')"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 leading-tight">
                Kategori Produk
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Pilih kategori sesuai dengan gaya dan kebutuhan Anda. Temukan berbagai pilihan fashion yang sesuai dengan personality Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($categories as $category)
                        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 text-center hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-300 transform hover:scale-105 border border-gray-100 hover:border-indigo-200 group">
                            <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-indigo-700 transition-colors">{{ $category->nama_kategori }}</h3>
                            <p class="text-sm text-gray-600 group-hover:text-gray-700 transition-colors">{{ $category->deskripsi ?? 'Kategori produk' }}</p>
                        </div>
                    @empty
                <p class="text-center text-gray-500 col-span-full">Tidak ada kategori tersedia</p>
            @endforelse
        </div>
    </div>
</section>