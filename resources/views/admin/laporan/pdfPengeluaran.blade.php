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
            padding: 8px;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>

    <h2>Laporan Pengeluaran</h2>

    <p>
        Periode :
        {{ $bulan ?: 'Semua Bulan' }}
        /
        {{ $tahun ?: 'Semua Tahun' }}
    </p>

    <table>

        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>

    <h3>
        Total :
        Rp {{ number_format($total, 0, ',', '.') }}
    </h3>

</body>

</html>
