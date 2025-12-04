@extends('layouts.app')

@section('title', 'Lacak Pesanan #' . $order->id)

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('orders') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Riwayat Pesanan
            </a>
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Lacak Pesanan</h1>
                <p class="text-gray-600">Order #{{ $order->id }}</p>
            </div>
        </div>

        <!-- Order Status Timeline -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-8">Status Pengiriman</h2>
            
            @php
                $statuses = [
                    ['key' => 'pending', 'label' => 'Menunggu Pembayaran', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['key' => 'success', 'label' => 'Pembayaran Berhasil', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['key' => 'processing', 'label' => 'Sedang Diproses', 'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'],
                    ['key' => 'shipped', 'label' => 'Dalam Pengiriman', 'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
                    ['key' => 'completed', 'label' => 'Selesai', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];

                $currentStatusIndex = array_search($order->status, array_column($statuses, 'key'));
                if ($currentStatusIndex === false) {
                    $currentStatusIndex = 0;
                }
                
                // If payment is successful, automatically mark processing as completed
                if ($order->status === 'success' && $currentStatusIndex < 2) {
                    $currentStatusIndex = 2; // Mark up to 'processing' as completed
                }
            @endphp

            <div class="relative">
                @foreach($statuses as $index => $status)
                    @php
                        $isCompleted = $index <= $currentStatusIndex;
                        $isCurrent = $index === $currentStatusIndex;
                    @endphp
                    
                    <div class="relative flex items-start mb-8 {{ $loop->last ? 'mb-0' : '' }}">
                        <!-- Timeline Line -->
                        @if(!$loop->last)
                            <div class="absolute left-6 top-12 w-0.5 h-full {{ $isCompleted ? 'bg-primary' : 'bg-gray-200' }}"></div>
                        @endif
                        
                        <!-- Icon Circle -->
                        <div class="relative flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center {{ $isCompleted ? 'bg-primary' : 'bg-gray-200' }} transition-colors">
                            <svg class="w-6 h-6 {{ $isCompleted ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $status['icon'] }}"></path>
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="ml-6 flex-1">
                            <h3 class="text-base font-semibold {{ $isCompleted ? 'text-gray-900' : 'text-gray-400' }}">
                                {{ $status['label'] }}
                            </h3>
                            @if($isCurrent)
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $order->updated_at->format('d M Y, H:i') }}
                                </p>
                                @if($order->status === 'shipped' && $order->pengiriman)
                                    <div class="mt-3 p-3 bg-blue-50 rounded-lg">
                                        <p class="text-sm text-blue-900 font-medium">
                                            Nomor Resi: <span class="font-mono">{{ $order->pengiriman->no_resi ?? 'Belum tersedia' }}</span>
                                        </p>
                                        <p class="text-xs text-blue-700 mt-1">
                                            Kurir: {{ $order->pengiriman->kurir ?? '-' }}
                                        </p>
                                        @if($order->pengiriman->tanggal_kirim)
                                            <p class="text-xs text-blue-700 mt-1">
                                                Tanggal Kirim: {{ \Carbon\Carbon::parse($order->pengiriman->tanggal_kirim)->format('d M Y') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif

                            @elseif($isCompleted)
                                <p class="text-sm text-gray-500 mt-1">Selesai</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Order Summary Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>
            
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                <div class="flex gap-4">
                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        @if($item->product && $item->product->foto)
                            <img src="/storage/{{ $item->product->foto }}" alt="{{ $item->product->nama_produk }}" class="w-full h-full object-cover rounded-lg">
                        @elseif($item->customRequest && $item->customRequest->foto_referensi)
                            <img src="/{{ $item->customRequest->foto_referensi }}" alt="Custom Request" class="w-full h-full object-cover rounded-lg">
                        @else
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900">
                            {{ $item->product ? $item->product->nama_produk : ($item->customRequest ? 'Custom Request' : 'Produk tidak tersedia') }}
                        </h4>
                        <p class="text-sm text-gray-600">Qty: {{ $item->jumlah }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach

                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="flex justify-between">
                        <span class="text-base font-semibold text-gray-900">Total Pembayaran</span>
                        <span class="text-xl font-bold text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex gap-3">
                <a href="{{ route('orders.show', $order) }}" class="flex-1 bg-white text-gray-700 text-center font-semibold py-3 px-4 rounded-lg border-2 border-gray-200 hover:border-primary hover:text-primary transition-all">
                    Lihat Detail
                </a>
                @if($order->status === 'completed')
                <button class="flex-1 bg-primary text-white text-center font-semibold py-3 px-4 rounded-lg hover:bg-primary/90 transition-colors">
                    Tulis Ulasan
                </button>
                @endif
            </div>
        </div>

        <!-- Help Section -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Butuh bantuan? <a href="#" class="text-primary hover:text-primary/80 font-medium">Hubungi Customer Service</a>
            </p>
        </div>
    </div>
</div>
@endsection
