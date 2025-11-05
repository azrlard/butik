@extends('layouts.app')

@section('title', 'Pengaturan - Butik Online')

@section('content')
<div id="settings">
    @php
        $currentPage = 'Pengaturan';
    @endphp
    @include('shared.breadcrumb')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">Pengaturan Akun</h1>
            <p class="text-xl text-gray-600">Kelola preferensi dan keamanan akun Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Settings Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="space-y-3">
                        <a href="/profile" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl transition-colors">
                            📝 Informasi Pribadi
                        </a>
                        <a href="/orders" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl transition-colors">
                            📦 Riwayat Pesanan
                        </a>
                        <a href="/settings" class="flex items-center px-4 py-3 bg-indigo-50 text-indigo-700 rounded-xl font-semibold">
                            ⚙️ Pengaturan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="lg:col-span-2">
                <!-- Password Settings -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Keamanan Akun</h2>
                        <p class="text-gray-600">Kelola kata sandi dan keamanan akun Anda</p>
                    </div>

                    <form id="password-form" onsubmit="updatePassword(event)" class="space-y-6">
                        <div>
                            <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi Saat Ini</label>
                            <input type="password" id="current_password" name="current_password" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi Baru</label>
                                <input type="password" id="password" name="password" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-all duration-300">
                                Ubah Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function updatePassword(event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    try {
        const response = await fetch('/api/settings/password', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        });

        if (response.ok) {
            alert('Kata sandi berhasil diperbarui!');
            event.target.reset();
        } else {
            alert('Terjadi kesalahan saat memperbarui kata sandi');
        }
    } catch (error) {
        alert('Terjadi kesalahan saat memperbarui kata sandi');
    }
}
</script>
@endsection