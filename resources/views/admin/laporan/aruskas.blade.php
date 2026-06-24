<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Laporan Arus Kas
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Rekap pemasukan dan pengeluaran.
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid md:grid-cols-3 gap-6 mb-6">

            <div class="bg-white rounded-2xl p-6 border border-[#F5E7B2] shadow">
                <p class="text-sm text-slate-500">Pemasukan SPP</p>

                <h3 class="text-2xl font-bold text-green-600 mt-2">
                    Rp {{ number_format($totalSPP, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-[#F5E7B2] shadow">
                <p class="text-sm text-slate-500">Pemasukan Lain</p>

                <h3 class="text-2xl font-bold text-blue-600 mt-2">
                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-[#F5E7B2] shadow">
                <p class="text-sm text-slate-500">Pengeluaran</p>

                <h3 class="text-2xl font-bold text-red-600 mt-2">
                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </h3>
            </div>

        </div>

        <div class="bg-white rounded-2xl shadow border border-[#F5E7B2] p-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h3 class="text-xl font-bold text-[#111827]">
                        Saldo Akhir
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Hasil akumulasi pemasukan dan pengeluaran pada periode yang dipilih.
                    </p>

                    <div class="text-4xl font-bold text-[#7A5C1E] mt-4">
                        Rp {{ number_format($saldo, 0, ',', '.') }}
                    </div>
                </div>

                <div>
                    <a href="{{ route('admin.laporan.aruskas.pdf', [
                        'bulan' => request('bulan'),
                        'tahun' => request('tahun'),
                    ]) }}"
                        target="_blank"
                        class="rounded-2xl bg-red-600 px-5 py-3 text-white font-semibold hover:bg-red-700">
                        📄 Export PDF
                    </a>
                </div>

            </div>

        </div>

    </div>
</x-app-layout>
