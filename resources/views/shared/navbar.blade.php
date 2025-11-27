<nav x-data="{ mobileMenuOpen: false }" class="bg-gradient-to-r from-surface to-accent shadow-xl border-b border-border fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="/" class="cursor-pointer">
                    <img src="{{ asset('images/logo mitra jeki.jpg') }}" alt="Butik" class="h-10 w-auto">
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-1">
                <a href="/" class="text-text hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-primary/10 hover:shadow-md">Home</a>
                <!-- POSISI DITUKAR: Kategori sekarang sebelum Produk -->
                <a href="/categories" class="text-text hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-primary/10 hover:shadow-md">Kategori</a>
                <a href="/products" class="text-text hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-primary/10 hover:shadow-md">Produk</a>
                <a href="/custom" class="text-text hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-primary/10 hover:shadow-md">Custom</a>
                <a href="/cart" class="text-text hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-primary/10 hover:shadow-md flex items-center">
                    Keranjang
                    <span id="cart-count-desktop" class="ml-2 bg-primary text-xs rounded-full h-5 w-5 flex items-center justify-center text-white font-semibold">0</span>
                </a>
                @if(auth()->check())
                    <div x-data="{ userMenuOpen: false }" class="relative">
                        <button @click="userMenuOpen = !userMenuOpen" class="text-text hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-primary/10 hover:shadow-md flex items-center">
                            {{ auth()->user()->name }}
                        </button>

                        <div x-show="userMenuOpen" x-cloak @click.away="userMenuOpen = false" class="absolute right-0 mt-2 w-56 bg-background rounded-xl shadow-xl border border-border py-2 z-50">
                            <a href="/profile" @click="userMenuOpen = false" class="flex items-center px-4 py-3 text-sm text-text hover:bg-primary/10 hover:text-primary transition-all duration-200 rounded-lg mx-2">
                                Informasi Akun
                            </a>
                            <a href="/orders" @click="userMenuOpen = false" class="flex items-center px-4 py-3 text-sm text-text hover:bg-primary/10 hover:text-primary transition-all duration-200 rounded-lg mx-2">
                                Riwayat Pesanan
                            </a>
                            <hr class="my-2 border-border">
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
                    <a href="/login" class="text-text hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-primary/10 hover:shadow-md">
                        Login
                    </a>
                @endif
            </div>
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-text hover:text-primary p-2 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu - POSISI JUGA DITUKAR -->
    <div x-show="mobileMenuOpen" x-transition x-cloak class="md:hidden bg-gradient-to-r from-surface to-accent border-t border-border shadow-xl">
        <div class="px-4 pt-4 pb-6 space-y-2">
            <a href="/" class="block w-full text-left px-4 py-3 text-text hover:text-primary hover:bg-primary/10 rounded-lg transition-all duration-300 font-medium">Home</a>
            <!-- POSISI DITUKAR: Kategori sekarang sebelum Produk -->
            <a href="/categories" class="block w-full text-left px-4 py-3 text-text hover:text-primary hover:bg-primary/10 rounded-lg transition-all duration-300 font-medium">Kategori</a>
            <a href="/products" class="block w-full text-left px-4 py-3 text-text hover:text-primary hover:bg-primary/10 rounded-lg transition-all duration-300 font-medium">Produk</a>
            <a href="/custom" class="block w-full text-left px-4 py-3 text-text hover:text-primary hover:bg-primary/10 rounded-lg transition-all duration-300 font-medium">Custom</a>
            <a href="/cart" class="flex items-center justify-between w-full px-4 py-3 text-text hover:text-primary hover:bg-primary/10 rounded-lg transition-all duration-300 font-medium">
                Keranjang
                <span id="cart-count-mobile" class="bg-primary text-xs rounded-full h-5 w-5 flex items-center justify-center text-white font-semibold">0</span>
            </a>
            @if(auth()->check())
                <div class="space-y-2">
                    <a href="/profile" class="block w-full text-left px-4 py-3 text-text hover:text-primary hover:bg-primary/10 rounded-lg transition-all duration-300 font-medium">
                        Informasi Akun
                    </a>
                    <a href="/orders" class="block w-full text-left px-4 py-3 text-text hover:text-primary hover:bg-primary/10 rounded-lg transition-all duration-300 font-medium">
                        Riwayat Pesanan
                    </a>
                    <hr class="border-border">
                    <form method="POST" action="/logout" class="px-4">
                        @csrf
                        <button type="submit" class="block w-full text-left px-0 py-3 text-red-600 hover:text-red-700 transition-colors font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="/login" class="block w-full text-left px-4 py-3 text-text hover:text-primary hover:bg-primary/10 rounded-lg transition-all duration-300 font-medium">
                    Login
                </a>
            @endif
        </div>
    </div>
</nav>