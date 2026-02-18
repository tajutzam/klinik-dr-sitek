@extends('layouts.admin.app')

@section('content')

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h2 class="fw-bold">Medicine Categories</h2>
            </div>

            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-lg"></i>
                    Add Category
                </button>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table id="medicine_category_table" class="table table-row-bordered table-striped gy-5 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th width="5%">#</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th width="15%" class="text-end">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('medicine-categories.store') }}" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Medicine Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Medicine Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="edit_description" class="form-control"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
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
        $(document).ready(function () {

            let table = $('#medicine_category_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("medicine-categories.datatable") }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                scrollX: true
            });


            $(document).on('click', '.editBtn', function () {

                let id = $(this).data('id');
                let name = $(this).data('name');
                let description = $(this).data('description');

                $('#edit_name').val(name);
                $('#edit_description').val(description);

                $('#editForm').attr('action',
                    '/admin/medicine-categories/' + id);

                $('#editModal').modal('show');
            });


            $(document).on('submit', 'form', function (e) {

                if ($(this).find('input[name="_method"][value="DELETE"]').length) {
                    e.preventDefault();

                    let form = this;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This data will be permanently deleted!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }

            });

        });
    </script>

@endpush