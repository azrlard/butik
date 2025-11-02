@extends('layouts.app')

@section('title', 'Butik Online - Temukan Gaya Unikmu')

@section('content')
<!-- Page: Home -->
<div id="home">
    @include('home.components.hero')
    @include('home.components.categories')
    @include('home.components.featured-products')
    @include('home.components.custom-cta')
</div>


<!-- Product Detail Modal for Home Page -->
<div id="product-modal" class="hidden fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50 p-4" style="display: none;">
    <div class="bg-white rounded-3xl max-w-5xl w-full max-h-screen overflow-hidden shadow-2xl border border-white border-opacity-20">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-6 flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-bold">Detail Produk</h3>
                <p class="text-indigo-100 mt-1">Informasi lengkap produk pilihan Anda</p>
            </div>
            <button onclick="console.log('Close button clicked'); closeModal()" class="text-white text-opacity-80 hover:text-white hover:bg-white hover:bg-opacity-20 rounded-full p-2 transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div id="modal-content" class="p-8 overflow-y-auto max-h-screen bg-gray-50">
            <!-- Modal content will be loaded here -->
        </div>
    </div>
</div>
@endsection