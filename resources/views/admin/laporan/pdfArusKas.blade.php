<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Arus Kas</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111827;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header p {
            margin: 4px 0;
        }

        .info {
            margin-bottom: 15px;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
        }

        table th {
            background: #f3f4f6;
        }

        .text-right {
            text-align: right;
        }

        .total {
            font-weight: bold;
            background: #f9fafb;
        }

        .saldo {
            font-weight: bold;
            background: #d1fae5;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>LAPORAN ARUS KAS</h2>
        <p>SMP IT As-Sulthon</p>
    </div>

    <div class="info">
        <p>
            Periode :
            {{ $bulan ? date('F', mktime(0, 0, 0, $bulan, 1)) : 'Semua Bulan' }}
            -
            {{ $tahun ?? 'Semua Tahun' }}
        </p>

        <p>
            Dicetak :
            {{ now()->format('d-m-Y H:i') }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="50%">Keterangan</th>
                <th width="25%">Debit</th>
                <th width="25%">Kredit</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>Pemasukan SPP</td>
                <td class="text-right">
                    Rp {{ number_format($totalSPP, 0, ',', '.') }}
                </td>
                <td>-</td>
            </tr>

            <tr>
                <td>Pemasukan Lainnya</td>
                <td class="text-right">
                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                </td>
                <td>-</td>
            </tr>

            <tr>
                <td>Pengeluaran</td>
                <td>-</td>
                <td class="text-right">
                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </td>
            </tr>

            <tr class="total">
                <td>Total Debit</td>
                <td class="text-right">
                    Rp {{ number_format($totalSPP + $totalPemasukan, 0, ',', '.') }}
                </td>
                <td>-</td>
            </tr>

            <tr class="total">
                <td>Total Kredit</td>
                <td>-</td>
                <td class="text-right">
                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </td>
            </tr>

            <tr class="saldo">
                <td>Saldo Akhir</td>
                <td colspan="2" class="text-right">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </td>
            </tr>

        </tbody>
    </table>

    <br><br>

    <table style="border:none;">
        <tr>
            <td style="border:none; width:60%"></td>

            <td style="border:none; text-align:center;">
                Bandung, {{ now()->format('d F Y') }}
                <br><br><br><br>

                <strong>
                    Staff Keuangan
                </strong>
            </td>
        </tr>
    </table>

</body>

</html>
