@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center mb-4">Laporan Penjualan</h1>
            </div>
        </div>

        <!-- Total Pendapatan Harian -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-money-bill-wave"></i> Total Pendapatan Hari Ini</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title">Rp {{ number_format($totalPendapatanHarian ?? 0, 0, ',', '.') }}</h2>
                        <p class="card-text">Tanggal: {{ now()->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Total Order Hari Ini</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $totalOrderHarian ?? 0 }}</h2>
                        <p class="card-text">Order</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Makanan Terlaris -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h5 class="mb-0"><i class="fas fa-utensils"></i> Makanan Terlaris</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-warning">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Makanan</th>
                                        <th>Harga</th>
                                        <th>Terjual</th>
                                        <th>Total Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($makananTerlaris ?? [] as $index => $makanan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $makanan->nama ?? 'Nama Makanan' }}</strong>
                                                @if ($makanan->kategori ?? false)
                                                    <br><small class="text-muted">{{ $makanan->kategori }}</small>
                                                @endif
                                            </td>
                                            <td>Rp {{ number_format($makanan->harga ?? 0, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge bg-success">{{ $makanan->jumlah_terjual ?? 0 }}</span>
                                            </td>
                                            <td>Rp
                                                {{ number_format(($makanan->harga ?? 0) * ($makanan->jumlah_terjual ?? 0), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td
                                                colspan="5"
                                                class="text-center"
                                            >Belum ada data makanan terlaris</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Minuman Terlaris -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-coffee"></i> Minuman Terlaris</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Minuman</th>
                                        <th>Harga</th>
                                        <th>Terjual</th>
                                        <th>Total Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($minumanTerlaris ?? [] as $index => $minuman)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $minuman->nama ?? 'Nama Minuman' }}</strong>
                                                @if ($minuman->kategori ?? false)
                                                    <br><small class="text-muted">{{ $minuman->kategori }}</small>
                                                @endif
                                            </td>
                                            <td>Rp {{ number_format($minuman->harga ?? 0, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $minuman->jumlah_terjual ?? 0 }}</span>
                                            </td>
                                            <td>Rp
                                                {{ number_format(($minuman->harga ?? 0) * ($minuman->jumlah_terjual ?? 0), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td
                                                colspan="5"
                                                class="text-center"
                                            >Belum ada data minuman terlaris</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Pendapatan -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body text-center">
                        <h5>Pendapatan Makanan</h5>
                        <h3>Rp {{ number_format($pendapatanMakanan ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info">
                    <div class="card-body text-center">
                        <h5>Pendapatan Minuman</h5>
                        <h3>Rp {{ number_format($pendapatanMinuman ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body text-center">
                        <h5>Total Pendapatan</h5>
                        <h3>Rp {{ number_format(($pendapatanMakanan ?? 0) + ($pendapatanMinuman ?? 0), 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik atau Chart (opsional) -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Grafik Penjualan Hari Ini</h5>
                    </div>
                    <div class="card-body">
                        <canvas
                            id="salesChart"
                            width="400"
                            height="200"
                        ></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Chart.js (opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Contoh grafik sederhana
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Makanan', 'Minuman'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [
                        {{ $pendapatanMakanan ?? 0 }},
                        {{ $pendapatanMinuman ?? 0 }}
                    ],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
