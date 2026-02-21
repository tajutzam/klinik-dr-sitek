@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid">

        <div class="card card-flush mb-7">
            <div class="card-body d-flex flex-stack">

                <div>
                    <h2 class="fw-bold mb-1">Visit Detail</h2>
                    <div class="text-muted fs-7">
                        {{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y H:i') }}
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('visits.print', $visit->id) }}" target="_blank" class="btn btn-light-success btn-sm">
                        <i class="ki-outline ki-printer fs-4"></i>
                        Print Receipt
                    </a>

                    <a href="{{ route('visits.index') }}" class="btn btn-light btn-sm">
                        Back
                    </a>
                </div>

            </div>
        </div>


        <div class="row g-6 mb-7">

            <div class="col-md-6">
                <div class="card card-bordered">
                    <div class="card-header">
                        <h3 class="card-title fw-bold">Patient Information</h3>
                    </div>

                    <div class="card-body">

                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-outline ki-profile-circle fs-2 text-primary"></i>
                                </span>
                            </div>

                            <div>
                                <div class="fw-bold fs-5">
                                    {{ $visit->patient->name }}
                                </div>
                                <div class="text-muted fs-7">
                                    {{ $visit->patient->phone_number ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="separator separator-dashed mb-4"></div>

                        <div class="fs-7 text-gray-700">
                            <div class="mb-2">
                                <span class="fw-semibold">Address:</span>
                                {{ $visit->patient->address ?? '-' }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card card-bordered">
                    <div class="card-header">
                        <h3 class="card-title fw-bold">Doctor Information</h3>
                    </div>

                    <div class="card-body">

                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-outline ki-user fs-2 text-success"></i>
                                </span>
                            </div>

                            <div>
                                <div class="fw-bold fs-5">
                                    {{ $visit->creator->name }}
                                </div>
                                <div class="text-muted fs-7">
                                    Attending Doctor
                                </div>
                            </div>
                        </div>

                        <div class="separator separator-dashed mb-4"></div>

                        <div class="fs-7 text-gray-700">
                            <span class="fw-semibold">Visit Date:</span>
                            {{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y H:i') }}
                        </div>

                    </div>
                </div>
            </div>

        </div>


        {{-- ================= COST SUMMARY ================= --}}
        <div class="card card-flush mb-7">
            <div class="card-header">
                <h3 class="card-title fw-bold">Cost Summary</h3>
            </div>

            <div class="card-body">

                <div class="row g-6">

                    <div class="col-md-4">
                        <div class="border border-dashed border-gray-300 rounded p-5 text-center">
                            <div class="text-gray-500 fs-7">Doctor Fee</div>
                            <div class="fw-bold fs-3 text-primary">
                                Rp {{ number_format($visit->doctor_fee, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="border border-dashed border-gray-300 rounded p-5 text-center">
                            <div class="text-gray-500 fs-7">Additional Fee</div>
                            <div class="fw-bold fs-3 text-warning">
                                Rp {{ number_format($visit->additional_fee, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="border border-dashed border-success rounded p-5 text-center">
                            <div class="text-gray-500 fs-7">Total Cost</div>
                            <div class="fw-bold fs-2 text-success">
                                Rp {{ number_format($visit->total_cost, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        {{-- ================= MEDICINES ================= --}}
        <div class="card card-bordered mb-7">
            <div class="card-header">
                <h3 class="card-title fw-bold">Medicines</h3>
            </div>

            <div class="card-body pt-0">

                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-gray-400 fw-bold fs-7 text-uppercase">
                                <th>Medicine</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Subtotal</th>
                                <th>Instruction</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @forelse($visit->medicines as $item)
                                <tr>
                                    <td>{{ $item->medicine->medicine_name }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">
                                        Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end text-success">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $item->dosage_instruction ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500">
                                        No medicines used
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        {{-- ================= MEDICAL NOTES ================= --}}
        <div class="card card-bordered">
            <div class="card-header">
                <h3 class="card-title fw-bold">Medical Notes</h3>
            </div>

            <div class="card-body">

                <div class="mb-6">
                    <div class="text-gray-500 fs-7 mb-1">Complaints</div>
                    <div class="fw-semibold text-gray-800">
                        {{ $visit->complaints ?? '-' }}
                    </div>
                </div>

                <div class="separator separator-dashed mb-6"></div>

                <div class="mb-6">
                    <div class="text-gray-500 fs-7 mb-1">Diagnosis</div>
                    <div class="fw-semibold text-gray-800">
                        {{ $visit->diagnosis ?? '-' }}
                    </div>
                </div>

                <div class="separator separator-dashed mb-6"></div>

                <div class="mb-6">
                    <div class="text-gray-500 fs-7 mb-1">Treatment</div>
                    <div class="fw-semibold text-gray-800">
                        {{ $visit->treatment ?? '-' }}
                    </div>
                </div>

                <div class="separator separator-dashed mb-6"></div>

                <div>
                    <div class="text-gray-500 fs-7 mb-1">Additional Notes</div>
                    <div class="fw-semibold text-gray-800">
                        {{ $visit->notes ?? '-' }}
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection