<!-- Featured Products -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-16">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Produk Terbaru</h2>
                <p class="text-xl text-gray-600">Koleksi terbaru yang sedang trending</p>
            </div>
            <button onclick="navigateTo('products')" class="hidden md:block text-indigo-600 hover:text-indigo-800 font-semibold text-lg">
                Lihat Semua →
            </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" id="featured-products">
            <!-- Featured products will be loaded here -->
        </div>
    </div>
</section>