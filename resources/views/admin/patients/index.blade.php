@extends('layouts.admin.app')

@section('content')

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h2 class="fw-bold">Patients</h2>
            </div>

            <div class="card-toolbar">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-lg"></i> Add Patient
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="patient_table" class="table table-row-bordered table-striped gy-5 gs-7">
                <thead>
                    <tr class="fw-semibold">
                        <th>#</th>
                        <th>Name</th>
                        <th>NIK</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    {{-- ================= CREATE MODAL ================= --}}
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="fw-bold">Add Patient</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">National ID (NIK)</label>
                            <input type="text" name="national_id" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- ================= EDIT MODAL ================= --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="fw-bold">Edit Patient</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">National ID (NIK)</label>
                            <input type="text" name="national_id" id="edit_national_id" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="edit_date_of_birth" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gender</label>
                            <select name="gender" id="edit_gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone_number" id="edit_phone_number" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" id="edit_address" class="form-control"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


@push('js')
    <script>
        $(function () {

            $('#patient_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("patients.datatable") }}',
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name' },
                    { data: 'national_id' },
                    { data: 'date_of_birth' },
                    { data: 'gender', orderable: false },
                    { data: 'phone_number' },
                    { data: 'action', orderable: false, searchable: false, className: 'text-end' }
                ]
            });

            // EDIT BUTTON
            $(document).on('click', '.editBtn', function () {

                let id = $(this).data('id');

                $('#edit_name').val($(this).data('name'));
                $('#edit_national_id').val($(this).data('national'));
                $('#edit_date_of_birth').val($(this).data('dob'));
                $('#edit_gender').val($(this).data('gender'));
                $('#edit_phone_number').val($(this).data('phone'));
                $('#edit_address').val($(this).data('address'));

                $('#editForm').attr('action', '/admin/patients/' + id);

                $('#editModal').modal('show');
            });

        });
    </script>
@endpush