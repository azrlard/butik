<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butik Online - Temukan Gaya Unikmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .hero-bg {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.9), rgba(124, 58, 237, 0.8)), 
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 600"><defs><pattern id="fashion" patternUnits="userSpaceOnUse" width="100" height="100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="1000" height="600" fill="url(%23fashion)"/></svg>');
            background-size: cover;
            background-position: center;
        }
        .custom-shadow {
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 4px 6px -2px rgba(79, 70, 229, 0.05);
        }
        .page {
            display: none;
        }
        .page.active {
            display: block;
        }
        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #4F46E5;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transform: translateY(100px);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .scroll-to-top.show {
            opacity: 1;
            transform: translateY(0);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal.show {
            display: flex;
        }
        .notification {
            position: fixed;
            top: 80px;
            right: 20px;
            background: #10B981;
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 1001;
        }
        .notification.show {
            transform: translateX(0);
        }
    </style>
</head>
<body class="h-full bg-gray-50">
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

    <!-- Page: Home -->
    <div id="home" class="page active">
        <!-- Hero Section -->
        <section class="hero-bg text-white py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    Temukan Gaya Unikmu di<br>
                    <span class="text-yellow-400">Butik Online</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90 max-w-3xl mx-auto">
                    Produk Fashion Ready & Custom untuk Semua Gaya — Wujudkan Impian Fashion Anda Bersama Kami
                </p>
                <button onclick="navigateTo('products')" class="bg-yellow-400 text-gray-800 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-yellow-300 transition-all transform hover:scale-105 custom-shadow">
                    Belanja Sekarang
                </button>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Kategori Produk</h2>
                    <p class="text-xl text-gray-600">Pilih kategori sesuai dengan gaya dan kebutuhan Anda</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="categories-grid">
                    <!-- Categories will be loaded here -->
                </div>
            </div>
        </section>

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

        <!-- Custom CTA Section -->
        <section class="py-20 bg-indigo-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="text-6xl mb-6">🎨</div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Punya Desain Sendiri?</h2>
                    <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
                        Kirim Permintaan Custom Sekarang! Tim ahli kami siap mewujudkan desain impian Anda dengan kualitas terbaik.
                    </p>
                    <button onclick="navigateTo('custom')" class="bg-yellow-400 text-gray-800 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-yellow-300 transition-all transform hover:scale-105">
                        Buat Custom Request
                    </button>
                </div>
            </div>
        </section>
    </div>

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

    <!-- Page: Product Detail -->
    <div id="product-detail" class="page">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12" id="product-detail-content">
                <!-- Product detail will be loaded here -->
            </div>
            
            <!-- Similar Products -->
            <div class="mt-20">
                <h3 class="text-2xl font-bold text-gray-800 mb-8">Produk Serupa</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="similar-products">
                    <!-- Similar products will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Page: Cart -->
    <div id="cart" class="page">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Keranjang Belanja</h1>
            
            <div id="cart-empty" class="text-center py-20">
                <div class="text-8xl mb-6">🛒</div>
                <h2 class="text-2xl font-semibold text-gray-600 mb-4">Keranjang Anda Kosong</h2>
                <p class="text-gray-500 mb-8">Mulai berbelanja dan tambahkan produk favorit Anda</p>
                <button onclick="navigateTo('products')" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-colors">
                    Mulai Belanja
                </button>
            </div>

            <div id="cart-content" class="hidden">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-800">Item Belanja</h3>
                            </div>
                            <div id="cart-items" class="divide-y divide-gray-200">
                                <!-- Cart items will be loaded here -->
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                            <h3 class="text-xl font-semibold text-gray-800 mb-6">Ringkasan Pesanan</h3>
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span id="cart-subtotal">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Ongkos Kirim</span>
                                    <span>Rp 15.000</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Pajak</span>
                                    <span id="cart-tax">Rp 0</span>
                                </div>
                                <hr class="border-gray-200">
                                <div class="flex justify-between text-xl font-bold text-gray-800">
                                    <span>Total</span>
                                    <span id="cart-total">Rp 15.000</span>
                                </div>
                            </div>
                            
                            <button onclick="checkout()" class="w-full bg-indigo-600 text-white px-6 py-4 rounded-xl text-lg font-semibold hover:bg-indigo-700 transition-colors mb-4">
                                Checkout Sekarang
                            </button>
                            <button onclick="navigateTo('products')" class="w-full bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-300 transition-colors">
                                Lanjut Belanja
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page: Custom Request -->
    <div id="custom" class="page">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Custom Request</h1>
                <p class="text-xl text-gray-600">Wujudkan desain impian Anda bersama tim ahli kami</p>
            </div>

            <!-- Process Steps -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-16">
                <div class="text-center">
                    <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">📝</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">1. Kirim Request</h3>
                    <p class="text-gray-600 text-sm">Upload foto referensi dan jelaskan desain Anda</p>
                </div>
                <div class="text-center">
                    <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">💬</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">2. Konsultasi</h3>
                    <p class="text-gray-600 text-sm">Tim kami akan menghubungi untuk diskusi detail</p>
                </div>
                <div class="text-center">
                    <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">💰</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">3. Estimasi Harga</h3>
                    <p class="text-gray-600 text-sm">Dapatkan estimasi harga yang transparan</p>
                </div>
                <div class="text-center">
                    <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">✨</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">4. Produksi</h3>
                    <p class="text-gray-600 text-sm">Produk custom Anda dibuat dengan teliti</p>
                </div>
            </div>

            <!-- Custom Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form id="custom-form" onsubmit="submitCustomRequest(event)">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="customer-name" class="block text-sm font-semibold text-gray-800 mb-2">Nama Lengkap</label>
                            <input type="text" id="customer-name" name="customer-name" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
                        </div>
                        <div>
                            <label for="customer-email" class="block text-sm font-semibold text-gray-800 mb-2">Email</label>
                            <input type="email" id="customer-email" name="customer-email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
                        </div>
                        <div>
                            <label for="customer-phone" class="block text-sm font-semibold text-gray-800 mb-2">Nomor Telepon</label>
                            <input type="tel" id="customer-phone" name="customer-phone" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
                        </div>
                        <div>
                            <label for="product-category" class="block text-sm font-semibold text-gray-800 mb-2">Kategori Produk</label>
                            <select id="product-category" name="product-category" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
                                <option value="">Pilih kategori</option>
                                <option value="pakaian">Pakaian</option>
                                <option value="tas">Tas & Dompet</option>
                                <option value="aksesoris">Aksesoris</option>
                                <option value="sepatu">Sepatu</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="design-description" class="block text-sm font-semibold text-gray-800 mb-2">Keterangan Desain</label>
                        <textarea id="design-description" name="design-description" rows="6" required placeholder="Jelaskan detail desain yang Anda inginkan, termasuk warna, ukuran, bahan, dan spesifikasi lainnya..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors resize-none"></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="reference-photos" class="block text-sm font-semibold text-gray-800 mb-2">Upload Foto Referensi</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-indigo-400 transition-colors">
                            <input type="file" id="reference-photos" name="reference-photos" accept="image/*" multiple class="hidden" onchange="handleFileUpload(event)">
                            <div onclick="document.getElementById('reference-photos').click()" class="cursor-pointer">
                                <div class="text-6xl mb-4">📷</div>
                                <p class="text-gray-600 mb-2 font-semibold">Klik untuk upload foto referensi</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG, GIF (Max 5MB per file)</p>
                            </div>
                            <div id="uploaded-files" class="mt-4 space-y-2"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="budget-estimate" class="block text-sm font-semibold text-gray-800 mb-2">Estimasi Budget</label>
                            <select id="budget-estimate" name="budget-estimate" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
                                <option value="">Pilih range budget</option>
                                <option value="100000-300000">Rp 100.000 - Rp 300.000</option>
                                <option value="300000-500000">Rp 300.000 - Rp 500.000</option>
                                <option value="500000-1000000">Rp 500.000 - Rp 1.000.000</option>
                                <option value="1000000+">Di atas Rp 1.000.000</option>
                            </select>
                        </div>
                        <div>
                            <label for="deadline" class="block text-sm font-semibold text-gray-800 mb-2">Target Selesai</label>
                            <input type="date" id="deadline" name="deadline" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-4 rounded-xl text-lg font-semibold hover:bg-indigo-700 transition-colors custom-shadow">
                        Kirim Permintaan Custom
                    </button>
                </form>
            </div>

            <!-- Success Message -->
            <div id="custom-success" class="hidden mt-8 bg-green-50 border border-green-200 rounded-xl p-8 text-center">
                <div class="text-6xl mb-4">✅</div>
                <h3 class="text-2xl font-semibold text-green-800 mb-4">Permintaan Berhasil Dikirim!</h3>
                <p class="text-green-700 text-lg">Tim kami akan menghubungi Anda dalam 1x24 jam untuk diskusi lebih lanjut mengenai desain custom Anda.</p>
            </div>
        </div>
    </div>

    <!-- Product Detail Modal -->
    <div id="product-modal" class="modal">
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

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-16 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-bold mb-4">✨ Butik Online</h3>
                    <p class="text-gray-400 mb-6 max-w-md">
                        Platform fashion terpercaya untuk produk ready stock dan custom order. 
                        Wujudkan gaya unik Anda bersama kami.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors text-2xl">📘</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors text-2xl">📷</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors text-2xl">🐦</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors text-2xl">💬</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" onclick="navigateTo('home')" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#" onclick="navigateTo('products')" class="hover:text-white transition-colors">Produk</a></li>
                        <li><a href="#" onclick="navigateTo('custom')" class="hover:text-white transition-colors">Custom Order</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <span class="mr-2">📧</span>
                            info@butikonline.com
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2">📱</span>
                            +62 812-3456-7890
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2">📍</span>
                            Jakarta, Indonesia
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2">🕒</span>
                            Senin - Sabtu: 09:00 - 21:00
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Butik Online. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <div class="scroll-to-top" onclick="scrollToTop()">
        ↑
    </div>

    <script>
        // Sample data based on database structure
        const categories = [
            { id: 1, nama_kategori: 'Pakaian', deskripsi: 'Koleksi pakaian trendy dan elegan untuk berbagai acara', icon: '👗', color: 'from-pink-400 to-pink-600' },
            { id: 2, nama_kategori: 'Tas & Dompet', deskripsi: 'Tas berkualitas tinggi dan dompet stylish untuk melengkapi penampilan', icon: '👜', color: 'from-blue-400 to-blue-600' },
            { id: 3, nama_kategori: 'Aksesoris', deskripsi: 'Aksesoris cantik untuk mempercantik outfit harian Anda', icon: '💍', color: 'from-yellow-400 to-yellow-600' },
            { id: 4, nama_kategori: 'Sepatu', deskripsi: 'Koleksi sepatu nyaman dan fashionable untuk segala aktivitas', icon: '👠', color: 'from-purple-400 to-purple-600' },
            { id: 5, nama_kategori: 'Jam Tangan', deskripsi: 'Jam tangan elegant dan modern untuk pria dan wanita', icon: '⌚', color: 'from-green-400 to-green-600' },
            { id: 6, nama_kategori: 'Perhiasan', deskripsi: 'Perhiasan berkualitas tinggi untuk momen spesial Anda', icon: '💎', color: 'from-indigo-400 to-indigo-600' }
        ];

        const products = [
            { id: 1, nama_produk: 'Dress Elegant Premium', deskripsi: 'Dress elegant dengan bahan premium, cocok untuk acara formal dan semi-formal. Tersedia dalam berbagai ukuran.', harga: 299000, stok: 15, foto: '👗', tipe_produk: 'ready', kategori: 'pakaian', rating: 4.8, terjual: 120 },
            { id: 2, nama_produk: 'Tas Kulit Asli Premium', deskripsi: 'Tas kulit asli dengan desain minimalis dan elegan. Dilengkapi dengan kompartemen yang fungsional.', harga: 450000, stok: 8, foto: '👜', tipe_produk: 'ready', kategori: 'tas', rating: 4.9, terjual: 85 },
            { id: 3, nama_produk: 'Kalung Emas Putih', deskripsi: 'Kalung emas putih dengan desain modern dan elegan. Cocok untuk acara formal maupun kasual.', harga: 750000, stok: 5, foto: '💍', tipe_produk: 'ready', kategori: 'aksesoris', rating: 4.7, terjual: 45 },
            { id: 4, nama_produk: 'Blazer Formal Wanita', deskripsi: 'Blazer formal dengan potongan yang sempurna untuk wanita karir. Bahan berkualitas tinggi dan nyaman digunakan.', harga: 380000, stok: 12, foto: '🧥', tipe_produk: 'ready', kategori: 'pakaian', rating: 4.6, terjual: 95 },
            { id: 5, nama_produk: 'Sepatu Heels Elegant', deskripsi: 'Sepatu heels dengan desain elegant dan nyaman untuk digunakan seharian. Tersedia dalam berbagai warna.', harga: 320000, stok: 20, foto: '👠', tipe_produk: 'ready', kategori: 'sepatu', rating: 4.5, terjual: 150 },
            { id: 6, nama_produk: 'Kemeja Silk Premium', deskripsi: 'Kemeja silk premium dengan kualitas terbaik. Lembut, nyaman, dan memberikan kesan mewah.', harga: 250000, stok: 18, foto: '👔', tipe_produk: 'ready', kategori: 'pakaian', rating: 4.8, terjual: 200 },
            { id: 7, nama_produk: 'Clutch Evening Bag', deskripsi: 'Clutch bag elegant untuk acara malam. Desain minimalis dengan detail yang mewah.', harga: 180000, stok: 10, foto: '👛', tipe_produk: 'ready', kategori: 'tas', rating: 4.4, terjual: 75 },
            { id: 8, nama_produk: 'Anting Berlian Asli', deskripsi: 'Anting berlian asli dengan sertifikat. Investasi perhiasan yang bernilai tinggi.', harga: 890000, stok: 3, foto: '💎', tipe_produk: 'ready', kategori: 'aksesoris', rating: 4.9, terjual: 25 },
            { id: 9, nama_produk: 'Custom Wedding Dress', deskripsi: 'Gaun pengantin custom sesuai dengan desain dan ukuran Anda. Dibuat oleh designer berpengalaman.', harga: 2500000, stok: 0, foto: '👰', tipe_produk: 'custom', kategori: 'pakaian', rating: 5.0, terjual: 15 },
            { id: 10, nama_produk: 'Custom Leather Jacket', deskripsi: 'Jaket kulit custom dengan desain sesuai keinginan Anda. Menggunakan kulit berkualitas tinggi.', harga: 1200000, stok: 0, foto: '🧥', tipe_produk: 'custom', kategori: 'pakaian', rating: 4.9, terjual: 30 },
            { id: 11, nama_produk: 'Rok Midi Flare', deskripsi: 'Rok midi dengan model flare yang feminim dan elegan. Cocok untuk berbagai acara.', harga: 220000, stok: 25, foto: '👗', tipe_produk: 'ready', kategori: 'pakaian', rating: 4.6, terjual: 180 },
            { id: 12, nama_produk: 'Backpack Leather Premium', deskripsi: 'Backpack kulit premium dengan desain modern dan fungsional. Cocok untuk traveling dan aktivitas sehari-hari.', harga: 520000, stok: 6, foto: '🎒', tipe_produk: 'ready', kategori: 'tas', rating: 4.7, terjual: 60 }
        ];

        let cart = [];
        let currentPage = 'home';
        let filteredProducts = [...products];

        // Navigation functions
        function navigateTo(page) {
            // Hide all pages
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            
            // Show selected page
            document.getElementById(page).classList.add('active');
            currentPage = page;

            // Load page content
            if (page === 'home') {
                loadCategories();
                loadFeaturedProducts();
            } else if (page === 'products') {
                loadAllProducts();
            } else if (page === 'cart') {
                loadCartItems();
            }

            // Close mobile menu
            document.getElementById('mobile-menu').classList.add('hidden');
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }

        // Load functions
        function loadCategories() {
            const container = document.getElementById('categories-grid');
            container.innerHTML = categories.map(category => `
                <div onclick="filterByCategory('${category.nama_kategori.toLowerCase()}')" class="bg-gradient-to-br ${category.color} rounded-xl p-8 text-white text-center hover:shadow-xl transition-all transform hover:scale-105 cursor-pointer">
                    <div class="text-5xl mb-4">${category.icon}</div>
                    <h3 class="text-xl font-bold mb-3">${category.nama_kategori}</h3>
                    <p class="text-sm opacity-90">${category.deskripsi}</p>
                </div>
            `).join('');
        }

        function loadFeaturedProducts() {
            const container = document.getElementById('featured-products');
            const featured = products.filter(p => p.tipe_produk === 'ready').slice(0, 4);
            container.innerHTML = featured.map(product => createProductCard(product)).join('');
        }

        function loadAllProducts() {
            const container = document.getElementById('products-grid');
            container.innerHTML = filteredProducts.map(product => createProductCard(product)).join('');
        }

        function createProductCard(product) {
            const isCustom = product.tipe_produk === 'custom';
            const stockText = isCustom ? 'Custom Order' : `Stok: ${product.stok}`;
            const stockClass = isCustom ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800';
            
            return `
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all transform hover:scale-105">
                    <div class="relative bg-gray-100 h-48 flex items-center justify-center">
                        <span class="text-6xl">${product.foto}</span>
                        <div class="absolute top-3 right-3">
                            <span class="${stockClass} px-2 py-1 rounded-full text-xs font-bold">${isCustom ? 'Custom' : 'Ready'}</span>
                        </div>
                        ${product.stok <= 5 && !isCustom ? '<div class="absolute top-3 left-3"><span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">Stok Terbatas</span></div>' : ''}
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">${product.nama_produk}</h4>
                        <div class="flex items-center mb-3">
                            <span class="text-yellow-400 mr-1">⭐</span>
                            <span class="text-sm text-gray-600">${product.rating} (${product.terjual} terjual)</span>
                        </div>
                        <p class="text-2xl font-bold text-indigo-600 mb-4">Rp ${product.harga.toLocaleString('id-ID')}</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="${stockClass} px-3 py-1 rounded-full text-sm font-medium">${stockText}</span>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="showProductDetail(${product.id})" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                                Detail
                            </button>
                            <button onclick="addToCart(${product.id})" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                                ${isCustom ? 'Pesan' : 'Keranjang'}
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        // Filter functions
        function filterByCategory(category) {
            navigateTo('products');
            setTimeout(() => {
                document.getElementById('category-filter').value = category;
                filterProducts();
            }, 100);
        }

        function filterProducts() {
            const categoryFilter = document.getElementById('category-filter').value;
            const typeFilter = document.getElementById('type-filter').value;
            
            filteredProducts = products.filter(product => {
                const categoryMatch = categoryFilter === 'all' || product.kategori === categoryFilter;
                const typeMatch = typeFilter === 'all' || product.tipe_produk === typeFilter;
                return categoryMatch && typeMatch;
            });
            
            loadAllProducts();
        }

        // Product detail functions
        function showProductDetail(productId) {
            const product = products.find(p => p.id === productId);
            if (!product) return;

            const isCustom = product.tipe_produk === 'custom';
            const stockText = isCustom ? 'Custom Order Available' : `Stok tersedia: ${product.stok} pcs`;
            const stockClass = isCustom ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800';

            document.getElementById('modal-content').innerHTML = `
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <div class="bg-gray-100 rounded-xl h-96 flex items-center justify-center mb-4">
                            <span class="text-8xl">${product.foto}</span>
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            ${Array(4).fill().map(() => `
                                <div class="bg-gray-100 rounded-lg h-20 flex items-center justify-center cursor-pointer hover:bg-gray-200 transition-colors">
                                    <span class="text-2xl">${product.foto}</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">${product.nama_produk}</h2>
                            <div class="flex items-center mb-4">
                                <span class="text-yellow-400 mr-1">⭐</span>
                                <span class="text-gray-600 mr-4">${product.rating} (${product.terjual} terjual)</span>
                                <span class="${stockClass} px-3 py-1 rounded-full text-sm font-medium">${isCustom ? 'Custom' : 'Ready Stock'}</span>
                            </div>
                            <p class="text-3xl font-bold text-indigo-600 mb-4">Rp ${product.harga.toLocaleString('id-ID')}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
                            <p class="text-gray-600 leading-relaxed">${product.deskripsi}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-600 mb-4">${stockText}</p>
                        </div>
                        
                        ${!isCustom ? `
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Ukuran</h3>
                                <div class="flex space-x-2 mb-6">
                                    <button class="border border-gray-300 px-4 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors">S</button>
                                    <button class="border border-gray-300 px-4 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors">M</button>
                                    <button class="border border-gray-300 px-4 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors">L</button>
                                    <button class="border border-gray-300 px-4 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors">XL</button>
                                </div>
                            </div>
                        ` : ''}
                        
                        <div class="flex space-x-4">
                            <button onclick="addToCart(${product.id}); closeModal();" class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-colors">
                                ${isCustom ? 'Pesan Custom' : 'Tambah ke Keranjang'}
                            </button>
                            ${!isCustom ? `
                                <button class="flex-1 bg-yellow-400 text-gray-800 px-6 py-3 rounded-xl font-semibold hover:bg-yellow-300 transition-colors">
                                    Beli Sekarang
                                </button>
                            ` : `
                                <button onclick="navigateTo('custom'); closeModal();" class="flex-1 bg-yellow-400 text-gray-800 px-6 py-3 rounded-xl font-semibold hover:bg-yellow-300 transition-colors">
                                    Custom Request
                                </button>
                            `}
                        </div>
                    </div>
                </div>
            `;

            // Load similar products
            const similarProducts = products.filter(p => p.kategori === product.kategori && p.id !== product.id).slice(0, 4);
            if (similarProducts.length > 0) {
                document.getElementById('modal-content').innerHTML += `
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Produk Serupa</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            ${similarProducts.map(p => `
                                <div class="bg-gray-50 rounded-lg p-4 text-center hover:bg-gray-100 transition-colors cursor-pointer" onclick="showProductDetail(${p.id})">
                                    <div class="text-3xl mb-2">${p.foto}</div>
                                    <h4 class="font-semibold text-sm text-gray-800 mb-1">${p.nama_produk}</h4>
                                    <p class="text-indigo-600 font-bold text-sm">Rp ${p.harga.toLocaleString('id-ID')}</p>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
            }

            document.getElementById('product-modal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('product-modal').classList.remove('show');
        }

        // Cart functions
        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            if (!product) return;

            if (product.tipe_produk === 'custom') {
                showNotification(`${product.nama_produk} - Silakan buat custom request untuk produk ini`);
                navigateTo('custom');
                return;
            }

            const existingItem = cart.find(item => item.id === productId);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: product.id,
                    nama_produk: product.nama_produk,
                    harga: product.harga,
                    foto: product.foto,
                    quantity: 1
                });
            }
            
            updateCartCount();
            showNotification(`${product.nama_produk} berhasil ditambahkan ke keranjang!`);
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCartCount();
            loadCartItems();
            showNotification('Produk berhasil dihapus dari keranjang');
        }

        function updateQuantity(productId, change) {
            const item = cart.find(item => item.id === productId);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    removeFromCart(productId);
                } else {
                    updateCartCount();
                    loadCartItems();
                }
            }
        }

        function updateCartCount() {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cart-count').textContent = totalItems;
        }

        function loadCartItems() {
            const emptyCart = document.getElementById('cart-empty');
            const cartContent = document.getElementById('cart-content');
            const cartItems = document.getElementById('cart-items');
            const subtotalElement = document.getElementById('cart-subtotal');
            const taxElement = document.getElementById('cart-tax');
            const totalElement = document.getElementById('cart-total');

            if (cart.length === 0) {
                emptyCart.classList.remove('hidden');
                cartContent.classList.add('hidden');
                return;
            }

            emptyCart.classList.add('hidden');
            cartContent.classList.remove('hidden');

            let subtotal = 0;
            cartItems.innerHTML = cart.map(item => {
                const itemTotal = item.harga * item.quantity;
                subtotal += itemTotal;
                
                return `
                    <div class="p-6 flex items-center space-x-4">
                        <div class="bg-gray-100 rounded-lg p-3 flex-shrink-0">
                            <span class="text-3xl">${item.foto}</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-lg">${item.nama_produk}</h4>
                            <p class="text-gray-600">Rp ${item.harga.toLocaleString('id-ID')}</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button onclick="updateQuantity(${item.id}, -1)" class="bg-gray-200 hover:bg-gray-300 rounded-full w-10 h-10 flex items-center justify-center transition-colors font-bold">-</button>
                            <span class="font-semibold text-lg w-8 text-center">${item.quantity}</span>
                            <button onclick="updateQuantity(${item.id}, 1)" class="bg-gray-200 hover:bg-gray-300 rounded-full w-10 h-10 flex items-center justify-center transition-colors font-bold">+</button>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800 text-lg">Rp ${itemTotal.toLocaleString('id-ID')}</p>
                            <button onclick="removeFromCart(${item.id})" class="text-red-600 hover:text-red-800 transition-colors text-sm font-medium">Hapus</button>
                        </div>
                    </div>
                `;
            }).join('');

            const shipping = 15000;
            const tax = Math.round(subtotal * 0.1); // 10% tax
            const total = subtotal + shipping + tax;

            subtotalElement.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
            taxElement.textContent = `Rp ${tax.toLocaleString('id-ID')}`;
            totalElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        function checkout() {
            if (cart.length === 0) return;
            
            showNotification('Checkout berhasil! Terima kasih atas pesanan Anda. Tim kami akan segera memproses pesanan.');
            cart = [];
            updateCartCount();
            loadCartItems();
        }

        // Custom request functions
        function handleFileUpload(event) {
            const files = event.target.files;
            const container = document.getElementById('uploaded-files');
            
            container.innerHTML = '';
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileDiv = document.createElement('div');
                fileDiv.className = 'flex items-center justify-between bg-indigo-50 rounded-lg p-3 border border-indigo-200';
                fileDiv.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <span class="text-indigo-600">📎</span>
                        <span class="text-sm font-medium text-gray-700">${file.name}</span>
                    </div>
                    <span class="text-xs text-gray-500 font-medium">${(file.size / 1024 / 1024).toFixed(2)} MB</span>
                `;
                container.appendChild(fileDiv);
            }
        }

        function submitCustomRequest(event) {
            event.preventDefault();
            
            const form = document.getElementById('custom-form');
            const successMessage = document.getElementById('custom-success');
            
            // Simulate form submission
            setTimeout(() => {
                form.classList.add('hidden');
                successMessage.classList.remove('hidden');
                
                showNotification('Custom request berhasil dikirim! Tim kami akan menghubungi Anda segera.');
                
                // Reset form after showing success
                setTimeout(() => {
                    form.reset();
                    document.getElementById('uploaded-files').innerHTML = '';
                    form.classList.remove('hidden');
                    successMessage.classList.add('hidden');
                }, 8000);
            }, 1500);
        }

        // Utility functions
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">✅</span>
                    <span class="font-medium">${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 4000);
        }

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Scroll to top button visibility
        window.addEventListener('scroll', function() {
            const scrollButton = document.querySelector('.scroll-to-top');
            if (window.pageYOffset > 300) {
                scrollButton.classList.add('show');
            } else {
                scrollButton.classList.remove('show');
            }
        });

        // Close modal when clicking outside
        document.getElementById('product-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            loadCategories();
            loadFeaturedProducts();
            updateCartCount();
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9930afa44532051a',t:'MTc2MTIxNjc1OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
