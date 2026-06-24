<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Laporan Pembayaran SPP
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Rekap pembayaran SPP berdasarkan periode.
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] p-6 mb-6">

            <form method="GET" action="{{ route('admin.laporan.spp') }}" class="grid md:grid-cols-4 gap-4">

                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Bulan
                    </label>

                    <select name="bulan" class="w-full rounded-2xl border-slate-200 bg-slate-50">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}"
                                {{ request('bulan', date('m')) == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Tahun
                    </label>

                    <select name="tahun" class="w-full rounded-2xl border-slate-200 bg-slate-50">

                        @for ($tahun = date('Y'); $tahun >= 2020; $tahun--)
                            <option value="{{ $tahun }}"
                                {{ request('tahun', date('Y')) == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endfor

                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full rounded-2xl bg-[#111827] text-white py-3 font-bold">
                        Filter
                    </button>
                </div>

                <div class="flex items-end">
                    <a href="{{ route('admin.laporan.spp.pdf', request()->all()) }}" target="_blank"
                        class="w-full text-center rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] py-3 font-bold text-[#111827]">
                        Export PDF
                    </a>
                </div>

            </form>
        </div>

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">

            <div class="p-6 border-b border-[#F5E7B2]">
                <h3 class="text-xl font-bold">
                    Data Pembayaran SPP
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Siswa</th>
                            <th class="px-6 py-4">Periode</th>
                            <th class="px-6 py-4">Metode</th>
                            <th class="px-6 py-4">Jumlah</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pembayarans as $item)
                            <tr class="border-b">

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item->siswa->nama_siswa }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item->billing->bulan }}
                                    {{ $item->billing->tahun }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ ucfirst($item->metode_bayar) }}
                                </td>

                                <td class="px-6 py-4 font-bold text-green-700">
                                    Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-slate-500">
                                    Tidak ada data
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

            <div class="p-6 bg-[#F8F6F0]">
                <h3 class="font-bold text-lg">
                    Total Pemasukan SPP :
                    Rp {{ number_format($totalSPP, 0, ',', '.') }}
                </h3>
            </div>

        </div>

    </div>
</x-app-layout>
