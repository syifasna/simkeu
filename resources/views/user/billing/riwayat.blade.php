<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Riwayat Pembayaran
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Seluruh transaksi pembayaran SPP.
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">
            <div class="p-6 border-b border-[#F5E7B2]">
                <h3 class="text-xl font-bold text-[#111827]">
                    Riwayat Tagihan yang telah Dibayar
                </h3>
            </div>


            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Periode</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Metode</th>
                            <th class="px-6 py-4">Keterangan</th>
                            <th class="px-6 py-4">Status Pembayarn</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pembayarans as $p)
                            <tr class="border-b">

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y H:i') }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $p->billing->bulan }}
                                    {{ $p->billing->tahun }}
                                </td>

                                <td class="px-6 py-4 text-green-700 font-semibold text-center">
                                    Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ ucfirst($p->metode_bayar) }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $p->keterangan }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($p->billing->status == 'lunas')
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                                            Lunas
                                        </span>
                                    @elseif($p->billing->status == 'sebagian')
                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                            Sebagian
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                                            Belum Lunas
                                        </span>
                                    @endif
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-8">
                                    Belum ada pembayaran.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

            <div class="p-6">
                {{ $pembayarans->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
