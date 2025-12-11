<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\CustomRequest;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Total Orders
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::whereIn('status', ['completed', 'delivered'])->count();
        
        // Total Revenue
        $totalRevenue = Order::whereIn('status', ['success', 'processing', 'shipped', 'completed', 'delivered'])
            ->sum('total_harga');
        $monthlyRevenue = Order::whereIn('status', ['success', 'processing', 'shipped', 'completed', 'delivered'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_harga');
        
        // Products
        $totalProducts = Product::count();
        $activeProducts = Product::where('stok', '>', 0)->count();
        
        // Users
        $totalUsers = User::where('role', 'user')->count();
        $newUsersThisMonth = User::where('role', 'user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Custom Requests
        $totalCustomRequests = CustomRequest::count();
        $pendingCustomRequests = CustomRequest::where('status', 'pending')->count();

        return [
            Stat::make('Total Pesanan', $totalOrders)
                ->description($pendingOrders . ' pesanan menunggu pembayaran')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart([7, 12, 8, 15, 10, 18, $totalOrders]),
            
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Rp ' . number_format($monthlyRevenue, 0, ',', '.') . ' bulan ini')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->chart([100000, 150000, 200000, 180000, 220000, 250000, $monthlyRevenue]),
            
            Stat::make('Total Produk', $totalProducts)
                ->description($activeProducts . ' produk tersedia')
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning'),
            
            Stat::make('Total Pengguna', $totalUsers)
                ->description($newUsersThisMonth . ' pengguna baru bulan ini')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
            
            Stat::make('Custom Request', $totalCustomRequests)
                ->description($pendingCustomRequests . ' menunggu diproses')
                ->descriptionIcon('heroicon-m-paint-brush')
                ->color('danger'),
            
            Stat::make('Pesanan Selesai', $completedOrders)
                ->description(round(($completedOrders / max($totalOrders, 1)) * 100, 1) . '% dari total pesanan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
