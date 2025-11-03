@extends('layouts.app')

@section('title', 'Custom Request - Butik Online')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-purple-50 via-indigo-50 to-pink-50 py-16 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-purple-200/30 to-indigo-200/30 rounded-full blur-3xl -translate-x-32 -translate-y-32"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-gradient-to-tl from-pink-200/30 to-purple-200/30 rounded-full blur-3xl translate-x-32 translate-y-32"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-black text-gray-900 mb-6 leading-tight">
            Custom Request
        </h1>
        <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Wujudkan desain impian Anda bersama tim ahli kami. Dari konsep hingga produk jadi, semua dalam satu tempat.
        </p>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12 max-w-2xl mx-auto">
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-white/50">
                <div class="text-2xl font-bold text-purple-600 mb-1">50+</div>
                <div class="text-sm text-gray-600">Designer Ahli</div>
            </div>
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-white/50">
                <div class="text-2xl font-bold text-indigo-600 mb-1">24h</div>
                <div class="text-sm text-gray-600">Response Time</div>
            </div>
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-white/50">
                <div class="text-2xl font-bold text-pink-600 mb-1">100%</div>
                <div class="text-sm text-gray-600">Kepuasan</div>
            </div>
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-white/50">
                <div class="text-2xl font-bold text-purple-600 mb-1">7d</div>
                <div class="text-sm text-gray-600">Production</div>
            </div>
        </div>
    </div>
</section>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @include('custom.components.process-steps')

    @include('custom.components.custom-form')

    @include('custom.components.success-message')
</div>
@endsection