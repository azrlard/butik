@extends('layouts.app')

@section('title', 'Riwayat Pesanan - Butik Online')

@section('content')
<div id="orders">
    @php
        $currentPage = 'Riwayat Pesanan';
    @endphp
    @include('shared.breadcrumb')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">Riwayat Pesanan</h1>
            <p class="text-xl text-gray-600">Pantau semua pesanan Anda di satu tempat</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Orders Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="space-y-3">
                        <a href="/profile" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl transition-colors">
                            📝 Informasi Pribadi
                        </a>
                        <a href="/orders" class="flex items-center px-4 py-3 bg-indigo-50 text-indigo-700 rounded-xl font-semibold">
                            📦 Riwayat Pesanan
                        </a>
                        <a href="/settings" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl transition-colors">
                            ⚙️ Pengaturan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Orders Content -->
            <div class="lg:col-span-2">
                <!-- Order Filters -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <label for="status-filter" class="block text-sm font-semibold text-gray-700 mb-2">Filter Status</label>
                            <select id="status-filter" onchange="filterOrders()" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent bg-white">
                                <option value="all">Semua Status</option>
                                <option value="pending">Menunggu Pembayaran</option>
                                <option value="processing">Sedang Diproses</option>
                                <option value="shipped">Dalam Pengiriman</option>
                                <option value="delivered">Selesai</option>
                                <option value="cancelled">Dibatalkan</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="date-filter" class="block text-sm font-semibold text-gray-700 mb-2">Rentang Tanggal</label>
                            <select id="date-filter" onchange="filterOrders()" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent bg-white">
                                <option value="all">Semua Waktu</option>
                                <option value="7days">7 Hari Terakhir</option>
                                <option value="30days">30 Hari Terakhir</option>
                                <option value="90days">3 Bulan Terakhir</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Orders List -->
                <div id="orders-list" class="space-y-6">
                    <!-- Sample Order 1 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-gray-900">Order #ORD-2024-001</h3>
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Menunggu Pembayaran</span>
                                    </div>
                                    <p class="text-gray-600">Dipesan pada 15 November 2024, 14:30</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-indigo-600">Rp 250.000</p>
                                    <p class="text-sm text-gray-500">2 items</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Order Items -->
                                <div class="flex-1">
                                    <div class="space-y-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <span class="text-2xl">👕</span>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-900">Kaos Polos Premium</h4>
                                                <p class="text-sm text-gray-600">Size: M, Warna: Hitam</p>
                                                <p class="text-sm text-gray-600">Qty: 1 × Rp 125.000</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <span class="text-2xl">👖</span>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-900">Celana Jeans Slim Fit</h4>
                                                <p class="text-sm text-gray-600">Size: 32, Warna: Biru</p>
                                                <p class="text-sm text-gray-600">Qty: 1 × Rp 125.000</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Actions -->
                                <div class="md:w-48 flex flex-col gap-3">
                                    <button onclick="viewOrderDetail('ORD-2024-001')" class="w-full bg-indigo-600 text-white px-4 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-colors">
                                        Lihat Detail
                                    </button>
                                    <button onclick="trackOrder('ORD-2024-001')" class="w-full bg-gray-200 text-gray-700 px-4 py-3 rounded-xl font-semibold hover:bg-gray-300 transition-colors">
                                        Lacak Pesanan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sample Order 2 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-gray-900">Order #ORD-2024-002</h3>
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Selesai</span>
                                    </div>
                                    <p class="text-gray-600">Dipesan pada 10 November 2024, 09:15</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-indigo-600">Rp 180.000</p>
                                    <p class="text-sm text-gray-500">1 item</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Order Items -->
                                <div class="flex-1">
                                    <div class="space-y-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <span class="text-2xl">🧥</span>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-900">Jaket Bomber Premium</h4>
                                                <p class="text-sm text-gray-600">Size: L, Warna: Navy</p>
                                                <p class="text-sm text-gray-600">Qty: 1 × Rp 180.000</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Actions -->
                                <div class="md:w-48 flex flex-col gap-3">
                                    <button onclick="viewOrderDetail('ORD-2024-002')" class="w-full bg-indigo-600 text-white px-4 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-colors">
                                        Lihat Detail
                                    </button>
                                    <button onclick="writeReview('ORD-2024-002')" class="w-full bg-green-600 text-white px-4 py-3 rounded-xl font-semibold hover:bg-green-700 transition-colors">
                                        Tulis Ulasan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="empty-orders" class="hidden text-center py-20">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada pesanan</h3>
                    <p class="text-gray-600 mb-6">Mulai berbelanja dan buat pesanan pertama Anda</p>
                    <a href="/products" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition-colors">
                        Mulai Belanja
                    </a>
                </div>
    </div>
</div>

<script>
function filterOrders() {
    const statusFilter = document.getElementById('status-filter').value;
    const dateFilter = document.getElementById('date-filter').value;

    // Implement filtering logic here
    console.log('Filtering orders:', { status: statusFilter, date: dateFilter });
}

function viewOrderDetail(orderId) {
    // Navigate to order detail page
    window.location.href = `/orders/${orderId}`;
}

function trackOrder(orderId) {
    // Show tracking modal or navigate to tracking page
    showNotification(`Melacak pesanan ${orderId}`);
}

function writeReview(orderId) {
    // Navigate to review page or show review modal
    showNotification(`Menulis ulasan untuk pesanan ${orderId}`);
}
</script>
@endsection