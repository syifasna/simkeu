<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-2xl text-[#111827]">
            Laporan Pemasukan
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4">

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2]">

            <div class="p-6 border-b">

                <form method="GET" class="grid md:grid-cols-4 gap-4">

                    <select name="bulan" class="rounded-xl">
                        <option value="">Semua Bulan</option>

                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>

                    <select name="tahun" class="rounded-xl">
                        <option value="">Semua Tahun</option>

                        @for ($t = date('Y'); $t >= 2024; $t--)
                            <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                                {{ $t }}
                            </option>
                        @endfor
                    </select>

                    <button class="bg-[#D4AF37] rounded-xl px-4 py-2 font-bold">
                        Filter
                    </button>

                    <a href="{{ route('admin.pemasukan.laporan.pdf', request()->all()) }}"
                        class="bg-red-600 text-white rounded-xl px-4 py-2 text-center font-bold">
                        Export PDF
                    </a>

                </form>

            </div>

            <div class="p-6">
                <div class="bg-green-50 border border-green-200 rounded-2xl p-5 mb-6">
                    <p>Total Pemasukan</p>

                    <h3 class="text-3xl font-bold text-green-600">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </h3>
                </div>

                <table class="w-full text-sm">
                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Keterangan</th>
                            <th class="px-4 py-3">Jumlah</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pemasukans as $item)
                            <tr class="border-b">
                                <td class="px-4 py-3">{{ $item->tanggal }}</td>
                                <td class="px-4 py-3">{{ $item->keterangan }}</td>
                                <td class="px-4 py-3">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-5">
                    {{ $pemasukans->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
