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
                    <option value="pakaian">Pakaian</option>
                    <option value="tas">Tas & Dompet</option>
                    <option value="aksesoris">Aksesoris</option>
                    <option value="sepatu">Sepatu</option>
                </select>
                <select id="type-filter" onchange="filterProducts()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                    <option value="all">Semua Tipe</option>
                    <option value="ready">Ready Stock</option>
                    <option value="custom">Custom Order</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="products-grid">
            <!-- Products will be loaded here -->
        </div>
    </div>
</div>