<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pendapatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #000;
        }

        .header {
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 2px 0;
            font-size: 12px;
        }

        .line {
            border-top: 2px solid #000;
            margin: 10px 0 20px 0;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .period {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
        }

        table th {
            text-align: center;
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .summary {
            margin-top: 15px;
            width: 40%;
            float: right;
        }

        .summary td {
            padding: 5px;
        }

        .signature {
            margin-top: 80px;
            width: 100%;
        }

        .signature td {
            text-align: center;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        Jl. Kesehatan No. 123, Sintang, Kalimantan Barat, Indonesia<br>
        +62 123 456 789
    </div>

    <div class="line"></div>

    <div class="title">LAPORAN PENDAPATAN</div>
    <div class="period">
        Periode: {{ $start->format('d-m-Y') }} s/d {{ $end->format('d-m-Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Total Kunjungan</th>
                <th>Jasa Dokter</th>
                <th>Biaya Tambahan</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandVisits = 0;
                $grandDoctor = 0;
                $grandAdditional = 0;
                $grandRevenue = 0;
            @endphp

            @foreach($reports as $row)
                @php
                    $grandVisits += $row->total_visits;
                    $grandDoctor += $row->total_doctor_fee;
                    $grandAdditional += $row->total_additional_fee;
                    $grandRevenue += $row->total_revenue;
                @endphp
                <tr>
                    <td>{{ $row->date }}</td>
                    <td class="text-right">{{ $row->total_visits }}</td>
                    <td class="text-right">Rp {{ number_format($row->total_doctor_fee, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($row->total_additional_fee, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($row->total_revenue, 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <tr>
                <th>Total</th>
                <th class="text-right">{{ $grandVisits }}</th>
                <th class="text-right">Rp {{ number_format($grandDoctor, 0, ',', '.') }}</th>
                <th class="text-right">Rp {{ number_format($grandAdditional, 0, ',', '.') }}</th>
                <th class="text-right">Rp {{ number_format($grandRevenue, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <table class="signature">
        <tr>
            <td width="60%"></td>
            <td>
                {{ now()->format('d F Y') }}<br>
                Penanggung Jawab,
                <br><br><br><br>
                _______________________
            </td>
        </tr>
    </table>

</body>

</html>