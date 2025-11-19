<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($this->getStats() as $stat)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">{{ $stat->getDescription() }}</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stat->getValue() }}</p>
                        </div>
                        <div class="text-{{ $stat->getColor() }}-500">
                            <x-heroicon-o-{{ $stat->getDescriptionIcon() }} class="w-8 h-8" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Charts and Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Products -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Produk Terlaris Bulan Ini</h3>
                <div class="space-y-3">
                    @forelse($this->getTopProducts() as $product)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">{{ $product->nama_produk }}</p>
                                <p class="text-sm text-gray-600">{{ $product->total_sold }} terjual</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada data penjualan bulan ini</p>
                    @endforelse
                </div>
            </div>

            <!-- Sales by Status -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Pesanan Bulan Ini</h3>
                <div class="space-y-3">
                    @forelse($this->getSalesByStatus() as $status)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 capitalize">{{ $status->status }}</p>
                                <p class="text-sm text-gray-600">{{ $status->count }} pesanan</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">Rp {{ number_format($status->total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada data pesanan bulan ini</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Monthly Sales Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Grafik Penjualan Harian Bulan Ini</h3>
            <div class="h-64 flex items-center justify-center text-gray-500">
                <div class="text-center">
                    <x-heroicon-o-chart-bar class="w-12 h-12 mx-auto mb-2" />
                    <p>Grafik penjualan harian akan ditampilkan di sini</p>
                    <p class="text-sm">Data bulan ini: {{ $this->getMonthlySales()->count() }} hari</p>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Ringkasan Bulan Ini</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-600">Total Pendapatan</p>
                    <p class="text-xl font-bold text-blue-600">
                        Rp {{ number_format($this->getMonthlySales()->sum('total'), 0, ',', '.') }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-600">Total Pesanan</p>
                    <p class="text-xl font-bold text-green-600">
                        {{ $this->getMonthlySales()->sum('orders_count') }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-600">Rata-rata per Hari</p>
                    <p class="text-xl font-bold text-purple-600">
                        Rp {{ number_format($this->getMonthlySales()->avg('total') ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>