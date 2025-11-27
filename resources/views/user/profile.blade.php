@extends('layouts.app')

@section('title', 'Informasi Akun - Butik Online')

@section('content')
<div id="profile">
    @php
        $currentPage = 'Informasi Akun';
    @endphp
    @include('shared.breadcrumb')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-black text-text mb-4">Informasi Akun</h1>
            <p class="text-xl text-text">Kelola informasi pribadi Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-background rounded-2xl shadow-lg border border-secondary p-6">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl text-background font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-text">{{ auth()->user()->name }}</h3>
                        <p class="text-text">{{ auth()->user()->email }}</p>
                    </div>

                    <div class="space-y-3">
                        <a href="/profile" class="flex items-center px-4 py-3 bg-secondary text-background rounded-xl font-semibold">
                            📝 Informasi Pribadi
                        </a>
                        <a href="/orders" class="flex items-center px-4 py-3 text-text hover:bg-accent rounded-xl transition-colors">
                            📦 Riwayat Pesanan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="lg:col-span-2">
                <div class="bg-background rounded-2xl shadow-lg border border-secondary p-8">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-text mb-2">Informasi Pribadi</h2>
                        <p class="text-text">Perbarui informasi akun Anda</p>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-text mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                                       class="w-full px-4 py-3 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-text mb-2">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                       class="w-full px-4 py-3 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background">
                            </div>

                            <div>
                                <label for="no_hp" class="block text-sm font-semibold text-text mb-2">Nomor Telepon</label>
                                <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp) }}"
                                       class="w-full px-4 py-3 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background">
                            </div>

                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-semibold text-text mb-2">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="4" class="w-full px-4 py-3 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 resize-none bg-accent focus:bg-background">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-primary text-background px-8 py-3 rounded-xl font-semibold hover:bg-secondary transition-all duration-300">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection