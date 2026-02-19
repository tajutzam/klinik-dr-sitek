@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-lg-4">

    <div class="d-flex align-items-baseline justify-content-between mb-6">
        <h1 class="h3 fw-bold text-gray-800">Registrasi Kunjungan Baru</h1>
        <a href="{{ route('visits.index') }}" class="btn btn-sm btn-light text-muted">Batal</a>
    </div>

    <form action="{{ route('visits.store') }}" method="POST" id="visitForm">
        @csrf
        <div class="row g-7">

            <!-- LEFT -->
            <div class="col-xl-8">

                <!-- DATA PASIEN -->
                <div class="card border-0 shadow-sm mb-6">
                    <div class="card-body p-7">
                        <div class="row g-4">

                            <div class="col-12 mb-2">
                                <label class="form-label fw-bold text-gray-700">Pasien</label>
                                <select name="patient_id" id="patient_select"
                                    class="form-select bg-light border-0" required>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-gray-700">Biaya Dokter</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">Rp</span>
                                    <input type="number" name="doctor_fee" id="doctor_fee"
                                        class="form-control border-start-0 ps-0" value="50000">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-gray-700">Biaya Lainnya</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">Rp</span>
                                    <input type="number" name="additional_fee" id="additional_fee"
                                        class="form-control border-start-0 ps-0" value="0">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold text-gray-700">Keluhan Pasien</label>
                                <textarea name="complaints" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold text-gray-700">Diagnosa / Catatan Medis</label>
                                <textarea name="diagnosis" class="form-control" rows="2"></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- OBAT -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 pt-6 px-7">
                        <h3 class="card-title fw-bold text-gray-800 fs-5">Resep & Obat</h3>
                    </div>
                    <div class="card-body p-7 pt-2">

                        <div class="row g-3 align-items-end mb-6 bg-light p-4 rounded">
                            <div class="col-md-7">
                                <label class="form-label small fw-bold text-muted">Cari Obat</label>
                                <select id="medicine_select" class="form-select border-gray-300">
                                    <option value="">-- Pilih item --</option>
                                    @foreach ($medicines as $medicine)
                                        <option value="{{ $medicine->id }}"
                                            data-price="{{ $medicine->price }}"
                                            data-name="{{ $medicine->medicine_name }}"
                                            {{ $medicine->stock <= 0 ? 'disabled' : '' }}>
                                            {{ $medicine->medicine_name }} (Sisa: {{ $medicine->stock }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 col-8">
                                <label class="form-label small fw-bold text-muted">Jumlah</label>
                                <input type="number" id="medicine_qty"
                                    class="form-control border-gray-300"
                                    value="1" min="1">
                            </div>

                            <div class="col-md-2 col-4">
                                <button type="button" id="add_medicine"
                                    class="btn btn-dark w-100">Tambah</button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr class="text-muted fs-7 text-uppercase">
                                        <th class="ps-3">Item Obat</th>
                                        <th width="100">Qty</th>
                                        <th width="150">Harga</th>
                                        <th width="150">Subtotal</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody id="medicine_table"></tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-xl-4">
                <div class="card border-0 shadow-sm sticky-top" style="top:100px">
                    <div class="card-body p-7">
                        <h3 class="fw-bold text-gray-800 mb-6 fs-5">Rincian Pembayaran</h3>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-muted">Jasa Konsultasi</span>
                            <span id="doctor_display">Rp 0</span>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-muted">Tindakan/Lainnya</span>
                            <span id="additional_display">Rp 0</span>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-muted">Total Obat-obatan</span>
                            <span id="medicine_total">Rp 0</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <span class="fw-bold">Total Akhir</span>
                            <span class="fw-bolder text-primary fs-3" id="grand_total">Rp 0</span>
                        </div>

                        <input type="hidden" name="total_cost" id="total_cost">

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                            Konfirmasi & Simpan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection


@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    $('#patient_select').select2({
        placeholder: 'Cari nama atau nomor telepon...',
        allowClear: true,
        ajax: {
            url: '{{ route("ajax.patients") }}',
            dataType: 'json',
            delay: 300,
            data: function(params) {
                return { q: params.term };
            },
            processResults: function(data) {
                return { results: data };
            }
        }
    });

    let medicineTotal = 0;

    const formatCurrency = (num) =>
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

    $('#add_medicine').click(function() {

        const sel = $('#medicine_select');
        const qty = parseInt($('#medicine_qty').val());

        if (!sel.val() || qty <= 0) return;

        const opt = sel.find(':selected');
        const id = sel.val();
        const name = opt.data('name');
        const price = parseInt(opt.data('price'));
        const sub = price * qty;

        const row = `
        <tr data-subtotal="${sub}">
            <td class="ps-3">
                <div class="fw-bold">${name}</div>
                <input type="hidden" name="medicines[${id}][medicine_id]" value="${id}">
            </td>
            <td>
                <span class="badge bg-light text-dark border">${qty}</span>
                <input type="hidden" name="medicines[${id}][quantity]" value="${qty}">
            </td>
            <td>${formatCurrency(price)}</td>
            <td class="fw-bold">${formatCurrency(sub)}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-light-danger btn-remove">
                    <i class="bi bi-x-lg"></i>
                </button>
            </td>
        </tr>`;

        $('#medicine_table').append(row);

        medicineTotal += sub;
        sel.val('');
        $('#medicine_qty').val(1);
        calculateAll();
    });

    $('#medicine_table').on('click', '.btn-remove', function() {
        const row = $(this).closest('tr');
        medicineTotal -= parseInt(row.data('subtotal'));
        row.remove();
        calculateAll();
    });

    $('#doctor_fee, #additional_fee').on('input', calculateAll);

    calculateAll();
});
</script>
@endpush
