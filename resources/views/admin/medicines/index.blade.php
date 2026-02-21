@extends('layouts.admin.app')

@section('content')

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h2 class="fw-bold">Medicines</h2>
            </div>

            <div class="card-toolbar">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-lg"></i> Add Medicine
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="medicine_table" class="table table-row-bordered table-striped gy-5 gs-7">
                <thead>
                    <tr class="fw-semibold text-gray-800">
                        <th width="5%">#</th>
                        <th>Medicine Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Unit</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th width="15%" class="text-end">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('medicines.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Add Medicine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Medicine Name</label>
                            <input type="text" name="medicine_name" class="form-control" placeholder="Enter medicine name"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Medicine Category</label>
                            <select name="medicine_category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Price</label>
                            <input type="number" name="price" step="0.01" class="form-control" placeholder="Enter price"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Unit</label>
                            <input type="text" name="unit" class="form-control" placeholder="Example: tablet, bottle"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Current Stock</label>
                            <input type="number" name="stock" class="form-control" placeholder="Enter stock" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold">Minimum Stock Alert</label>
                            <input type="number" name="minimum_stock" class="form-control"
                                placeholder="Set minimum threshold" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
                        <h5 class="modal-title fw-bold">Edit Medicine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Medicine Name</label>
                            <input type="text" name="medicine_name" id="edit_medicine_name" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Medicine Category</label>
                            <select name="medicine_category_id" id="edit_category_id" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Price</label>
                            <input type="number" name="price" id="edit_price" step="0.01" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Unit</label>
                            <input type="text" name="unit" id="edit_unit" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Current Stock</label>
                            <input type="number" name="stock" id="edit_stock" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold">Minimum Stock Alert</label>
                            <input type="number" name="minimum_stock" id="edit_minimum_stock" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


@push('js')
    <script>
        $(function () {

            $('#medicine_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("medicines.datatable") }}',
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'medicine_name' },
                    { data: 'category' },
                    { data: 'price' },
                    { data: 'unit' },
                    { data: 'stock' },
                    { data: 'stock_status', orderable: false, searchable: false },
                    { data: 'action', orderable: false, searchable: false, className: 'text-end' }
                ]
            });

            $(document).on('click', '.editBtn', function () {

                let id = $(this).data('id');

                $('#edit_medicine_name').val($(this).data('name'));
                $('#edit_category_id').val($(this).data('category'));
                $('#edit_price').val($(this).data('price'));
                $('#edit_unit').val($(this).data('unit'));
                $('#edit_stock').val($(this).data('stock'));
                $('#edit_minimum_stock').val($(this).data('min'));

                $('#editForm').attr('action', '/admin/medicines/' + id);

                $('#editModal').modal('show');
            });
        });
    </script>
@endpush