@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran Pesanan</h1>
            <p class="text-gray-600">Selesaikan pembayaran untuk melanjutkan pesanan Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Details - Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Summary Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-primary/5 to-secondary/5 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Detail Pesanan</h2>
                        <p class="text-sm text-gray-600 mt-1">Order #{{ $order->id }}</p>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <!-- Customer Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Nama Pemesan</label>
                                <p class="mt-1 text-gray-900 font-medium">{{ $order->customer_name }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Email</label>
                                <p class="mt-1 text-gray-900">{{ $order->customer_email }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Nomor Telepon</label>
                                <p class="mt-1 text-gray-900">{{ $order->customer_phone }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Status Pesanan</label>
                                <span class="inline-flex items-center mt-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="pt-4 border-t border-gray-200">
                            <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Alamat Pengiriman</label>
                            <p class="mt-2 text-gray-900 leading-relaxed">{{ $order->alamat_pengiriman }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Instructions Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Instruksi Pembayaran</h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                <span class="text-xs font-semibold text-primary">1</span>
                            </div>
                            <p class="text-sm text-gray-600">Klik tombol "Bayar Sekarang" di bawah</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                <span class="text-xs font-semibold text-primary">2</span>
                            </div>
                            <p class="text-sm text-gray-600">Pilih metode pembayaran yang Anda inginkan</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                <span class="text-xs font-semibold text-primary">3</span>
                            </div>
                            <p class="text-sm text-gray-600">Ikuti instruksi pembayaran yang muncul</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                <span class="text-xs font-semibold text-primary">4</span>
                            </div>
                            <p class="text-sm text-gray-600">Selesaikan pembayaran sebelum batas waktu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Summary - Right Column -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 sticky top-24">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pembayaran</h3>
                        
                        <!-- Price Breakdown -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="text-gray-900 font-medium">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Biaya Admin</span>
                                <span class="text-gray-900 font-medium">Rp 0</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-base font-semibold text-gray-900">Total Pembayaran</span>
                                    <span class="text-xl font-bold text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Button -->
                        <div id="payment-form">
                            <button 
                                id="pay-button" 
                                class="w-full bg-primary text-white font-semibold py-4 px-6 rounded-xl hover:bg-primary/90 transition-colors shadow-sm flex items-center justify-center group"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                <span>Bayar Sekarang</span>
                            </button>
                        </div>

                        <!-- Security Notice -->
                        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                <p class="text-xs text-gray-600">Pembayaran Anda aman dan terenkripsi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Link -->
                <div class="mt-4 text-center">
                    <a href="{{ route('orders') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
document.getElementById('pay-button').onclick = function(){
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            console.log('success', result);
            // Mark order as paid
            fetch('{{ route("mark.paid", $order) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            }).then(() => {
                window.location.href = '{{ route("orders") }}';
            });
        },
        onPending: function(result){
            console.log('pending', result);
            window.location.href = '{{ route("orders") }}';
        },
        onError: function(result){
            console.log('error', result);
            alert('Pembayaran gagal!');
        },
        onClose: function(){
            console.log('customer closed the popup without finishing the payment');
        }
    });
};
</script>
@endsection