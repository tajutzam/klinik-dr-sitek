@extends('layouts.admin.app')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h2 class="fw-bold">
                    Manajemen Pengguna
                </h2>
            </div>

            <div class="card-toolbar">
                <button class="btn btn-primary" id="createBtn">
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambah User
                </button>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="userTable">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Dibuat</th>
                            <th class="text-end" width="120">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- ================= MODAL ================= -->
    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="userForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTitle">
                        <i class="bi bi-person-plus me-2"></i>
                        Tambah User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body py-5">

                    <input type="hidden" id="user_id">

                    <div class="mb-5">
                        <label class="form-label required">Nama</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" id="name" class="form-control" placeholder="Masukkan nama">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label required">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" id="email" class="form-control" placeholder="Masukkan email">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" id="password" class="form-control" placeholder="Masukkan password">
                        </div>
                        <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script>

        let table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.data') }}",
            columns: [
                { data: 'name' },
                { data: 'email' },
                { data: 'created_at' },
                { data: 'action', orderable: false, searchable: false, className: 'text-end' }
            ]
        });


        /* ================= CREATE ================= */
        $('#createBtn').click(function () {
            $('#userForm')[0].reset();
            $('#user_id').val('');
            $('#modalTitle').html('<i class="bi bi-person-plus me-2"></i> Tambah User');
            $('#userModal').modal('show');
        });


        /* ================= STORE / UPDATE ================= */
        $('#userForm').submit(function (e) {
            e.preventDefault();

            let id = $('#user_id').val();
            let url = id ? '/admin/users/' + id : '/admin/users';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val()
                },
                success: function () {
                    $('#userModal').modal('hide');
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data pengguna berhasil disimpan',
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: xhr.responseJSON?.message ?? 'Gagal menyimpan data'
                    });
                }
            });
        });


        /* ================= EDIT ================= */
        $(document).on('click', '.editBtn', function () {
            let id = $(this).data('id');

            $.get('/admin/users/' + id, function (data) {
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#password').val('');
                $('#modalTitle').html('<i class="bi bi-pencil-square me-2"></i> Edit User');
                $('#userModal').modal('show');
            });
        });


        /* ================= DELETE ================= */
        $(document).on('click', '.deleteBtn', function () {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Hapus pengguna?',
                text: 'Data tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/users/' + id,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function () {
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus',
                                timer: 1200,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        });

    </script>
@endpush