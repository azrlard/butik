@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Pembayaran Pesanan</h1>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Detail Pesanan #{{ $order->id }}</h2>
            <div class="space-y-2">
                <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p><strong>Telepon:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Alamat Pengiriman:</strong> {{ $order->alamat_pengiriman }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Pembayaran</h2>
            <div id="payment-form">
                <button id="pay-button" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Bayar Sekarang
                </button>
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
            window.location.href = '{{ route("orders") }}';
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