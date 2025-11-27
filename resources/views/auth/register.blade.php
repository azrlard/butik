@extends('layouts.app')

@section('title', 'Register - Butik Online')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-accent/30 via-background to-accent/50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-text">Buat Akun Baru</h2>
            <p class="mt-2 text-sm text-textSecondary opacity-80">
                Atau
                <a href="/login" class="font-medium text-primary hover:text-secondary">
                    masuk ke akun Anda
                </a>
            </p>
        </div>

        <div class="bg-background py-8 px-6 shadow-xl rounded-2xl border border-accent">
            <form id="register-form" class="space-y-6" method="POST" action="/register">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-text">Nama Lengkap</label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" autocomplete="name" required
                               class="appearance-none block w-full px-3 py-2 border border-border rounded-lg placeholder-textSecondary/60 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm transition-colors duration-200 text-text bg-background"
                               placeholder="Masukkan nama lengkap Anda">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-text">Email</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="appearance-none block w-full px-3 py-2 border border-border rounded-lg placeholder-textSecondary/60 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm transition-colors duration-200 text-text bg-background"
                               placeholder="Masukkan email Anda">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-text">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="appearance-none block w-full px-3 py-2 border border-border rounded-lg placeholder-textSecondary/60 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm transition-colors duration-200 text-text bg-background"
                               placeholder="Masukkan password Anda">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-text">Konfirmasi Password</label>
                    <div class="mt-1">
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                               class="appearance-none block w-full px-3 py-2 border border-border rounded-lg placeholder-textSecondary/60 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm transition-colors duration-200 text-text bg-background"
                               placeholder="Konfirmasi password Anda">
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-accent bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 transform hover:scale-105">
                        Daftar
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="/" class="text-sm text-primary hover:text-secondary flex items-center justify-center">
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