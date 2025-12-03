@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('orders') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Riwayat Pesanan
            </a>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan</h1>
                    <p class="text-gray-600 mt-1">Order #{{ $order->id }}</p>
                </div>
                <div class="mt-4 md:mt-0">
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'success' => 'bg-green-100 text-green-800',
                            'processing' => 'bg-blue-100 text-blue-800',
                            'shipped' => 'bg-indigo-100 text-indigo-800',
                            'delivered' => 'bg-green-100 text-green-800',
                            'failed' => 'bg-red-100 text-red-800',
                            'expired' => 'bg-gray-100 text-gray-800',
                            'cancelled' => 'bg-red-100 text-red-800',
                        ];
                        $statusLabels = [
                            'pending' => 'Menunggu Pembayaran',
                            'success' => 'Pembayaran Berhasil',
                            'processing' => 'Sedang Diproses',
                            'shipped' => 'Dalam Pengiriman',
                            'delivered' => 'Selesai',
                            'failed' => 'Pembayaran Gagal',
                            'expired' => 'Kadaluarsa',
                            'cancelled' => 'Dibatalkan',
                        ];
                    @endphp
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ $statusLabels[$order->status] ?? 'Status Tidak Dikenal' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Items -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Item Pesanan</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                            <div class="flex gap-4 pb-4 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                                <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    @if($item->product && $item->product->foto)
                                        <img src="/storage/{{ $item->product->foto }}" alt="{{ $item->product->nama_produk }}" class="w-full h-full object-cover rounded-lg">
                                    @elseif($item->customRequest && $item->customRequest->foto_referensi)
                                        <img src="/{{ $item->customRequest->foto_referensi }}" alt="Custom Request" class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">
                                        {{ $item->product ? $item->product->nama_produk : ($item->customRequest ? 'Custom Request' : 'Produk tidak tersedia') }}
                                    </h3>
                                    @if($item->variant_id)
                                        <p class="text-sm text-gray-600 mt-1">Ukuran: {{ $item->variant ? $item->variant->size : 'N/A' }}</p>
                                    @endif
                                    @if($item->customRequest)
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->customRequest->keterangan, 100) }}</p>
                                    @endif
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-sm text-gray-600">Qty: {{ $item->jumlah }}</span>
                                        <span class="font-semibold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Pengiriman</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Nama Penerima</label>
                                <p class="mt-1 text-gray-900 font-medium">{{ $order->customer_name }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Nomor Telepon</label>
                                <p class="mt-1 text-gray-900">{{ $order->customer_phone }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Email</label>
                                <p class="mt-1 text-gray-900">{{ $order->customer_email }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Alamat Pengiriman</label>
                                <p class="mt-1 text-gray-900 leading-relaxed">{{ $order->alamat_pengiriman }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 sticky top-24">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>
                        
                        <!-- Order Info -->
                        <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Pesanan</span>
                                <span class="text-gray-900 font-medium">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Waktu</span>
                                <span class="text-gray-900 font-medium">{{ $order->created_at->format('H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Metode Pembayaran</span>
                                <span class="text-gray-900 font-medium">{{ ucfirst($order->metode_pembayaran) }}</span>
                            </div>
                        </div>

                        <!-- Price Summary -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal ({{ $order->orderItems->count() }} item)</span>
                                <span class="text-gray-900 font-medium">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Biaya Pengiriman</span>
                                <span class="text-gray-900 font-medium">Rp 0</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-base font-semibold text-gray-900">Total</span>
                                    <span class="text-xl font-bold text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="space-y-3">
                            @if($order->status === 'pending')
                                <a href="{{ route('payment', $order) }}" class="block w-full bg-primary text-white text-center font-semibold py-3 px-4 rounded-lg hover:bg-primary/90 transition-colors">
                                    Bayar Sekarang
                                </a>
                            @endif
                            
                            @if(in_array($order->status, ['success', 'processing', 'shipped']))
                                <a href="{{ route('orders.track', $order) }}" class="block w-full bg-white text-gray-700 text-center font-semibold py-3 px-4 rounded-lg border-2 border-gray-200 hover:border-primary hover:text-primary transition-all">
                                    Lacak Pesanan
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
