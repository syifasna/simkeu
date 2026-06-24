<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Dashboard Keuangan
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Sistem Manajemen Keuangan SMP IT As-Sulthon
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div
            class="bg-gradient-to-br from-[#111827] via-[#1F2937] to-[#7A5C1E] rounded-[2rem] p-8 text-white shadow-2xl relative overflow-hidden mb-8">
            <div class="absolute -top-20 -right-20 w-72 h-72 bg-[#D4AF37]/20 rounded-full blur-3xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <p class="text-[#F5E7B2] font-semibold">
                        Assalamu’alaikum, {{ Auth::user()->name }}
                    </p>

                    <h1 class="text-3xl font-bold mt-2">
                        Selamat Datang di Sistem Keuangan
                    </h1>

                    <p class="text-gray-200 mt-3 max-w-2xl">
                        Kelola pembayaran siswa, pemasukan, pengeluaran, dan laporan keuangan sekolah secara aman dan
                        terstruktur.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-3 shadow-lg">
                    <img src="{{ asset('images/logo-sekolah.png') }}" class="w-24 h-24 object-contain" alt="Logo">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-8">

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">💳</div>
                <p class="text-sm text-slate-500">
                    Total Tagihan SPP
                </p>

                <h3 class="text-xl font-bold text-[#111827] mt-2">
                    Rp {{ number_format($totalTagihanSPP, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">✅</div>
                <p class="text-sm text-slate-500">
                    Pembayaran SPP
                </p>

                <h3 class="text-xl font-bold text-green-600 mt-2">
                    Rp {{ number_format($totalPembayaranSPP, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">📥</div>
                <p class="text-sm text-slate-500">
                    Pemasukan Lain
                </p>

                <h3 class="text-xl font-bold text-blue-600 mt-2">
                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">📤</div>
                <p class="text-sm text-slate-500">
                    Pengeluaran
                </p>

                <h3 class="text-xl font-bold text-red-600 mt-2">
                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </h3>
            </div>

            <div
                class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2] bg-gradient-to-r from-[#D4AF37]/10 to-[#F5E7B2]/20">
                <div class="text-3xl mb-3">💰</div>
                <p class="text-sm text-slate-500">
                    Saldo Sekolah
                </p>

                <h3 class="text-xl font-bold text-[#7A5C1E] mt-2">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">⚠️</div>

                <p class="text-sm text-slate-500">
                    Tunggakan SPP
                </p>

                <h3 class="text-xl font-bold text-red-600 mt-2">
                    Rp {{ number_format($totalTunggakanSPP, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">⚠️</div>

                <p class="text-sm text-slate-500">
                    👨‍🎓 Siswa Menunggak
                </p>

                <h3 class="text-xl font-bold text-red-600 mt-2">
                    {{ $jumlahSiswaMenunggak }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">⚠️</div>

                <p class="text-sm text-slate-500">
                    📅 Pembayaran Bulan Ini
                </p>

                <h3 class="text-xl font-bold text-red-600 mt-2">
                    Rp {{ number_format($pembayaranBulanIni, 0, ',', '.') }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">⚠️</div>

                <p class="text-sm text-slate-500">
                    📤 Pengeluaran Bulan Ini
                </p>

                <h3 class="text-xl font-bold text-red-600 mt-2">
                    Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}
                </h3>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-2xl shadow border border-[#F5E7B2] p-6">
                <h3 class="text-lg font-bold mb-4">
                    Grafik Status Tagihan
                </h3>

                <div class="h-100">
                    <canvas id="billingChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow border border-[#F5E7B2] p-6">
                <h3 class="text-lg font-bold mb-4">
                    Arus Keuangan
                </h3>

                <div class="h-[280px]">
                    <canvas id="financeChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow border border-[#F5E7B2] p-6">
                <h3 class="text-lg font-bold text-[#111827] mb-4">
                    Ringkasan Tagihan
                </h3>

                <div class="space-y-4">

                    <div class="flex justify-between">
                        <span>✅ Tagihan Lunas</span>
                        <span class="font-bold text-green-600">
                            {{ $jumlahLunas }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>❌ Belum Lunas</span>
                        <span class="font-bold text-red-600">
                            {{ $jumlahBelumLunas }}
                        </span>
                    </div>

                    <hr>

                    <div class="flex justify-between">
                        <span>💳 Total Tagihan</span>
                        <span class="font-bold">
                            Rp {{ number_format($totalTagihanSPP, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>💵 Total Pembayaran</span>
                        <span class="font-bold text-green-600">
                            Rp {{ number_format($totalPembayaranSPP, 0, ',', '.') }}
                        </span>
                    </div>

                    <hr>
                    <h3 class="text-lg font-bold text-[#111827] mb-4">
                        Progress Pembayaran SPP
                    </h3>
                    <div class="flex justify-between">
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-green-600 h-4 rounded-full" style="width: {{ $persentasePembayaran }}%">
                            </div>
                        </div>

                        <p class="text-sm mt-2">
                            {{ number_format($persentasePembayaran, 1) }}%
                        </p>
                    </div>

                </div>
            </div>

        </div>

        <div class="bg-white rounded-2xl shadow border border-[#F5E7B2] p-6 mb-8">
            <h3 class="text-lg font-bold text-[#111827] mb-4">
                Tagihan Terbaru
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Siswa</th>
                            <th class="px-4 py-3 text-left">Periode</th>
                            <th class="px-4 py-3 text-left">Tagihan</th>
                            <th class="px-4 py-3 text-left">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($billingTerbaru as $billing)
                            <tr class="border-b">
                                <td class="px-4 py-3">
                                    {{ $billing->siswa->nama_siswa }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $billing->bulan }}
                                    {{ $billing->tahun }}
                                </td>

                                <td class="px-4 py-3">
                                    Rp {{ number_format($billing->jumlah_tagihan, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3">

                                    @if ($billing->status == 'lunas')
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                                            Lunas
                                        </span>
                                    @elseif($billing->status == 'sebagian')
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white rounded-2xl shadow border border-[#F5E7B2] p-6">
                <h3 class="text-lg font-bold text-[#111827] mb-4">
                    Menu Utama
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2]">
                        <div class="text-2xl mb-2">💳</div>
                        <h4 class="font-bold text-[#111827]">Pembayaran Siswa</h4>
                        <p class="text-sm text-slate-500 mt-1">Kelola tagihan dan pembayaran siswa.</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2]">
                        <div class="text-2xl mb-2">📥</div>
                        <h4 class="font-bold text-[#111827]">Pemasukan</h4>
                        <p class="text-sm text-slate-500 mt-1">Catat pemasukan sekolah.</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2]">
                        <div class="text-2xl mb-2">📤</div>
                        <h4 class="font-bold text-[#111827]">Pengeluaran</h4>
                        <p class="text-sm text-slate-500 mt-1">Catat kebutuhan dan biaya sekolah.</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2]">
                        <div class="text-2xl mb-2">📄</div>
                        <h4 class="font-bold text-[#111827]">Laporan</h4>
                        <p class="text-sm text-slate-500 mt-1">Lihat laporan keuangan sekolah.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow border border-[#F5E7B2] p-6">
                <h3 class="text-lg font-bold text-[#111827] mb-4">
                    Informasi Sistem
                </h3>

                <div class="space-y-4 text-sm">
                    <div class="flex gap-3">
                        <span>🔐</span>
                        <p class="text-slate-600">Data keuangan hanya dapat diakses pengguna resmi.</p>
                    </div>

                    <div class="flex gap-3">
                        <span>🏫</span>
                        <p class="text-slate-600">Sistem digunakan untuk pengelolaan keuangan SMP IT As-Sulthon.</p>
                    </div>

                    <div class="flex gap-3">
                        <span>📌</span>
                        <p class="text-slate-600">Pastikan setiap transaksi dicatat dengan benar.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('billingChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Lunas', 'Belum Lunas'],
                datasets: [{
                    data: [
                        {{ $jumlahLunas }},
                        {{ $jumlahBelumLunas }}
                    ],
                    backgroundColor: [
                        '#16a34a',
                        '#dc2626'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        const financeCtx = document.getElementById('financeChart');

        new Chart(financeCtx, {
            type: 'bar',
            data: {
                labels: [
                    'SPP',
                    'Pemasukan',
                    'Pengeluaran'
                ],
                datasets: [{
                    data: [
                        {{ $totalPembayaranSPP }},
                        {{ $totalPemasukan }},
                        {{ $totalPengeluaran }}
                    ]
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</x-app-layout>
