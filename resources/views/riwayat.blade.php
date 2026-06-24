<div class="bg-white rounded-3xl shadow">

    <div class="p-6 border-b">
        <h3 class="font-bold text-lg">
            Riwayat Pembayaran
        </h3>
    </div>

    <table class="w-full">

        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($histories as $history)
                <tr>

                    <td>
                        {{ $history->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td>
                        Rp {{ number_format($history->jumlah_bayar, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ ucfirst($history->metode_bayar) }}
                    </td>

                    <td>
                        {{ $history->keterangan }}
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

</div>
