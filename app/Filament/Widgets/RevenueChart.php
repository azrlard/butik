<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan per Bulan';
    
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = $this->getRevenuePerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan (Rp)',
                    'data' => $data['revenuePerMonth'],
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'fill' => true,
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function getRevenuePerMonth(): array
    {
        $now = Carbon::now();
        $months = [];
        $revenuePerMonth = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $revenue = Order::whereIn('status', ['success', 'processing', 'shipped', 'completed', 'delivered'])
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total_harga');
            
            $revenuePerMonth[] = $revenue;
        }

        return [
            'months' => $months,
            'revenuePerMonth' => $revenuePerMonth,
        ];
    }
}
