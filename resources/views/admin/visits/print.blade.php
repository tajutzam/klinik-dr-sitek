<!DOCTYPE html>
<html>

<head>
    <title>Receipt</title>
    <style>
        body {
            font-family: monospace;
            font-size: 13px;
            width: 300px;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .bold {
            font-weight: bold;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        .small {
            font-size: 12px;
        }

        @media print {
            body {
                width: 100%;
            }
        }
    </style>
</head>

<body onload="window.print()">

    {{-- ======= HEADER ======= --}}
    <div class="text-center bold">
        CLINIC NAME
    </div>

    <div class="text-center small">
        Jl. Kesehatan No. 123, Sintang, Kalimantan Barat, Indonesia<br>
        +62 123 456 789
    </div>

    <hr>

    <div class="row small">
        <div>No:</div>
        <div>#{{ str_pad($visit->id, 6, '0', STR_PAD_LEFT) }}</div>
    </div>

    <div class="row small">
        <div>Date:</div>
        <div>{{ \Carbon\Carbon::parse($visit->visit_date)->format('d/m/Y H:i') }}</div>
    </div>

    <div class="row small">
        <div>Patient:</div>
        <div>{{ $visit->patient->name }}</div>
    </div>

    <hr>

    {{-- ======= MEDICINES ======= --}}
    @foreach($visit->medicines as $item)

        <div class="bold">
            {{ $item->medicine->medicine_name }}
        </div>

        <div class="row small">
            <div>
                {{ $item->quantity }} x Rp {{ number_format($item->unit_price, 0, ',', '.') }}
            </div>
            <div>
                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
            </div>
        </div>

        @if($item->dosage_instruction)
            <div class="small">
                * {{ $item->dosage_instruction }}
            </div>
        @endif

        <hr>

    @endforeach

    {{-- ======= COST SUMMARY ======= --}}
    <div class="row small">
        <div>Doctor Fee</div>
        <div>Rp {{ number_format($visit->doctor_fee, 0, ',', '.') }}</div>
    </div>

    <div class="row small">
        <div>Additional</div>
        <div>Rp {{ number_format($visit->additional_fee, 0, ',', '.') }}</div>
    </div>

    <hr>

    <div class="row bold">
        <div>TOTAL</div>
        <div>Rp {{ number_format($visit->total_cost, 0, ',', '.') }}</div>
    </div>

    <hr>

    <div class="text-center small">
        Thank you for your visit
    </div>

</body>

</html>