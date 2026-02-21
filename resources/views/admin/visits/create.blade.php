@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex flex-stack mb-7">
            <div>
                <h1 class="fw-bold text-gray-900">Registrasi Kunjungan Baru</h1>
                <div class="text-muted fs-7">Buat data kunjungan dan resep pasien</div>
            </div>

            <a href="{{ route('visits.index') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>
        </div>

        <form action="{{ route('visits.store') }}" method="POST" id="visitForm">
            @csrf

            <div class="row g-7">

                {{-- LEFT SECTION --}}
                <div class="col-xl-8">

                    {{-- PASIEN & BIAYA --}}
                    <div class="card card-flush mb-7">
                        <div class="card-header">
                            <h3 class="card-title fw-bold">Informasi Pasien</h3>
                        </div>

                        <div class="card-body">

                            <div class="mb-6">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-semibold mb-0">Pasien</label>
                                    <button type="button" class="btn btn-sm btn-secondary py-1" data-bs-toggle="modal"
                                        data-bs-target="#modal_add_patient">
                                        <i class="ki-outline ki-plus fs-6"></i> Pasien Baru
                                    </button>
                                </div>
                                <select name="patient_id" id="patient_select" class="form-select" required></select>
                            </div>

                            <div class="row g-6 mb-6">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Biaya Dokter</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="doctor_fee" id="doctor_fee" class="form-control"
                                            value="50000">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Biaya Lainnya</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="additional_fee" id="additional_fee" class="form-control"
                                            value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="form-label fw-semibold">Keluhan</label>
                                <textarea name="complaints" class="form-control" rows="2"></textarea>
                            </div>

                            <div>
                                <label class="form-label fw-semibold">Diagnosa</label>
                                <textarea name="diagnosis" class="form-control" rows="2"></textarea>
                            </div>

                        </div>
                    </div>


                    {{-- OBAT --}}
                    <div class="card card-flush">
                        <div class="card-header">
                            <h3 class="card-title fw-bold">Resep & Obat</h3>
                        </div>

                        <div class="card-body">

                            <div class="row g-4 mb-6 align-items-end">
                                <div class="col-md-7">
                                    <label class="form-label fw-semibold">Cari Obat</label>
                                    <select id="medicine_select" class="form-select"></select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Jumlah</label>
                                    <input type="number" id="medicine_qty" class="form-control" value="1" min="1">
                                </div>

                                <div class="col-md-2">
                                    <button type="button" id="add_medicine" class="btn btn-secondary w-100">
                                        Tambah
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <thead>
                                        <tr class="text-muted fw-bold fs-7 text-uppercase">
                                            <th>Item Obat</th>
                                            <th class="text-center" width="120">Qty</th>
                                            <th class="text-end" width="150">Harga</th>
                                            <th class="text-end" width="150">Subtotal</th>
                                            <th width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="medicine_table"></tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>


                {{-- RIGHT SECTION --}}
                <div class="col-xl-4">

                    <div class="card card-flush sticky-top" style="top:100px">
                        <div class="card-body">

                            <h3 class="fw-bold mb-6">Rincian Pembayaran</h3>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-gray-600">Jasa Konsultasi</span>
                                <span id="doctor_display">Rp 0</span>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-gray-600">Biaya Lainnya</span>
                                <span id="additional_display">Rp 0</span>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-gray-600">Total Obat</span>
                                <span id="medicine_total">Rp 0</span>
                            </div>

                            <div class="separator my-5"></div>

                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <span class="fw-bold fs-6">Total Akhir</span>
                                <span class="fw-bolder text-primary fs-2" id="grand_total">Rp 0</span>
                            </div>

                            <input type="hidden" name="total_cost" id="total_cost">

                            <button type="submit" class="btn btn-primary w-100">
                                Konfirmasi & Simpan
                            </button>

                        </div>
                    </div>

                </div>

            </div>
        </form>
    </div>

    {{-- MODAL TAMBAH PASIEN --}}
    <div class="modal fade" id="modal_add_patient" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <form id="form_add_patient">
                    @csrf
                    <div class="modal-header">
                        <h2 class="fw-bold">Tambah Pasien Baru</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>

                    <div class="modal-body py-10 px-lg-17">
                        <div class="row g-9 mb-7">
                            <div class="col-md-12">
                                <label class="required fs-6 fw-semibold mb-2">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" required />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-semibold mb-2">NIK (KTP)</label>
                                <input type="text" class="form-control" name="national_id" />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-semibold mb-2">No. Telepon</label>
                                <input type="text" class="form-control" name="phone_number" />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-semibold mb-2">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="date_of_birth" />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-semibold mb-2">Jenis Kelamin</label>
                                <select class="form-select" name="gender">
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="fs-6 fw-semibold mb-2">Alamat</label>
                                <textarea class="form-control" name="address" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer flex-center">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="btn_save_patient" class="btn btn-secondary">
                            <span class="indicator-label">Simpan Pasien</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Menyesuaikan style select2 agar konsisten dengan Metronic/Bootstrap */
        .select2-container--bootstrap5 .select2-selection {
            height: 40px;
        }
    </style>
@endpush


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {

            // --- SELECT2 CONFIG ---
            $('#patient_select').select2({
                placeholder: 'Cari pasien...',
                allowClear: true,
                ajax: {
                    url: '{{ route("ajax.patients") }}',
                    dataType: 'json',
                    delay: 300,
                    data: params => ({ q: params.term }),
                    processResults: data => ({ results: data })
                }
            });

            $('#medicine_select').select2({
                placeholder: 'Cari obat...',
                allowClear: true,
                ajax: {
                    url: '{{ route("ajax.medicines") }}',
                    dataType: 'json',
                    delay: 300,
                    data: params => ({ q: params.term }),
                    processResults: data => ({ results: data })
                }
            });

            // --- CALCULATION LOGIC ---
            let medicineTotal = 0;
            let medicineMap = {};

            const formatCurrency = num =>
                'Rp ' + new Intl.NumberFormat('id-ID').format(num);

            const calculateAll = () => {
                const docFee = parseInt($('#doctor_fee').val()) || 0;
                const addFee = parseInt($('#additional_fee').val()) || 0;

                $('#doctor_display').text(formatCurrency(docFee));
                $('#additional_display').text(formatCurrency(addFee));
                $('#medicine_total').text(formatCurrency(medicineTotal));

                const total = docFee + addFee + medicineTotal;
                $('#grand_total').text(formatCurrency(total));
                $('#total_cost').val(total);
            };

            // --- AJAX ADD PATIENT ---
            $('#form_add_patient').submit(function (e) {
                e.preventDefault();
                const btn = $('#btn_save_patient');
                btn.attr('disabled', true).html('Menyimpan...');

                $.ajax({
                    url: '{{ route("ajax.patients.store") }}', // Pastikan route ini sudah ada
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        // Tambahkan ke select2 dan pilih otomatis
                        const newOption = new Option(response.text, response.id, true, true);
                        $('#patient_select').append(newOption).trigger('change');

                        $('#modal_add_patient').modal('hide');
                        $('#form_add_patient')[0].reset();
                        alert('Pasien baru berhasil didaftarkan.');
                    },
                    error: function (err) {
                        alert('Gagal menyimpan data. Pastikan NIK belum terdaftar.');
                    },
                    complete: function () {
                        btn.attr('disabled', false).html('Simpan Pasien');
                    }
                });
            });

            // --- MEDICINE LOGIC ---
            $('#add_medicine').click(function () {
                const sel = $('#medicine_select');
                const qty = parseInt($('#medicine_qty').val());

                if (!sel.val() || qty <= 0) return;

                const selected = sel.select2('data')[0];
                const id = selected.id;

                if (medicineMap[id]) {
                    alert('Obat sudah ditambahkan');
                    return;
                }

                const name = selected.name;
                const price = parseInt(selected.price);
                const stock = parseInt(selected.stock);

                if (qty > stock) {
                    alert('Jumlah melebihi stok tersedia');
                    return;
                }

                const sub = price * qty;
                medicineMap[id] = { price, stock };

                const row = `
                        <tr data-id="${id}" data-price="${price}" data-stock="${stock}">
                            <td>
                                <div class="fw-bold text-gray-800">${name}</div>
                                <input type="hidden" name="medicines[${id}][medicine_id]" value="${id}">
                            </td>
                            <td class="text-center">
                                <input type="number" class="form-control form-control-sm text-center qty-input"
                                       name="medicines[${id}][quantity]" value="${qty}" min="1" max="${stock}">
                            </td>
                            <td class="text-end">${formatCurrency(price)}</td>
                            <td class="text-end fw-bold text-primary subtotal-cell" data-value="${sub}">
                                ${formatCurrency(sub)}
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-remove">
                                    <i class="ki-outline ki-cross fs-4"></i>
                                </button>
                            </td>
                        </tr>`;

                $('#medicine_table').append(row);
                medicineTotal += sub;
                sel.val(null).trigger('change');
                $('#medicine_qty').val(1);
                calculateAll();
            });

            $('#medicine_table').on('input', '.qty-input', function () {
                const row = $(this).closest('tr');
                const price = parseInt(row.data('price'));
                const stock = parseInt(row.data('stock'));
                let qty = parseInt($(this).val());

                if (!qty || qty < 1) qty = 1;
                if (qty > stock) qty = stock;
                $(this).val(qty);

                const oldSubtotal = parseInt(row.find('.subtotal-cell').data('value')) || 0;
                const newSubtotal = price * qty;

                medicineTotal = medicineTotal - oldSubtotal + newSubtotal;
                row.find('.subtotal-cell').text(formatCurrency(newSubtotal)).data('value', newSubtotal);
                calculateAll();
            });

            $('#medicine_table').on('click', '.btn-remove', function () {
                const row = $(this).closest('tr');
                const subtotal = parseInt(row.find('.subtotal-cell').data('value')) || 0;
                medicineTotal -= subtotal;
                delete medicineMap[row.data('id')];
                row.remove();
                calculateAll();
            });

            $('#doctor_fee, #additional_fee').on('input', calculateAll);

            calculateAll();
        });
    </script>
@endpush