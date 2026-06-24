<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #eee;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .total {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="title">
        <h2>LAPORAN PEMBAYARAN SPP</h2>

        <p>
            Bulan {{ request('bulan') }}
            Tahun {{ request('tahun') }}
        </p>
    </div>

    <table>

        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Siswa</th>
                <th>Periode</th>
                <th>Metode</th>
                <th>Jumlah</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($pembayarans as $item)
                <tr>

                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d/m/Y') }}
                    </td>

                    <td>
                        {{ $item->siswa->nama_siswa }}
                    </td>

                    <td>
                        {{ $item->billing->bulan }}
                        {{ $item->billing->tahun }}
                    </td>

                    <td>
                        {{ $item->metode_bayar }}
                    </td>

                    <td>
                        Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

    <div class="total">
        Total Pemasukan SPP :
        Rp {{ number_format($totalSPP, 0, ',', '.') }}
    </div>

</body>

</html>
