@extends('layouts.app')

@section('title', 'Custom Request - Butik Online')

@section('content')
@php
    $currentPage = 'Custom Request';
@endphp
@include('shared.breadcrumb')

<!-- Hero Section -->
<section class="bg-accent py-16 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-secondary/20 rounded-full blur-3xl -translate-x-32 -translate-y-32"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-primary/20 rounded-full blur-3xl translate-x-32 translate-y-32"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-black text-text mb-6 leading-tight">
            Custom Request
        </h1>
        <p class="text-xl md:text-2xl text-text max-w-3xl mx-auto leading-relaxed">
            Wujudkan desain impian Anda bersama tim ahli kami. Dari konsep hingga produk jadi, semua dalam satu tempat.
        </p>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12 max-w-2xl mx-auto">
            <div class="bg-background/60 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-background/50">
                <div class="text-2xl font-bold text-primary mb-1">50+</div>
                <div class="text-sm text-text">Designer Ahli</div>
            </div>
            <div class="bg-background/60 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-background/50">
                <div class="text-2xl font-bold text-secondary mb-1">24h</div>
                <div class="text-sm text-text">Response Time</div>
            </div>
            <div class="bg-background/60 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-background/50">
                <div class="text-2xl font-bold text-accent mb-1">100%</div>
                <div class="text-sm text-text">Kepuasan</div>
            </div>
            <div class="bg-background/60 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-background/50">
                <div class="text-2xl font-bold text-primary mb-1">7d</div>
                <div class="text-sm text-text">Production</div>
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