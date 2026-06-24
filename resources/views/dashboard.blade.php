<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Dashboard Pembayaran SPP
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Informasi tagihan dan riwayat pembayaran siswa.
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HERO --}}
        @php
            $persenPembayaran = $totalTagihan > 0 ? min(100, ($totalDibayar / $totalTagihan) * 100) : 0;
        @endphp

        <div
            class="bg-gradient-to-br from-[#111827] via-[#1F2937] to-[#7A5C1E] rounded-[2rem] p-8 text-white shadow-2xl relative overflow-hidden mb-8">

            <div class="absolute -top-20 -right-20 w-72 h-72 bg-[#D4AF37]/20 rounded-full blur-3xl"></div>

            <div class="relative z-10 flex flex-col lg:flex-row justify-between gap-8">

                <div class="flex-1">

                    <p class="text-[#F5E7B2] font-semibold">
                        Assalamu’alaikum,
                    </p>

                    <h1 class="text-3xl font-bold mt-2">
                        {{ Auth::user()->name }}
                    </h1>

                    <div class="flex flex-wrap gap-3 mt-4">

                        <span class="bg-white/10 px-4 py-2 rounded-xl text-sm">
                            🎓 {{ $siswa->kelas->nama_kelas ?? '-' }}
                        </span>

                        @if ($totalTunggakan > 0)
                            <span class="bg-red-500/20 text-red-200 px-4 py-2 rounded-xl text-sm">
                                ⚠️ Ada Tunggakan
                            </span>
                        @else
                            <span class="bg-green-500/20 text-green-200 px-4 py-2 rounded-xl text-sm">
                                ✅ Semua Tagihan Lunas
                            </span>
                        @endif

                    </div>

                    <p class="mt-5 text-gray-200 max-w-2xl">
                        Pantau status pembayaran SPP, riwayat transaksi,
                        dan lakukan pembayaran secara online dengan mudah.
                    </p>

                    {{-- Progress --}}
                    <div class="mt-6 max-w-lg">

                        <div class="flex justify-between mb-2 text-sm">
                            <span>Progress Pembayaran</span>
                            <span>{{ number_format($persenPembayaran, 0) }}%</span>
                        </div>

                        <div class="w-full bg-white/20 rounded-full h-4">
                            <div class="bg-[#D4AF37] h-4 rounded-full transition-all duration-500"
                                style="width: {{ $persenPembayaran }}%">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="flex flex-col gap-4">

                    <div class="bg-white rounded-2xl p-4 shadow-lg">
                        <img src="{{ asset('images/logo-sekolah.png') }}" class="w-24 h-24 object-contain">
                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4">

                        <p class="text-sm text-[#F5E7B2]">
                            Total Tunggakan
                        </p>

                        <h3 class="text-2xl font-bold mt-1">
                            Rp {{ number_format($totalTunggakan, 0, ',', '.') }}
                        </h3>

                    </div>

                </div>

            </div>
        </div>

        {{-- SUMMARY --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">📄</div>
                <p class="text-sm text-slate-500">Total Tagihan</p>
                <h3 class="text-2xl font-bold text-[#111827] mt-1">
                    Rp {{ number_format($totalTagihan, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-green-200">
                <div class="text-3xl mb-3">✅</div>
                <p class="text-sm text-slate-500">Sudah Dibayar</p>
                <h3 class="text-2xl font-bold text-green-700 mt-1">
                    Rp {{ number_format($totalDibayar, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-red-200">
                <div class="text-3xl mb-3">⚠️</div>
                <p class="text-sm text-slate-500">Tunggakan</p>
                <h3 class="text-2xl font-bold text-red-700 mt-1">
                    Rp {{ number_format($totalTunggakan, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-yellow-200">
                <div class="text-3xl mb-3">📌</div>
                <p class="text-sm text-slate-500">Belum Lunas</p>
                <h3 class="text-2xl font-bold text-[#7A5C1E] mt-1">
                    {{ $jumlahBelumLunas }} Tagihan
                </h3>
            </div>

        </div>

        <div class="grid md:grid-cols-3 gap-4 mb-8">

            <a href="#tagihan"
                class="bg-white border border-[#F5E7B2] rounded-2xl p-5 shadow hover:shadow-lg transition">

                <div class="text-3xl mb-2">💳</div>

                <h4 class="font-bold text-[#111827]">
                    Bayar Tagihan
                </h4>

                <p class="text-sm text-slate-500 mt-1">
                    Lihat tagihan yang belum lunas.
                </p>

            </a>

            <a href="#history"
                class="bg-white border border-[#F5E7B2] rounded-2xl p-5 shadow hover:shadow-lg transition">

                <div class="text-3xl mb-2">📜</div>

                <h4 class="font-bold text-[#111827]">
                    Riwayat Pembayaran
                </h4>

                <p class="text-sm text-slate-500 mt-1">
                    Lihat histori transaksi pembayaran.
                </p>

            </a>

            <div class="bg-white border border-[#F5E7B2] rounded-2xl p-5 shadow">

                <div class="text-3xl mb-2">📱</div>

                <h4 class="font-bold text-[#111827]">
                    Bukti Pembayaran
                </h4>

                <p class="text-sm text-slate-500 mt-1">
                    Dikirim otomatis ke WhatsApp wali siswa.
                </p>

            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- TAGIHAN --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow border border-[#F5E7B2]">

                <div class="p-6 border-b border-[#F5E7B2]">
                    <h3 class="text-lg font-bold text-[#111827]">
                        Tagihan Yang Harus Dibayar
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">

                        <thead class="bg-[#111827] text-white">
                            <tr>
                                <th class="px-6 py-4 text-left">Periode</th>
                                <th class="px-6 py-4 text-left">Tagihan</th>
                                <th class="px-6 py-4 text-left">Sisa</th>
                                <th class="px-6 py-4 text-left">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($tunggakan as $billing)
                                <tr>

                                    <td class="px-6 py-4">
                                        {{ $billing->bulan }} {{ $billing->tahun }}
                                    </td>

                                    <td class="px-6 py-4">
                                        Rp {{ number_format($billing->jumlah_tagihan, 0, ',', '.') }}
                                    </td>

                                    <td class="px-6 py-4 text-red-700 font-bold">
                                        Rp {{ number_format($billing->sisa_tagihan, 0, ',', '.') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold">
                                            {{ ucfirst($billing->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">

                                        <a href="{{ route('admin.billing.pay-online', $billing->id) }}"
                                            class="inline-flex px-4 py-2 rounded-xl bg-purple-100 text-purple-700 font-semibold hover:bg-purple-200">
                                            Bayar
                                        </a>

                                    </td>

                                </tr>
                            @empty

                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-green-600 font-semibold">
                                        🎉 Semua tagihan sudah lunas
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
            </div>

            {{-- INFO --}}
            <div class="bg-white rounded-2xl shadow border border-[#F5E7B2] p-6">

                <h3 class="text-lg font-bold text-[#111827] mb-4">
                    Informasi Pembayaran
                </h3>

                <div class="space-y-4 text-sm">

                    <div class="flex gap-3">
                        <span>💳</span>
                        <p class="text-slate-600">
                            Pembayaran online menggunakan Midtrans.
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <span>📱</span>
                        <p class="text-slate-600">
                            Bukti pembayaran akan dikirim otomatis ke WhatsApp.
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <span>📌</span>
                        <p class="text-slate-600">
                            Pastikan pembayaran dilakukan sebelum jatuh tempo.
                        </p>
                    </div>

                </div>

            </div>

        </div>

        {{-- HISTORY --}}
        <div class="bg-white rounded-2xl shadow border border-[#F5E7B2] mt-8 overflow-hidden">

            <div class="p-6 border-b border-[#F5E7B2]">
                <h3 class="text-lg font-bold text-[#111827]">
                    Riwayat Pembayaran
                </h3>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">Tanggal</th>
                            <th class="px-6 py-4 text-left">Jumlah</th>
                            <th class="px-6 py-4 text-left">Metode</th>
                            <th class="px-6 py-4 text-left">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($histories as $history)
                            <tr>

                                <td class="px-6 py-4">
                                    {{ $history->created_at->format('d M Y H:i') }}
                                </td>

                                <td class="px-6 py-4 text-green-700 font-semibold">
                                    Rp {{ number_format($history->jumlah_bayar, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ ucfirst($history->metode_bayar) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $history->keterangan }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                                    Belum ada riwayat pembayaran.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</x-app-layout>
