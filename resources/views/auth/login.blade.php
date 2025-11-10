@extends('layouts.app')

@section('title', 'Login - Butik Online')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5DC]/30 via-white to-[#F5F5DC]/50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-[#3E2723]">Masuk ke Akun Anda</h2>
            <p class="mt-2 text-sm text-[#3E2723] opacity-80">
                Atau
                <a href="/register" class="font-medium text-[#8B4513] hover:text-[#D2691E]">
                    buat akun baru
                </a>
            </p>
        </div>

        <div class="bg-white py-8 px-6 shadow-xl rounded-2xl border border-[#F5F5DC]">
            <form id="login-form" class="space-y-6" method="POST" action="/login">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-[#3E2723]">Email</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="appearance-none block w-full px-3 py-2 border border-[#D2691E]/30 rounded-lg placeholder-[#3E2723]/60 focus:outline-none focus:ring-[#8B4513] focus:border-[#8B4513] sm:text-sm transition-colors duration-200 text-[#3E2723] bg-white"
                               placeholder="Masukkan email Anda">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-[#3E2723]">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none block w-full px-3 py-2 border border-[#D2691E]/30 rounded-lg placeholder-[#3E2723]/60 focus:outline-none focus:ring-[#8B4513] focus:border-[#8B4513] sm:text-sm transition-colors duration-200 text-[#3E2723] bg-white"
                               placeholder="Masukkan password Anda">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <a href="/forgot-password" class="font-medium text-[#8B4513] hover:text-[#D2691E]">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-[#8B4513] to-[#D2691E] hover:from-[#D2691E] hover:to-[#8B4513] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8B4513] transition-all duration-200 transform hover:scale-105">
                        Masuk
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="/" class="text-sm text-[#8B4513] hover:text-[#D2691E] flex items-center justify-center">
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