<nav x-data="{ mobileMenuOpen: false }" class="bg-primary/95 backdrop-blur-sm shadow-lg border-b border-secondary fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold bg-gradient-to-r from-secondary to-accent bg-clip-text text-transparent cursor-pointer">
                    Butik Online
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-1">
                <a href="/" class="text-white hover:text-accent px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-accent">Home</a>
                <!-- POSISI DITUKAR: Kategori sekarang sebelum Produk -->
                <a href="/categories" class="text-white hover:text-accent px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-accent">Kategori</a>
                <a href="/products" class="text-white hover:text-accent px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-accent">Produk</a>
                <a href="/custom" class="text-white hover:text-accent px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-accent">Custom</a>
                <a href="/cart" class="text-white hover:text-accent px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-accent flex items-center">
                    Keranjang
                    <span x-data="{ cartCount: 0 }" x-init="cartCount = JSON.parse(localStorage.getItem('cart') || '[]').reduce((sum, item) => sum + item.quantity, 0)" x-text="cartCount" class="ml-2 bg-accent text-xs rounded-full h-5 w-5 flex items-center justify-center text-text font-semibold">0</span>
                </a>
                @if(auth()->check())
                    <div x-data="{ userMenuOpen: false }" class="relative">
                        <button @click="userMenuOpen = !userMenuOpen" class="text-white hover:text-accent px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-accent flex items-center">
                            {{ auth()->user()->name }}
                        </button>

                        <div x-show="userMenuOpen" x-cloak @click.away="userMenuOpen = false" class="absolute right-0 mt-2 w-56 bg-background rounded-lg shadow-lg border border-secondary py-2 z-50">
                            <a href="/profile" @click="userMenuOpen = false" class="flex items-center px-4 py-3 text-sm text-text hover:bg-accent hover:text-secondary transition-colors">
                                Informasi Akun
                            </a>
                            <a href="/orders" @click="userMenuOpen = false" class="flex items-center px-4 py-3 text-sm text-text hover:bg-accent hover:text-secondary transition-colors">
                                Riwayat Pesanan
                            </a>
                            <a href="/settings" @click="userMenuOpen = false" class="flex items-center px-4 py-3 text-sm text-text hover:bg-accent hover:text-secondary transition-colors">
                                Pengaturan
                            </a>
                            <hr class="my-2 border-secondary">
                            <div class="px-4">
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-0 py-2 text-sm text-red-600 hover:text-red-700 transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="/login" class="text-white hover:text-accent px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-accent">
                        Login
                    </a>
                @endif
            </div>
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-accent">
                    ☰
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu - POSISI JUGA DITUKAR -->
    <div x-show="mobileMenuOpen" x-cloak class="hidden md:hidden bg-primary/95 backdrop-blur-sm border-t border-secondary shadow-lg">
        <div class="px-4 pt-4 pb-6 space-y-2">
            <a href="/" class="block w-full text-left px-4 py-3 text-white hover:text-accent hover:bg-accent rounded-lg transition-colors font-medium">Home</a>
            <!-- POSISI DITUKAR: Kategori sekarang sebelum Produk -->
            <a href="/categories" class="block w-full text-left px-4 py-3 text-white hover:text-accent hover:bg-accent rounded-lg transition-colors font-medium">Kategori</a>
            <a href="/products" class="block w-full text-left px-4 py-3 text-white hover:text-accent hover:bg-accent rounded-lg transition-colors font-medium">Produk</a>
            <a href="/custom" class="block w-full text-left px-4 py-3 text-white hover:text-accent hover:bg-accent rounded-lg transition-colors font-medium">Custom</a>
            <a href="/cart" class="flex items-center justify-between w-full px-4 py-3 text-white hover:text-accent hover:bg-accent rounded-lg transition-colors font-medium">
                Keranjang
                <span id="cart-count-mobile" class="bg-accent text-xs rounded-full h-5 w-5 flex items-center justify-center text-text font-semibold">0</span>
            </a>
            @if(auth()->check())
                <div class="space-y-2">
                    <a href="/profile" class="block w-full text-left px-4 py-3 text-white hover:text-accent hover:bg-accent rounded-lg transition-colors font-medium">
                        Informasi Akun
                    </a>
                    <a href="/orders" class="block w-full text-left px-4 py-3 text-white hover:text-accent hover:bg-accent rounded-lg transition-colors font-medium">
                        Riwayat Pesanan
                    </a>
                    <a href="/settings" class="block w-full text-left px-4 py-3 text-white hover:text-accent hover:bg-accent rounded-lg transition-colors font-medium">
                        Pengaturan
                    </a>
                    <hr class="border-secondary">
                    <form method="POST" action="/logout" class="px-4">
                        @csrf
                        <button type="submit" class="block w-full text-left px-0 py-3 text-red-600 hover:text-red-700 transition-colors font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="/login" class="block w-full text-left px-4 py-3 text-white hover:text-accent hover:bg-accent rounded-lg transition-colors font-medium">
                    Login
                </a>
            @endif
        </div>
    </div>
</nav>