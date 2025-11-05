<nav class="bg-white/95 backdrop-blur-sm shadow-lg border-b border-gray-100 fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent cursor-pointer">
                    ✨ Butik Online
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-1">
                <a href="/" class="text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-indigo-50">Home</a>
                <a href="/products" class="text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-indigo-50">Produk</a>
                <a href="/categories" class="text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-indigo-50">Kategori</a>
                <a href="/custom" class="text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-indigo-50">Custom</a>
                <a href="/cart" class="text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-indigo-50 flex items-center">
                    Keranjang
                    <span id="cart-count" class="ml-2 bg-yellow-400 text-xs rounded-full h-5 w-5 flex items-center justify-center text-white font-semibold">0</span>
                </a>
                @if(auth()->check())
                    <div class="relative user-menu-container">
                        <button onclick="toggleUserMenu()" class="text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-indigo-50 flex items-center">
                            👤 {{ auth()->user()->name }}
                        </button>

                        <div class="user-menu-dropdown absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50 hidden">
                            <a href="/profile" onclick="closeUserMenu()" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                📝 Informasi Akun
                            </a>
                            <a href="/orders" onclick="closeUserMenu()" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                📦 Riwayat Pesanan
                            </a>
                            <a href="/settings" onclick="closeUserMenu()" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                ⚙️ Pengaturan
                            </a>
                            <hr class="my-2 border-gray-200">
                            <div class="px-4">
                                <form method="POST" action="/logout" onsubmit="closeUserMenu()">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-0 py-2 text-sm text-red-600 hover:text-red-700 transition-colors">
                                        🚪 Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="/login" class="text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-indigo-50">
                        👤 Login
                    </a>
                @endif
            </div>
            <div class="md:hidden">
                <button onclick="toggleMobileMenu()" class="text-gray-700 hover:text-indigo-600">
                    ☰
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-sm border-t border-gray-100 shadow-lg">
        <div class="px-4 pt-4 pb-6 space-y-2">
            <a href="/" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors font-medium">Home</a>
            <a href="/products" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors font-medium">Produk</a>
            <a href="/categories" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors font-medium">Kategori</a>
            <a href="/custom" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors font-medium">Custom</a>
            <a href="/cart" class="flex items-center justify-between w-full px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors font-medium">
                Keranjang
                <span id="cart-count-mobile" class="bg-yellow-400 text-xs rounded-full h-5 w-5 flex items-center justify-center text-white font-semibold">0</span>
            </a>
            @if(auth()->check())
                <div class="space-y-2">
                    <a href="/profile" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors font-medium">
                        📝 Informasi Akun
                    </a>
                    <a href="/orders" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors font-medium">
                        📦 Riwayat Pesanan
                    </a>
                    <a href="/settings" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors font-medium">
                        ⚙️ Pengaturan
                    </a>
                    <hr class="border-gray-200">
                    <form method="POST" action="/logout" class="px-4">
                        @csrf
                        <button type="submit" class="block w-full text-left px-0 py-3 text-red-600 hover:text-red-700 transition-colors font-medium">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="/login" class="block w-full text-left px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors font-medium">
                    👤 Login
                </a>
            @endif
        </div>
    </div>
</nav>