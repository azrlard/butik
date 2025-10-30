<!-- Page: Products -->
<div id="products" class="page">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Semua Produk</h1>
                <p class="text-gray-600 mt-2">Temukan produk fashion terbaik untuk gaya Anda</p>
            </div>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                <select id="category-filter" onchange="filterProducts()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                    <option value="all">Semua Kategori</option>
                    <!-- Categories will be loaded dynamically from admin dashboard -->
                </select>
                <select id="type-filter" onchange="filterProducts()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                    <option value="all">Semua Tipe</option>
                    <!-- Product types will be loaded dynamically -->
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="products-grid">
            <!-- Products will be loaded here -->
        </div>

        <!-- Product Detail Modal -->
        <div id="product-modal" class="modal hidden">
            <div class="bg-white rounded-xl max-w-4xl w-full mx-4 max-h-screen overflow-y-auto">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-800">Detail Produk</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl">×</button>
                </div>
                <div id="modal-content" class="p-6">
                    <!-- Modal content will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Loading indicator -->
        <div id="loading-indicator" class="text-center py-8">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
            <p class="mt-2 text-gray-600">Memuat produk...</p>
        </div>
    </div>
</div>

<script src="{{ asset('js/modal.js') }}"></script>