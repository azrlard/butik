@extends('layouts.app')

@section('title', 'Kolaborasi Vendor - Butik Online')

@section('content')
<!-- Page: Collaboration -->
<div id="collaboration">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-600 text-white py-24 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-48 translate-x-48"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/10 rounded-full blur-3xl translate-y-32 -translate-x-32"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-8">
                <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                    Kolaborasi Vendor
                </h1>
                <p class="text-xl md:text-2xl text-purple-100 max-w-4xl mx-auto leading-relaxed">
                    Temukan vendor-vendor terbaik kami dengan produk fashion berkualitas tinggi. Kolaborasi yang menghasilkan karya luar biasa.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button onclick="scrollToSection('vendors')" class="inline-flex items-center px-8 py-4 bg-white text-purple-600 font-bold rounded-2xl hover:bg-purple-50 transition-all duration-300 transform hover:scale-105 shadow-xl">
                    <span>Lihat Vendor</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </button>
                <button onclick="scrollToSection('featured')" class="inline-flex items-center px-8 py-4 bg-purple-500/20 backdrop-blur-sm border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-purple-500/30 transition-all duration-300">
                    <span>Produk Unggulan</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Featured Vendors Section -->
    <section id="vendors" class="py-24 bg-gradient-to-br from-white to-purple-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Vendor Terpilih Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kolaborasi dengan vendor-vendor terbaik yang menghasilkan produk fashion berkualitas tinggi dan inovatif.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- Vendor 1 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-white">SF</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Sarah Fashion</h3>
                        <p class="text-purple-600 font-semibold">Specialist Pakaian Wanita</p>
                    </div>
                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                        Vendor terpercaya dengan koleksi pakaian wanita modern dan berkualitas. Spesialis dalam busana kasual dan formal.
                    </p>
                    <div class="flex justify-center space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            500+ Produk
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            4.8 Rating
                        </span>
                    </div>
                </div>

                <!-- Vendor 2 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-white">AA</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Ahmad Accessories</h3>
                        <p class="text-indigo-600 font-semibold">Specialist Aksesoris Fashion</p>
                    </div>
                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                        Koleksi aksesoris fashion terlengkap dengan desain unik dan bahan berkualitas tinggi. Dari gelang hingga tas.
                    </p>
                    <div class="flex justify-center space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            300+ Produk
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 0-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 0-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 0.951-.69l1.519-4.674z"></path>
                            </svg>
                            4.9 Rating
                        </span>
                    </div>
                </div>

                <!-- Vendor 3 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-white">MB</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Maya Boutique</h3>
                        <p class="text-blue-600 font-semibold">Specialist Custom Order</p>
                    </div>
                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                        Ahli dalam custom order fashion dengan sentuhan personal. Mewujudkan visi fashion Anda menjadi kenyataan.
                    </p>
                    <div class="flex justify-center space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            200+ Custom
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            5.0 Rating
                        </span>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button onclick="scrollToSection('featured')" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold rounded-2xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-xl">
                    <span>Lihat Produk Vendor</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="featured" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Produk Unggulan Vendor
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Koleksi produk terbaik dari vendor-vendor terpilih kami. Kualitas dan kreativitas dalam setiap detail.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Featured Product 1 -->
                <div onclick="openProductModal('1')" class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer group overflow-hidden border border-gray-100">
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-6xl group-hover:scale-110 transition-transform duration-300">
                        👗
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-700 transition-colors line-clamp-2">Dress Casual Sarah</h3>
                            <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full font-semibold ml-2 flex-shrink-0">
                                Sarah Fashion
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Dress casual dengan desain modern dan bahan berkualitas tinggi.</p>
                        <div class="text-2xl font-black text-indigo-600">
                            Rp 250.000
                        </div>
                        <button onclick="event.stopPropagation(); window.location.href='/products/1'" class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                            View
                        </button>
                    </div>
                </div>

                <!-- Featured Product 2 -->
                <div onclick="openProductModal('2')" class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer group overflow-hidden border border-gray-100">
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-6xl group-hover:scale-110 transition-transform duration-300">
                        💍
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-700 transition-colors line-clamp-2">Gelang Bohemian</h3>
                            <span class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded-full font-semibold ml-2 flex-shrink-0">
                                Ahmad Accessories
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Gelang bohemian dengan kombinasi batu alam dan manik-manik.</p>
                        <div class="text-2xl font-black text-indigo-600">
                            Rp 85.000
                        </div>
                        <button onclick="event.stopPropagation(); window.location.href='/products/2'" class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                            View
                        </button>
                    </div>
                </div>

                <!-- Featured Product 3 -->
                <div onclick="openProductModal('3')" class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer group overflow-hidden border border-gray-100">
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-6xl group-hover:scale-110 transition-transform duration-300">
                        👔
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-700 transition-colors line-clamp-2">Kemeja Formal Custom</h3>
                            <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-semibold ml-2 flex-shrink-0">
                                Maya Boutique
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Kemeja formal dengan desain custom sesuai permintaan Anda.</p>
                        <div class="text-2xl font-black text-indigo-600">
                            Rp 180.000
                        </div>
                        <button onclick="event.stopPropagation(); window.location.href='/products/3'" class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                            View
                        </button>
                    </div>
                </div>

                <!-- Featured Product 4 -->
                <div onclick="openProductModal('4')" class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer group overflow-hidden border border-gray-100">
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-6xl group-hover:scale-110 transition-transform duration-300">
                        👜
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-700 transition-colors line-clamp-2">Tas Kulit Premium</h3>
                            <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full font-semibold ml-2 flex-shrink-0">
                                Sarah Fashion
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Tas kulit premium dengan finishing yang sempurna dan tahan lama.</p>
                        <div class="text-2xl font-black text-indigo-600">
                            Rp 450.000
                        </div>
                        <button onclick="event.stopPropagation(); window.location.href='/products/4'" class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                            View
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="/products" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold rounded-2xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-xl">
                    <span>Lihat Semua Produk</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section class="py-24 bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-black mb-6">
                Butuh Bantuan?
            </h2>
            <p class="text-xl text-purple-100 mb-12 max-w-2xl mx-auto">
                Tim kami siap membantu Anda dengan pertanyaan seputar program vendor. Jangan ragu untuk menghubungi kami!
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                    <svg class="w-12 h-12 text-white mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <h3 class="text-xl font-bold mb-2">Telepon</h3>
                    <p class="text-purple-100">+62 21 1234 5678</p>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                    <svg class="w-12 h-12 text-white mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-bold mb-2">Email</h3>
                    <p class="text-purple-100">vendor@butikonline.com</p>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                    <svg class="w-12 h-12 text-white mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="text-xl font-bold mb-2">WhatsApp</h3>
                    <p class="text-purple-100">+62 812 3456 7890</p>
                </div>
            </div>

            <button onclick="scrollToSection('register')" class="inline-flex items-center px-8 py-4 bg-white text-purple-600 font-bold rounded-2xl hover:bg-purple-50 transition-all duration-300 transform hover:scale-105 shadow-xl">
                <span>Mulai Sekarang</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </button>
        </div>
    </section>
</div>

<script>
function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
}

function toggleFAQ(button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector('svg');

    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}

// Initialize FAQ icons
document.addEventListener('DOMContentLoaded', function() {
    const faqButtons = document.querySelectorAll('[onclick="toggleFAQ(this)"]');
    faqButtons.forEach(button => {
        const icon = button.querySelector('svg');
        icon.style.transition = 'transform 0.3s ease';
    });
});
</script>

@endsection