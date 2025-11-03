<!-- Navbar -->
<nav class="bg-white/95 backdrop-blur-sm shadow-lg border-b border-gray-100 fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent cursor-pointer hover:scale-105 transition-transform duration-200">
                    ✨ Butik Online
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-1">
                <a href="/" class="nav-link text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-indigo-50 relative group">Home</a>
                <a href="/products" class="nav-link text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-indigo-50 relative group">Produk</a>
                <a href="/custom" class="nav-link text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-indigo-50 relative group">Custom</a>
                <a href="/cart" class="nav-link text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-indigo-50 relative group">
                    <span class="flex items-center">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13v8a2 2 0 002 2h10a2 2 0 002-2v-3" />
                        </svg>
                        <span id="cart-count" class="ml-2 bg-gradient-to-r from-yellow-400 to-orange-400 text-xs rounded-full h-5 w-5 flex items-center justify-center text-white font-semibold shadow-lg">0</span>
                    </span>
                </a>
                <button onclick="showLoginModal()" class="nav-link text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-indigo-50 relative group">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </button>
                <a href="/admin" target="_blank" class="text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-indigo-50 hidden">Admin</a>
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
    <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-sm border-t border-gray-100 shadow-lg">
        <div class="px-4 pt-4 pb-6 space-y-2">
            <a href="/" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 font-medium">Home</a>
            <a href="/products" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 font-medium">Produk</a>
            <a href="/custom" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 font-medium">Custom</a>
            <a href="/cart" class="flex items-center justify-between w-full px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 font-medium">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13v8a2 2 0 002 2h10a2 2 0 002-2v-3" />
                </svg>
                <span id="cart-count-mobile" class="bg-gradient-to-r from-yellow-400 to-orange-400 text-xs rounded-full h-5 w-5 flex items-center justify-center text-white font-semibold">0</span>
            </a>
            <button onclick="showLoginModal()" class="flex items-center justify-between w-full px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 font-medium">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </button>
            <a href="/admin" target="_blank" class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 font-medium hidden">Admin</a>
        </div>
    </div>
</nav>