@extends('layouts.admin.app')

@section('content')

    <div class="card mb-5">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h2 class="fw-bold">
                    <i class="bi bi-bar-chart-line me-2 text-primary"></i>
                    Revenue Report
                </h2>
            </div>
        </div>

        <div class="card-body">

            {{-- FILTER --}}
            <div class="row mb-5">
                <div class="col-md-3">
                    <input type="date" id="start_date" class="form-control">
                </div>

                <div class="col-md-3">
                    <input type="date" id="end_date" class="form-control">
                </div>

                <div class="col-md-6 text-end">
                    <button id="filterBtn" class="btn btn-primary me-2">
                        <i class="bi bi-funnel"></i> Filter
                    </button>

                    <button id="printBtn" class="btn btn-danger">
                        <i class="bi bi-printer"></i> Print
                    </button>
                </div>
            </div>

            {{-- SUMMARY CARDS --}}
            <div class="row g-4 mb-7">

                <div class="col-md-3">
                    <div class="card bg-light-primary shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-gray-600 fs-7">Total Visits</div>
                                <div class="fs-2 fw-bold" id="sum_visits">0</div>
                            </div>
                            <i class="bi bi-people-fill fs-1 text-primary"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-light-success shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-gray-600 fs-7">Doctor Fee</div>
                                <div class="fs-2 fw-bold" id="sum_doctor">Rp 0</div>
                            </div>
                            <i class="bi bi-cash-stack fs-1 text-success"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-light-warning shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-gray-600 fs-7">Additional Fee</div>
                                <div class="fs-2 fw-bold" id="sum_additional">Rp 0</div>
                            </div>
                            <i class="bi bi-wallet2 fs-1 text-warning"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-light-danger shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-gray-600 fs-7">Total Revenue</div>
                                <div class="fs-2 fw-bold" id="sum_revenue">Rp 0</div>
                            </div>
                            <i class="bi bi-graph-up-arrow fs-1 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="reportTable">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th>Date</th>
                            <th>Total Visits</th>
                            <th>Doctor Fee</th>
                            <th>Additional Fee</th>
                            <th>Total Revenue</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>

@endsection


@push('js')
    <script>

        function formatRupiah(number) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(number ?? 0);
        }

        function loadSummary() {
            $.get("{{ route('reports.summary') }}", {
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val()
            }, function (res) {
                $('#sum_visits').text(res.total_visits ?? 0);
                $('#sum_doctor').text(formatRupiah(res.total_doctor_fee));
                $('#sum_additional').text(formatRupiah(res.total_additional_fee));
                $('#sum_revenue').text(formatRupiah(res.total_revenue));
            });
        }

        let table = $('#reportTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('reports.data') }}",
                data: function (d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [
                { data: 'date' },
                { data: 'total_visits' },
                { data: 'total_doctor_fee' },
                { data: 'total_additional_fee' },
                { data: 'total_revenue' }
            ]
        });

        $('#filterBtn').click(function () {

            if (!$('#start_date').val() || !$('#end_date').val()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Periode belum lengkap',
                    text: 'Silakan pilih tanggal mulai dan akhir.'
                });
                return;
            }

            table.ajax.reload();
            loadSummary();

            Swal.fire({
                icon: 'success',
                title: 'Data berhasil difilter',
                timer: 1200,
                showConfirmButton: false
            });
        });

        $('#printBtn').click(function () {

            let start = $('#start_date').val();
            let end = $('#end_date').val();

            if (!start || !end) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih tanggal dulu'
                });
                return;
            }

            window.open("{{ route('reports.print') }}?start_date=" + start + "&end_date=" + end, '_blank');
        });

        $(document).ready(function () {
            loadSummary();
        });

    </script>
@endpush