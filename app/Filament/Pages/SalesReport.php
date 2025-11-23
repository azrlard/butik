<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use Dompdf\Dompdf;
use Dompdf\Options;

class SalesReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.sales-report';

    protected static ?string $navigationLabel = 'Laporan Penjualan';

    protected static ?string $title = 'Laporan Penjualan';

    protected static ?int $navigationSort = 15;

    public function getStats(): array
    {
        // Total penjualan hari ini
        $todaySales = Order::whereDate('created_at', today())->sum('total_harga');

        // Total penjualan bulan ini
        $monthlySales = Order::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->sum('total_harga');

        // Total pesanan bulan ini
        $monthlyOrders = Order::whereMonth('created_at', now()->month)
                             ->whereYear('created_at', now()->year)
                             ->count();

        // Rata-rata nilai pesanan
        $avgOrderValue = Order::whereMonth('created_at', now()->month)
                             ->whereYear('created_at', now()->year)
                             ->avg('total_harga') ?? 0;

        return [
            Stat::make('Penjualan Hari Ini', 'Rp ' . number_format($todaySales, 0, ',', '.'))
                ->description('Total penjualan hari ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Penjualan Bulan Ini', 'Rp ' . number_format($monthlySales, 0, ',', '.'))
                ->description('Total penjualan bulan ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),

            Stat::make('Total Pesanan Bulan Ini', $monthlyOrders)
                ->description('Jumlah pesanan bulan ini')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info'),

            Stat::make('Rata-rata Nilai Pesanan', 'Rp ' . number_format($avgOrderValue, 0, ',', '.'))
                ->description('Rata-rata nilai pesanan bulan ini')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),
        ];
    }

    public function getTopProducts()
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.nama_produk', DB::raw('SUM(order_items.jumlah) as total_sold'), DB::raw('SUM(order_items.subtotal) as total_revenue'))
            ->whereMonth('order_items.created_at', now()->month)
            ->whereYear('order_items.created_at', now()->year)
            ->groupBy('products.id', 'products.nama_produk')
            ->orderBy('total_sold', 'desc')
            ->limit(10)
            ->get();
    }

    public function getSalesByStatus()
    {
        return Order::select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(total_harga) as total'))
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->groupBy('status')
            ->get();
    }

    public function getMonthlySales()
    {
        return Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_harga) as total'),
                DB::raw('COUNT(*) as orders_count')
            )
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportPdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(fn () => $this->exportToPdf()),
        ];
    }

    public function exportToPdf()
    {
        $data = [
            'stats' => $this->getStats(),
            'topProducts' => $this->getTopProducts(),
            'salesByStatus' => $this->getSalesByStatus(),
            'monthlySales' => $this->getMonthlySales(),
            'month' => now()->format('F Y'),
        ];

        $html = view('filament.pages.sales-report-pdf', $data)->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response()->streamDownload(function () use ($dompdf) {
            echo $dompdf->output();
        }, 'laporan-penjualan-' . now()->format('Y-m') . '.pdf');
    }
}