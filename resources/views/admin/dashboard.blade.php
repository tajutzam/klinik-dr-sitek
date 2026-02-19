@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">

        <div class="row g-5 mb-8">

            <div class="col-xl-3">
                <div class="card card-xl-stretch shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-primary">
                                <i class="bi bi-people fs-2 text-primary"></i>
                            </span>
                        </div>
                        <div>
                            <div class="text-muted fw-semibold fs-7">Total Pasien</div>
                            <div class="fs-2hx fw-bold text-dark">
                                {{ number_format($totalPatients) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card card-xl-stretch shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-success">
                                <i class="bi bi-capsule-pill fs-2 text-success"></i>
                            </span>
                        </div>
                        <div>
                            <div class="text-muted fw-semibold fs-7">Total Obat</div>
                            <div class="fs-2hx fw-bold text-dark">
                                {{ number_format($totalMedicines) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kunjungan -->
            <div class="col-xl-3">
                <div class="card card-xl-stretch shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-info">
                                <i class="bi bi-clipboard-pulse fs-2 text-info"></i>
                            </span>
                        </div>
                        <div>
                            <div class="text-muted fw-semibold fs-7">Kunjungan Bulan Ini</div>
                            <div class="fs-2hx fw-bold text-dark">
                                {{ number_format($monthlyVisits) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendapatan -->
            <div class="col-xl-3">
                <div class="card card-xl-stretch shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-warning">
                                <i class="bi bi-cash-stack fs-2 text-warning"></i>
                            </span>
                        </div>
                        <div>
                            <div class="text-muted fw-semibold fs-7">Pendapatan Bulan Ini</div>
                            <div class="fs-2hx fw-bold text-dark">
                                Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Chart -->
        <div class="row g-5 mb-8">
            <div class="col-xl-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header align-items-center">
                        <h3 class="card-title fw-bold">
                            <i class="bi bi-graph-up-arrow me-2 text-primary"></i>
                            Grafik Kunjungan Harian
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="visitChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <!-- Data Section -->
        <div class="row g-5">

            <!-- Kunjungan Terbaru -->
            <div class="col-xl-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h3 class="card-title fw-bold">
                            <i class="bi bi-clock-history me-2 text-info"></i>
                            Kunjungan Terbaru
                        </h3>
                    </div>
                    <div class="card-body">

                        <table class="table align-middle table-row-dashed">
                            <thead>
                                <tr class="text-muted fw-bold text-uppercase fs-7">
                                    <th>Tanggal</th>
                                    <th>Pasien</th>
                                    <th class="text-end">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentVisits as $visit)
                                    <tr>
                                        <td>
                                            {{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y H:i') }}
                                        </td>
                                        <td>
                                            <i class="bi bi-person me-1 text-muted"></i>
                                            {{ $visit->patient->name ?? '-' }}
                                        </td>
                                        <td class="text-end fw-bold">
                                            Rp {{ number_format($visit->total_cost, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            Belum ada data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


            <!-- Stok Minimum -->
            <div class="col-xl-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h3 class="card-title fw-bold">
                            <i class="bi bi-exclamation-triangle me-2 text-danger"></i>
                            Stok Minimum
                        </h3>
                    </div>
                    <div class="card-body">

                        @forelse($lowStockList as $medicine)
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <div>
                                    <div class="fw-bold">
                                        {{ $medicine->medicine_name }}
                                    </div>
                                    <div class="text-muted fs-7">
                                        {{ $medicine->unit }}
                                    </div>
                                </div>
                                <span class="badge badge-light-danger fs-7">
                                    {{ $medicine->stock }}
                                </span>
                            </div>
                        @empty
                            <div class="text-muted text-center">
                                Semua stok aman
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection


@push('js')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('visitChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: {!! json_encode($chartData) !!},
                    borderColor: '#009EF7',
                    backgroundColor: 'rgba(0,158,247,0.15)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#009EF7',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f1f1'
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>

@endpush