@extends('layouts.admin.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="">
        <div class="d-flex flex-stack mb-9">
            <div>
                <h1 class="fw-bold text-gray-900 m-0">Dashboard Overview</h1>
                <span class="text-muted fw-semibold fs-7">Statistik klinik dan ringkasan aktivitas terkini</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('visits.create') }}" class="btn btn-sm btn-secondary fw-bold px-5">
                    <i class="bi bi-plus-lg me-2"></i> Registrasi Baru
                </a>
            </div>
        </div>

        <div class="row g-6 mb-10">
            <div class="col-md-6 col-lg-3">
                <div class="card card-flush h-md-100 border-0 shadow-sm hover-elevate-up" style="border-radius: 1.25rem">
                    <div class="card-header pt-6">
                        <div class="card-title d-flex flex-column">
                            <div class="d-flex align-items-center mb-1">
                                <span
                                    class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ number_format($totalPatients) }}</span>
                            </div>
                            <span class="text-gray-500 fw-bold fs-6">Total Pasien</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-flush h-md-100 border-0 shadow-sm hover-elevate-up" style="border-radius: 1.25rem">
                    <div class="card-header pt-6">
                        <div class="card-title d-flex flex-column">
                            <div class="d-flex align-items-center mb-1">
                                <span
                                    class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ number_format($totalMedicines) }}</span>
                            </div>
                            <span class="text-gray-500 fw-bold fs-6">Stok Obat</span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end pb-7">
                    </div>
                </div>
            </div>

            {{-- Kunjungan Bulan Ini --}}
            <div class="col-md-6 col-lg-3">
                <div class="card card-flush h-md-100 border-0 shadow-sm hover-elevate-up position-relative overflow-hidden"
                    style="border-radius: 1.25rem; background: linear-gradient(135deg, #232339 0%, #1e1e2d 100%)">
                    <div class="card-header pt-6">
                        <div class="card-title d-flex flex-column">
                            <span
                                class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ number_format($monthlyVisits) }}</span>
                            <span class="text-gray-500 fw-bold fs-6">Kunjungan</span>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-end pb-7">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-45px me-3">
                                <div class="symbol-label bg-white bg-opacity-10 rounded-12px">
                                    <i class="bi bi-calendar-check fs-2 text-white"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-white opacity-75 fw-semibold fs-7">Aktivitas bulan ini</span>
                                @if($visitsChange >= 0)
                                    <span class="text-success fw-bold fs-8">
                                        <i class="bi bi-arrow-up me-1 text-success"></i>{{ number_format($visitsChange, 1) }}%
                                        vs bulan lalu
                                    </span>
                                @else
                                    <span class="text-danger fw-bold fs-8">
                                        <i
                                            class="bi bi-arrow-down me-1 text-danger"></i>{{ number_format(abs($visitsChange), 1) }}%
                                        vs bulan lalu
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 end-0 opacity-10 me-n5 mb-n5">
                        <i class="bi bi-activity text-white" style="font-size: 8rem"></i>
                    </div>
                </div>
            </div>

            {{-- Pendapatan --}}
            <div class="col-md-6 col-lg-3">
                <div class="card card-flush h-md-100 border-0 shadow-sm hover-elevate-up"
                    style="border-radius: 1.25rem; background-color: #f8f9fa">
                    <div class="card-header pt-6">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">
                                <small
                                    class="fs-4 fw-semibold text-muted">Rp</small>{{ number_format($monthlyRevenue, 0, ',', '.') }}
                            </span>
                            <span class="text-gray-500 fw-bold fs-6">Revenue</span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end pb-7">
                        @if($revenueChange >= 0)
                            <div class="d-flex align-items-center">
                                <span class="badge badge-light-success px-3 py-2 fs-8 fw-bold">
                                    <i class="bi bi-arrow-up me-1"></i>{{ number_format($revenueChange, 1) }}%
                                </span>
                                <span class="text-muted fs-8 fw-bold ms-3">vs Bulan Lalu</span>
                            </div>
                        @else
                            <div class="d-flex align-items-center">
                                <span class="badge badge-light-danger px-3 py-2 fs-8 fw-bold">
                                    <i class="bi bi-arrow-down me-1"></i>{{ number_format(abs($revenueChange), 1) }}%
                                </span>
                                <span class="text-muted fs-8 fw-bold ms-3">vs Bulan Lalu</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-6 mb-10">
            <div class="col-xl-8">
                <div class="card card-flush h-xl-100 shadow-sm border-0" style="border-radius: 1.25rem">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Tren Kunjungan Harian</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-7">Analisis data kunjungan pasien bulan
                                ini</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2">
                        <canvas id="visitChart" style="height: 320px; width: 100%"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card card-flush h-xl-100 shadow-sm border-0" style="border-radius: 1.25rem">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Peringatan Stok</span>
                            <span class="text-danger mt-1 fw-bold fs-7">{{ $lowStockList->count() }} Item kritis</span>
                        </h3>
                    </div>
                    <div class="card-body pt-5">
                        @forelse($lowStockList as $medicine)
                            <div class="d-flex flex-stack bg-light-danger bg-opacity-10 p-4 rounded-12px mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white rounded-10px">
                                            <i class="fa-solid fa-pills text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold fs-7">{{ $medicine->medicine_name }}</span>
                                        <span class="text-muted fw-semibold fs-8">{{ $medicine->unit }}</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <span class="text-danger fw-boldest fs-6">{{ $medicine->stock }}</span>
                                    <span class="text-muted fw-bold fs-9">Sisa Stok</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <div class="symbol symbol-100px mb-5">
                                    <div class="symbol-label bg-light-success rounded-circle">
                                        <i class="bi bi-shield-check text-success fs-3x"></i>
                                    </div>
                                </div>
                                <div class="text-gray-800 fw-bold fs-5">Semua Stok Aman</div>
                                <div class="text-muted fs-7">Inventory dalam kondisi optimal</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-6 mb-10">
            <div class="col-12">
                <div class="card card-flush shadow-sm border-0" style="border-radius: 1.25rem">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Perbandingan Bulanan</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-7">Revenue dan kunjungan pasien — 6 bulan
                                terakhir</span>
                        </h3>
                        <div class="card-toolbar">
                            <div class="d-flex gap-5">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="rounded-2 d-inline-block"
                                        style="width: 14px; height: 14px; background: #378ADD;"></span>
                                    <span class="text-muted fw-semibold fs-8">Revenue</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="rounded-2 d-inline-block"
                                        style="width: 14px; height: 14px; background: #1D9E75;"></span>
                                    <span class="text-muted fw-semibold fs-8">Kunjungan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-4 pb-0">
                        <div class="row g-4 mb-6">
                            @php
                                $compRevArr = $comparisonRevenue->toArray();
                                $compVisArr = $comparisonVisits->toArray();
                                $compLabArr = $comparisonLabels->toArray();
                                $lastIdx = count($compRevArr) - 1;
                                $prevIdx = $lastIdx - 1;

                                $revDiff = $prevIdx >= 0 && $compRevArr[$prevIdx] > 0
                                    ? (($compRevArr[$lastIdx] - $compRevArr[$prevIdx]) / $compRevArr[$prevIdx]) * 100
                                    : ($compRevArr[$lastIdx] > 0 ? 100 : 0);

                                $visDiff = $prevIdx >= 0 && $compVisArr[$prevIdx] > 0
                                    ? (($compVisArr[$lastIdx] - $compVisArr[$prevIdx]) / $compVisArr[$prevIdx]) * 100
                                    : ($compVisArr[$lastIdx] > 0 ? 100 : 0);

                                $bestRevIdx = array_search(max($compRevArr), $compRevArr);
                                $bestVisIdx = array_search(max($compVisArr), $compVisArr);
                            @endphp

                            <div class="col-6 col-md-3">
                                <div class="bg-light-primary rounded-12px p-4 h-100">
                                    <div class="text-muted fw-semibold fs-8 mb-1">Revenue Bulan Ini</div>
                                    <div class="fw-bold text-gray-900 fs-5">Rp
                                        {{ number_format($compRevArr[$lastIdx], 0, ',', '.') }}</div>
                                    <div class="mt-2">
                                        @if($revDiff >= 0)
                                            <span class="badge badge-light-success fs-9 px-2 py-1">
                                                <i class="bi bi-arrow-up me-1"></i>{{ number_format($revDiff, 1) }}%
                                            </span>
                                        @else
                                            <span class="badge badge-light-danger fs-9 px-2 py-1">
                                                <i class="bi bi-arrow-down me-1"></i>{{ number_format(abs($revDiff), 1) }}%
                                            </span>
                                        @endif
                                        <span class="text-muted fs-9 ms-1">vs {{ $compLabArr[$prevIdx] ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="bg-light-success rounded-12px p-4 h-100">
                                    <div class="text-muted fw-semibold fs-8 mb-1">Kunjungan Bulan Ini</div>
                                    <div class="fw-bold text-gray-900 fs-5">{{ number_format($compVisArr[$lastIdx]) }}
                                        pasien</div>
                                    <div class="mt-2">
                                        @if($visDiff >= 0)
                                            <span class="badge badge-light-success fs-9 px-2 py-1">
                                                <i class="bi bi-arrow-up me-1"></i>{{ number_format($visDiff, 1) }}%
                                            </span>
                                        @else
                                            <span class="badge badge-light-danger fs-9 px-2 py-1">
                                                <i class="bi bi-arrow-down me-1"></i>{{ number_format(abs($visDiff), 1) }}%
                                            </span>
                                        @endif
                                        <span class="text-muted fs-9 ms-1">vs {{ $compLabArr[$prevIdx] ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="bg-light rounded-12px p-4 h-100">
                                    <div class="text-muted fw-semibold fs-8 mb-1">Bulan Terbaik (Revenue)</div>
                                    <div class="fw-bold text-gray-900 fs-5">{{ $compLabArr[$bestRevIdx] }}</div>
                                    <div class="text-muted fs-8 mt-1">Rp
                                        {{ number_format($compRevArr[$bestRevIdx], 0, ',', '.') }}</div>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="bg-light rounded-12px p-4 h-100">
                                    <div class="text-muted fw-semibold fs-8 mb-1">Bulan Terbaik (Kunjungan)</div>
                                    <div class="fw-bold text-gray-900 fs-5">{{ $compLabArr[$bestVisIdx] }}</div>
                                    <div class="text-muted fs-8 mt-1">{{ number_format($compVisArr[$bestVisIdx]) }} pasien
                                    </div>
                                </div>
                            </div>
                        </div>

                        <canvas id="comparisonChart" style="height: 320px; width: 100%"></canvas>
                    </div>
                    <div class="card-body pt-3 pb-7"></div>
                </div>
            </div>
        </div>

        {{-- Row 4: Recent Activity Table --}}
        <div class="card card-flush shadow-sm border-0 mb-10" style="border-radius: 1.25rem">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Log Aktivitas Terbaru</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Menampilkan {{ $recentVisits->count() }} kunjungan
                        terakhir</span>
                </h3>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-150px">Tanggal & Jam</th>
                                <th class="min-w-200px">Detail Pasien</th>
                                <th class="min-w-100px text-end">Biaya Layanan</th>
                                <th class="min-w-70px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse($recentVisits as $visit)
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span
                                                class="text-gray-800 fw-bold fs-6">{{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}</span>
                                            <span
                                                class="text-muted fw-bold fs-7">{{ \Carbon\Carbon::parse($visit->visit_date)->format('H:i') }}
                                                WIB</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-3">
                                                <div class="symbol-label fs-4 fw-bold bg-light-secondary text-secondary">
                                                    {{ strtoupper(substr($visit->patient->name ?? '?', 0, 1)) }}
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span
                                                    class="text-gray-800 fw-bold fs-6">{{ $visit->patient->name ?? '-' }}</span>
                                                <span class="text-muted fs-7">ID: #VIS-{{ $visit->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end fw-boldest text-gray-800">
                                        Rp {{ number_format($visit->total_cost, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('visits.show', $visit) }}"
                                            class="btn btn-icon btn-light-secondary btn-sm rounded-circle">
                                            <i class="bi bi-chevron-right text-gray-700"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-10">
                                        <div class="text-muted fs-6">Belum ada aktivitas kunjungan</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .rounded-12px {
            border-radius: 12px !important;
        }

        .rounded-10px {
            border-radius: 10px !important;
        }

        .ls-n2 {
            letter-spacing: -0.02em !important;
        }

        .table-row-dashed tr {
            border-bottom: 1px dashed #eff2f5 !important;
        }

        .table-row-dashed tr:last-child {
            border-bottom: none !important;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // ── Daily Visit Chart ──────────────────────────────────────────────
            const ctx = document.getElementById('visitChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(0, 158, 247, 0.2)');
            gradient.addColorStop(1, 'rgba(0, 158, 247, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Kunjungan',
                        data: {!! json_encode($chartData) !!},
                        borderColor: '#009EF7',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#009EF7',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#F1F1F4', drawBorder: false },
                            ticks: { precision: 0, color: '#A1A5B7' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#A1A5B7' }
                        }
                    }
                }
            });

            // ── Monthly Comparison Chart ───────────────────────────────────────
            const ctxCmp = document.getElementById('comparisonChart').getContext('2d');

            new Chart(ctxCmp, {
                data: {
                    labels: {!! json_encode($comparisonLabels) !!},
                    datasets: [
                        {
                            type: 'bar',
                            label: 'Revenue',
                            data: {!! json_encode($comparisonRevenue) !!},
                            backgroundColor: '#378ADD',
                            borderRadius: 6,
                            yAxisID: 'yRevenue',
                            order: 2
                        },
                        {
                            type: 'line',
                            label: 'Kunjungan',
                            data: {!! json_encode($comparisonVisits) !!},
                            borderColor: '#1D9E75',
                            backgroundColor: 'rgba(29,158,117,0.08)',
                            borderWidth: 2.5,
                            borderDash: [6, 3],
                            pointBackgroundColor: '#1D9E75',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            tension: 0.35,
                            fill: true,
                            yAxisID: 'yVisits',
                            order: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function (ctx) {
                                    if (ctx.dataset.label === 'Revenue') {
                                        return ' Revenue: Rp ' + new Intl.NumberFormat('id-ID').format(ctx.parsed.y);
                                    }
                                    return ' Kunjungan: ' + ctx.parsed.y + ' pasien';
                                }
                            }
                        }
                    },
                    scales: {
                        yRevenue: {
                            type: 'linear',
                            position: 'left',
                            beginAtZero: true,
                            grid: { color: '#F1F1F4', drawBorder: false },
                            ticks: {
                                color: '#A1A5B7',
                                callback: v => 'Rp ' + new Intl.NumberFormat('id-ID', { notation: 'compact' }).format(v)
                            }
                        },
                        yVisits: {
                            type: 'linear',
                            position: 'right',
                            beginAtZero: true,
                            grid: { display: false },
                            ticks: { precision: 0, color: '#1D9E75' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#A1A5B7' }
                        }
                    }
                }
            });
        });
    </script>
@endpush