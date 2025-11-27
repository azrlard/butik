@extends('layouts.app')

@section('title', 'Custom Request - Butik Online')

@section('content')
@php
    $currentPage = 'Custom Request';
@endphp
@include('shared.breadcrumb')

<!-- Hero Section -->
<section class="relative py-16 overflow-hidden">
    <!-- Background Image & Overlay -->
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full bg-cover bg-center bg-no-repeat" style="background-image: url('/images/carosel 1.jpg');"></div>
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <h1 class="text-5xl md:text-6xl font-black text-white mb-6 leading-tight">
            Custom Request
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed">
            Wujudkan desain impian Anda bersama tim ahli kami. Dari konsep hingga produk jadi, semua dalam satu tempat.
        </p>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12 max-w-2xl mx-auto">
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-white/20">
                <div class="text-2xl font-bold text-primary mb-1">50+</div>
                <div class="text-sm text-white/90">Designer Ahli</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-white/20">
                <div class="text-2xl font-bold text-secondary mb-1">24h</div>
                <div class="text-sm text-white/90">Response Time</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-white/20">
                <div class="text-2xl font-bold text-accent mb-1">100%</div>
                <div class="text-sm text-white/90">Kepuasan</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-white/20">
                <div class="text-2xl font-bold text-primary mb-1">7d</div>
                <div class="text-sm text-white/90">Production</div>
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