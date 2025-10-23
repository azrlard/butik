<!-- Navbar -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-indigo-600 cursor-pointer" onclick="navigateTo('home')">
                    ✨ Butik Online
                </h1>
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="#" onclick="navigateTo('home')" class="nav-link text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</a>
                <a href="#" onclick="navigateTo('products')" class="nav-link text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Produk</a>
                <a href="#" onclick="navigateTo('custom')" class="nav-link text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Custom</a>
                <a href="#" onclick="navigateTo('cart')" class="nav-link text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors relative">
                    Keranjang
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-yellow-400 text-xs rounded-full h-5 w-5 flex items-center justify-center text-gray-800 font-semibold">0</span>
                </a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Login</a>
            </div>
            <div class="md:hidden">
                <button onclick="toggleMobileMenu()" class="text-gray-700 hover:text-indigo-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#" onclick="navigateTo('home')" class="block px-3 py-2 text-gray-700 hover:text-indigo-600">Home</a>
            <a href="#" onclick="navigateTo('products')" class="block px-3 py-2 text-gray-700 hover:text-indigo-600">Produk</a>
            <a href="#" onclick="navigateTo('custom')" class="block px-3 py-2 text-gray-700 hover:text-indigo-600">Custom</a>
            <a href="#" onclick="navigateTo('cart')" class="block px-3 py-2 text-gray-700 hover:text-indigo-600">Keranjang</a>
            <a href="#" class="block px-3 py-2 text-gray-700 hover:text-indigo-600">Login</a>
        </div>
    </div>
</nav>