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
            <div class="h-64">
                <canvas id="monthlySalesChart" width="400" height="200"></canvas>
            </div>
            @if($this->getMonthlySales()->isEmpty())
                <div class="flex items-center justify-center h-64 text-gray-500">
                    <div class="text-center">
                        <x-heroicon-o-chart-bar class="w-12 h-12 mx-auto mb-2 text-gray-300" />
                        <p>Belum ada data penjualan bulan ini</p>
                    </div>
                </div>
            @endif
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('monthlySalesChart');
                if (ctx) {
                    const monthlySalesData = @json($this->getMonthlySales());

                    if (monthlySalesData && monthlySalesData.length > 0) {
                        const labels = monthlySalesData.map(item => {
                            const date = new Date(item.date);
                            return date.getDate().toString();
                        });

                        const salesData = monthlySalesData.map(item => parseFloat(item.total));
                        const ordersData = monthlySalesData.map(item => parseInt(item.orders_count));

                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Penjualan (Rp)',
                                    data: salesData,
                                    borderColor: 'rgb(59, 130, 246)',
                                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                    yAxisID: 'y',
                                    tension: 0.4,
                                    fill: true,
                                    pointBackgroundColor: 'rgb(59, 130, 246)',
                                    pointBorderColor: '#fff',
                                    pointBorderWidth: 2,
                                    pointRadius: 4,
                                    pointHoverRadius: 6
                                }, {
                                    label: 'Jumlah Pesanan',
                                    data: ordersData,
                                    borderColor: 'rgb(16, 185, 129)',
                                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                    yAxisID: 'y1',
                                    tension: 0.4,
                                    fill: true,
                                    pointBackgroundColor: 'rgb(16, 185, 129)',
                                    pointBorderColor: '#fff',
                                    pointBorderWidth: 2,
                                    pointRadius: 4,
                                    pointHoverRadius: 6
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                interaction: {
                                    mode: 'index',
                                    intersect: false,
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    },
                                    tooltip: {
                                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                        titleColor: '#fff',
                                        bodyColor: '#fff',
                                        callbacks: {
                                            title: function(context) {
                                                return 'Tanggal ' + context[0].label;
                                            },
                                            label: function(context) {
                                                let label = context.dataset.label || '';
                                                if (label) {
                                                    label += ': ';
                                                }
                                                if (context.datasetIndex === 0) {
                                                    label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                                } else {
                                                    label += context.parsed.y + ' pesanan';
                                                }
                                                return label;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        display: true,
                                        title: {
                                            display: true,
                                            text: 'Tanggal',
                                            color: '#6b7280'
                                        },
                                        grid: {
                                            display: false
                                        }
                                    },
                                    y: {
                                        type: 'linear',
                                        display: true,
                                        position: 'left',
                                        title: {
                                            display: true,
                                            text: 'Penjualan (Rp)',
                                            color: '#6b7280'
                                        },
                                        ticks: {
                                            callback: function(value) {
                                                return 'Rp ' + value.toLocaleString('id-ID');
                                            },
                                            color: '#6b7280'
                                        },
                                        grid: {
                                            color: 'rgba(0, 0, 0, 0.1)'
                                        }
                                    },
                                    y1: {
                                        type: 'linear',
                                        display: true,
                                        position: 'right',
                                        title: {
                                            display: true,
                                            text: 'Jumlah Pesanan',
                                            color: '#6b7280'
                                        },
                                        ticks: {
                                            color: '#6b7280',
                                            precision: 0
                                        },
                                        grid: {
                                            drawOnChartArea: false,
                                        },
                                    }
                                },
                                elements: {
                                    point: {
                                        hoverBorderWidth: 3
                                    }
                                }
                            }
                        });
                    }
                }
            });
        </script>

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