<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - {{ $month }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .stats {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .stat-row {
            display: table-row;
        }
        .stat-cell {
            display: table-cell;
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
            width: 25%;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
        }
        .stat-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .summary {
            background-color: #f0f9ff;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #0ea5e9;
        }
        .summary h3 {
            margin: 0 0 15px 0;
            color: #0c4a6e;
        }
        .summary-grid {
            display: table;
            width: 100%;
        }
        .summary-row {
            display: table-row;
        }
        .summary-cell {
            display: table-cell;
            padding: 5px 0;
            width: 33.33%;
        }
        .summary-label {
            font-weight: bold;
            color: #374151;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Penjualan</h1>
        <p>Periode: {{ $month }}</p>
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
    </div>

    <!-- Stats Overview -->
    <div class="stats">
        <div class="stat-row">
            @foreach($stats as $stat)
            <div class="stat-cell">
                <div class="stat-value">{{ $stat->getValue() }}</div>
                <div class="stat-label">{{ $stat->getDescription() }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Top Products -->
    <div class="section">
        <h2>Produk Terlaris</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Total Terjual</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topProducts as $product)
                <tr>
                    <td>{{ $product->nama_produk }}</td>
                    <td>{{ $product->total_sold }}</td>
                    <td class="text-right">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Belum ada data penjualan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Sales by Status -->
    <div class="section">
        <h2>Status Pesanan</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Jumlah Pesanan</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salesByStatus as $status)
                <tr>
                    <td style="text-transform: capitalize;">{{ $status->status }}</td>
                    <td>{{ $status->count }}</td>
                    <td class="text-right">Rp {{ number_format($status->total, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Belum ada data pesanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class="summary">
        <h3>Ringkasan Bulan Ini</h3>
        <div class="summary-grid">
            <div class="summary-row">
                <div class="summary-cell">
                    <div class="summary-label">Total Pendapatan</div>
                    <div class="summary-value">Rp {{ number_format($monthlySales->sum('total'), 0, ',', '.') }}</div>
                </div>
                <div class="summary-cell">
                    <div class="summary-label">Total Pesanan</div>
                    <div class="summary-value">{{ $monthlySales->sum('orders_count') }}</div>
                </div>
                <div class="summary-cell">
                    <div class="summary-label">Rata-rata per Hari</div>
                    <div class="summary-value">Rp {{ number_format($monthlySales->avg('total') ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>