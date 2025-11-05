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
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">Informasi Akun</h1>
            <p class="text-xl text-gray-600">Kelola informasi pribadi dan preferensi akun Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl text-white font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-600">{{ auth()->user()->email }}</p>
                    </div>

                    <div class="space-y-3">
                        <a href="/profile" class="flex items-center px-4 py-3 bg-indigo-50 text-indigo-700 rounded-xl font-semibold">
                            📝 Informasi Pribadi
                        </a>
                        <a href="/orders" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl transition-colors">
                            📦 Riwayat Pesanan
                        </a>
                        <a href="/settings" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl transition-colors">
                            ⚙️ Pengaturan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Informasi Pribadi</h2>
                        <p class="text-gray-600">Perbarui informasi akun Anda</p>
                    </div>

                    <form id="profile-form" onsubmit="updateProfile(event)" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone ?? '' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200">
                            </div>

                            <div>
                                <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" id="birth_date" name="birth_date" value="{{ auth()->user()->birth_date ?? '' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200">
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                            <textarea id="address" name="address" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 resize-none">{{ auth()->user()->address ?? '' }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-all duration-300">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function updateProfile(event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    try {
        const response = await fetch('/api/profile/update', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        });

        if (response.ok) {
            alert('Profil berhasil diperbarui!');
        } else {
            alert('Terjadi kesalahan saat memperbarui profil');
        }
    } catch (error) {
        alert('Terjadi kesalahan saat memperbarui profil');
    }
}
</script>
@endsection