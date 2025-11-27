@extends('layouts.app')

@section('title', 'Register - Butik Online')

@section('content')
<div class="min-h-screen bg-gray-50 flex">
    <!-- Left Side - Image/Illustration -->
    <div class="hidden lg:flex lg:flex-1 bg-gradient-to-br from-secondary/10 to-primary/10 items-center justify-center p-12">
        <div class="max-w-lg text-center">
            <div class="w-24 h-24 bg-white rounded-2xl shadow-lg flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Bergabung dengan Kami</h2>
            <p class="text-lg text-gray-600 leading-relaxed">
                Dapatkan akses ke koleksi fashion terlengkap dan layanan custom order yang profesional.
            </p>
        </div>
    </div>

    <!-- Right Side - Form -->
    <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-md w-full">
            <!-- Logo/Brand -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h1>
                <p class="text-gray-600">Daftar untuk mulai berbelanja</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                <form id="register-form" class="space-y-5" method="POST" action="/register">
                    @csrf
                    
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap
                        </label>
                        <input 
                            id="name" 
                            name="name" 
                            type="text" 
                            autocomplete="name" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-gray-900 placeholder-gray-400"
                            placeholder="Nama lengkap Anda"
                        >
                        @error('name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-gray-900 placeholder-gray-400"
                            placeholder="nama@email.com"
                        >
                        @error('email')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="new-password" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-gray-900 placeholder-gray-400"
                            placeholder="Minimal 8 karakter"
                        >
                        @error('password')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            autocomplete="new-password" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-gray-900 placeholder-gray-400"
                            placeholder="Ulangi password"
                        >
                        @error('password_confirmation')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-primary text-white font-semibold py-3 px-4 rounded-lg hover:bg-primary/90 transition-colors shadow-sm mt-6"
                    >
                        Daftar
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-6 mb-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">Sudah punya akun?</span>
                        </div>
                    </div>
                </div>

                <!-- Login Link -->
                <a 
                    href="/login" 
                    class="block w-full text-center bg-white text-gray-700 font-semibold py-3 px-4 rounded-lg border-2 border-gray-200 hover:border-primary hover:text-primary transition-all"
                >
                    Masuk
                </a>
            </div>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="/" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection