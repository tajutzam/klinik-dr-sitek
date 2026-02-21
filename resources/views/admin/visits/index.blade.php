@extends('layouts.admin.app')

@section('content')

    <div class="row g-5 mb-6">

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted fs-7">Total Visits</div>
                        <div class="fs-2 fw-bold text-primary" id="total_visits">0</div>
                    </div>
                    <div class="bg-light-primary p-3 rounded">
                        <i class="bi bi-clipboard2-pulse fs-2 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted fs-7">Today Visits</div>
                        <div class="fs-2 fw-bold text-success" id="today_visits">0</div>
                    </div>
                    <div class="bg-light-success p-3 rounded">
                        <i class="bi bi-calendar-check fs-2 text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted fs-7">Total Revenue</div>
                        <div class="fs-2 fw-bold text-warning" id="total_revenue">Rp 0</div>
                    </div>
                    <div class="bg-light-warning p-3 rounded">
                        <i class="bi bi-cash-stack fs-2 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="card shadow-sm">
        <div class="card-header border-0 pt-6">

            <div class="card-title">
                <h2 class="fw-bold">Visits</h2>
            </div>

            <div class="card-toolbar">
                <div class="d-flex align-items-center gap-2 flex-nowrap">

                    <div style="width:200px;">
                        <select id="filter_patient" class="form-select form-select-sm w-100"></select>
                    </div>

                    <div style="width:160px;">
                        <input type="date" id="filter_date" class="form-control form-control-sm w-100">
                    </div>

                    <button id="reset_filter" class="btn btn-light btn-sm">
                        Reset
                    </button>

                    <a href="{{ route('visits.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Add Visit
                    </a>

                </div>
            </div>
        </div>

        <div class="card-body">
            <table id="visit_table" class="table table-row-bordered table-striped gy-5 gs-7">
                <thead>
                    <tr class="fw-semibold">
                        <th>#</th>
                        <th>Date</th>
                        <th>Patient</th>
                        <th>Doctor Fee</th>
                        <th>Additional Fee</th>
                        <th>Total Cost</th>
                        <th>Created By</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- ================= EDIT VISIT MODAL ================= -->
    <div class="modal fade" id="editVisitModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title fw-bold">Edit Visit</h3>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="editVisitForm">

                        <input type="hidden" id="edit_id">

                        <div class="mb-6">
                            <label class="form-label fw-semibold">Pasien</label>
                            <select id="edit_patient" class="form-select"></select>
                        </div>

                        <div class="mb-6">
                            <label class="form-label fw-semibold">Biaya Dokter</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="edit_doctor_fee" class="form-control">
                            </div>
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Biaya Lainnya</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="edit_additional_fee" class="form-control">
                            </div>
                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="updateVisitBtn" class="btn btn-primary">
                        Update
                    </button>
                </div>

            </div>
        </div>
    </div>

@endsection


@push('js')
    <script>
        $(function () {

            $('#filter_patient').select2({
                placeholder: 'Search Patient...',
                allowClear: true,
                ajax: {
                    url: '{{ route("ajax.patients") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return { q: params.term };
                    },
                    processResults: function (data) {
                        return { results: data };
                    }
                }
            });

            let table = $('#visit_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("visits.datatable") }}',
                    data: function (d) {
                        d.filter_date = $('#filter_date').val();
                        d.filter_patient = $('#filter_patient').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'visit_date' },
                    { data: 'patient_name' },
                    { data: 'doctor_fee' },
                    { data: 'additional_fee' },
                    { data: 'total_cost' },
                    { data: 'created_by' },
                    { data: 'action', orderable: false, searchable: false, className: 'text-end' }
                ],
                order: [[1, 'desc']]
            });

            $('#filter_date, #filter_patient').change(function () {
                table.ajax.reload();
                loadSummary();
            });

            $('#reset_filter').click(function () {
                $('#filter_date').val('');
                $('#filter_patient').val(null).trigger('change');
                table.ajax.reload();
                loadSummary();
            });

            loadSummary();

            function loadSummary() {
                $.get('{{ route("visits.summary") }}', {
                    filter_date: $('#filter_date').val(),
                    filter_patient: $('#filter_patient').val()
                }, function (res) {
                    $('#total_visits').text(res.total_visits);
                    $('#today_visits').text(res.today_visits);
                    $('#total_revenue').text(res.total_revenue);
                });
            }


            // ================= EDIT SELECT2 =================
            $('#edit_patient').select2({
                dropdownParent: $('#editVisitModal'),
                placeholder: 'Search Patient...',
                allowClear: true,
                ajax: {
                    url: '{{ route("ajax.patients") }}',
                    dataType: 'json',
                    delay: 250,
                    data: params => ({ q: params.term }),
                    processResults: data => ({ results: data })
                }
            });

            // ================= OPEN EDIT MODAL =================
            $(document).on('click', '.editBtn', function () {

                let id = $(this).data('id');
                let patientId = $(this).data('patient');
                let doctor = $(this).data('doctor');
                let additional = $(this).data('additional');

                $('#edit_id').val(id);
                $('#edit_doctor_fee').val(doctor);
                $('#edit_additional_fee').val(additional);

                // Set selected patient
                $.ajax({
                    url: '{{ route("ajax.patients") }}',
                    data: { q: '' },
                    success: function () {
                        let option = new Option('Loading...', patientId, true, true);
                        $('#edit_patient').append(option).trigger('change');
                    }
                });

                $('#editVisitModal').modal('show');
            });

            $('#updateVisitBtn').click(function () {

                let id = $('#edit_id').val();

                $.ajax({
                    url: '/admin/visits/' + id,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        patient_id: $('#edit_patient').val(),
                        doctor_fee: $('#edit_doctor_fee').val(),
                        additional_fee: $('#edit_additional_fee').val()
                    },
                    success: function (res) {

                        $('#editVisitModal').modal('hide');

                        table.ajax.reload();
                        loadSummary();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data kunjungan berhasil diperbarui.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function (xhr) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message ?? 'Terjadi kesalahan saat update.'
                        });
                    }
                });

            });
        });
    </script>
@endpush