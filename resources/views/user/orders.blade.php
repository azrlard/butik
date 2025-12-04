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
            <h1 class="text-4xl md:text-5xl font-black text-text mb-4">Riwayat Pesanan</h1>
            <p class="text-xl text-text">Pantau semua pesanan Anda di satu tempat</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Orders Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-background rounded-2xl shadow-lg border border-secondary p-6">
                    <div class="space-y-3">
                        <a href="/profile" class="flex items-center px-4 py-3 text-text hover:bg-accent rounded-xl transition-colors">
                            📝 Informasi Pribadi
                        </a>
                        <a href="/orders" class="flex items-center px-4 py-3 bg-secondary text-background rounded-xl font-semibold">
                            📦 Riwayat Pesanan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Orders Content -->
            <div class="lg:col-span-2">
                <!-- Order Filters -->
                <div class="bg-background rounded-2xl shadow-lg border border-secondary p-6 mb-8">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <label for="status-filter" class="block text-sm font-semibold text-text mb-2">Filter Status</label>
                            <select id="status-filter" onchange="filterOrders()" class="w-full px-4 py-3 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent bg-background">
                                <option value="all">Semua Status</option>
                                <option value="pending">Menunggu Pembayaran</option>
                                <option value="success">Pembayaran Berhasil</option>
                                <option value="processing">Sedang Diproses</option>
                                <option value="shipped">Dalam Pengiriman</option>
                                <option value="delivered">Selesai</option>
                                <option value="failed">Pembayaran Gagal</option>
                                <option value="expired">Kadaluarsa</option>
                                <option value="cancelled">Dibatalkan</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="date-filter" class="block text-sm font-semibold text-text mb-2">Rentang Tanggal</label>
                            <select id="date-filter" onchange="filterOrders()" class="w-full px-4 py-3 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent bg-background">
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
                    @php
                        $orders = auth()->user()->orders()->with(['orderItems.product', 'orderItems.variant', 'orderItems.customRequest'])->latest()->get();
                    @endphp
                    @forelse($orders as $order)
                    <div class="bg-background rounded-2xl shadow-lg border border-secondary overflow-hidden">
                        <div class="p-6 border-b border-secondary">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-text">Order #{{ $order->id }}</h3>
                                        <span class="px-3 py-1 {{ $order->status === 'pending' ? 'bg-accent text-text' : ($order->status === 'success' ? 'bg-green-100 text-green-800' : ($order->status === 'processing' ? 'bg-yellow-100 text-yellow-800' : ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : ($order->status === 'completed' || $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')))) }} rounded-full text-sm font-semibold">
                                            @switch($order->status)
                                                @case('pending')
                                                    Menunggu Pembayaran
                                                    @break
                                                @case('success')
                                                    Pembayaran Berhasil
                                                    @break
                                                @case('processing')
                                                    Sedang Diproses
                                                    @break
                                                @case('shipped')
                                                    Dalam Pengiriman
                                                    @break
                                                @case('completed')
                                                @case('delivered')
                                                    Selesai
                                                    @break
                                                @case('failed')
                                                    Pembayaran Gagal
                                                    @break
                                                @case('expired')
                                                    Kadaluarsa
                                                    @break
                                                @case('cancelled')
                                                    Dibatalkan
                                                    @break
                                                @default
                                                    Status Tidak Dikenal
                                            @endswitch
                                        </span>
                                    </div>
                                    <p class="text-text">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                    <p class="text-sm text-text">{{ $order->orderItems->count() }} item{{ $order->orderItems->count() > 1 ? 's' : '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Order Items -->
                                <div class="flex-1">
                                    <div class="space-y-4">
                                        @foreach($order->orderItems as $item)
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 bg-accent rounded-lg flex items-center justify-center">
                                                @if($item->product && $item->product->foto)
                                                    <img src="/storage/{{ $item->product->foto }}" alt="{{ $item->product->nama_produk }}" class="w-full h-full object-cover rounded-lg">
                                                @elseif($item->customRequest && $item->customRequest->foto_referensi)
                                                    <img src="/{{ $item->customRequest->foto_referensi }}" alt="Custom Request" class="w-full h-full object-cover rounded-lg">
                                                @else
                                                    <span class="text-2xl">👕</span>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-text">{{ $item->product ? $item->product->nama_produk : ($item->customRequest ? 'Custom Request' : 'Produk tidak tersedia') }}</h4>
                                                @if($item->variant_id)
                                                    <p class="text-sm text-text">Size: {{ $item->variant ? $item->variant->size : 'N/A' }}</p>
                                                @endif
                                                <p class="text-sm text-text">Qty: {{ $item->jumlah }} × Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Order Actions -->
                                <div class="md:w-48 flex flex-col gap-3">
                                    <button onclick="viewOrderDetail('{{ $order->id }}')" class="w-full bg-primary text-background px-4 py-3 rounded-xl font-semibold hover:bg-secondary transition-colors">
                                        Lihat Detail
                                    </button>
                                    @if($order->status === 'completed' || $order->status === 'delivered')
                                    <button onclick="writeReview('{{ $order->id }}')" class="w-full bg-secondary text-background px-4 py-3 rounded-xl font-semibold hover:bg-primary transition-colors">
                                        Tulis Ulasan
                                    </button>
                                    @else
                                    <button onclick="trackOrder('{{ $order->id }}')" class="w-full bg-accent text-text px-4 py-3 rounded-xl font-semibold hover:bg-secondary hover:text-background transition-colors">
                                        Lacak Pesanan
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div id="empty-orders" class="text-center py-20">
                        <div class="w-24 h-24 bg-accent rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-text mb-2">Belum ada pesanan</h3>
                        <p class="text-text mb-6">Mulai berbelanja dan buat pesanan pertama Anda</p>
                        <a href="/products" class="inline-flex items-center px-6 py-3 bg-primary text-background font-semibold rounded-xl hover:bg-secondary transition-colors">
                            Mulai Belanja
                        </a>
                    </div>
                    @endforelse
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
    // Navigate to tracking page
    window.location.href = `/orders/${orderId}/track`;
}

function writeReview(orderId) {
    // Navigate to review page or show review modal
    showNotification(`Menulis ulasan untuk pesanan ${orderId}`);
}
</script>
@endsection