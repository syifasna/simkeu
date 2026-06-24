<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Data Tagihan SPP
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Kelola tagihan dan pembayaran SPP siswa SMP IT As-Sulthon.
            </p>
        </div>
    </x-slot>



    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- SUMMARY CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
            <div class="rounded-[2rem] bg-white border border-[#F5E7B2] shadow p-6">
                <p class="text-sm text-slate-500">Total Tagihan</p>
                <h3 class="text-2xl font-bold text-[#111827] mt-2">
                    Rp {{ number_format($totalTagihan, 0, ',', '.') }}
                </h3>
            </div>

            <div class="rounded-[2rem] bg-white border border-green-200 shadow p-6">
                <p class="text-sm text-slate-500">Sudah Dibayar</p>
                <h3 class="text-2xl font-bold text-green-700 mt-2">
                    Rp {{ number_format($totalDibayar, 0, ',', '.') }}
                </h3>
            </div>

            <div class="rounded-[2rem] bg-white border border-red-200 shadow p-6">
                <p class="text-sm text-slate-500">Tunggakan</p>
                <h3 class="text-2xl font-bold text-red-700 mt-2">
                    Rp {{ number_format($totalTunggakan, 0, ',', '.') }}
                </h3>
            </div>

            <div class="rounded-[2rem] bg-white border border-yellow-200 shadow p-6">
                <p class="text-sm text-slate-500">Siswa Menunggak</p>
                <h3 class="text-2xl font-bold text-[#7A5C1E] mt-2">
                    {{ $siswaMenunggak }} Siswa
                </h3>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] p-6 mb-6">
            <form method="GET" action="{{ route('admin.billing.index') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Cari Siswa</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama / NIS"
                        class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Bulan</label>
                    <select name="bulan"
                        class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        <option value="">Semua Bulan</option>
                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                            <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                                {{ $bulan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tahun</label>
                    <input type="number" name="tahun" value="{{ request('tahun') }}" placeholder="Contoh: 2026"
                        class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="w-full rounded-2xl bg-[#111827] px-5 py-3 text-white font-bold hover:opacity-90">
                        Filter
                    </button>

                    <a href="{{ route('admin.billing.index') }}"
                        class="rounded-2xl bg-slate-100 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-200">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">

            <div
                class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-[#F5E7B2]">
                <div>
                    <h3 class="text-xl font-bold text-[#111827]">
                        Daftar Tagihan
                    </h3>
                    <p class="text-sm text-slate-500">
                        Data tagihan SPP berdasarkan bulan dan tahun.
                    </p>
                </div>

                <a href="{{ route('admin.billing.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-5 py-3 text-[#111827] font-bold shadow hover:opacity-90 transition">
                    + Generate Tagihan
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Siswa</th>
                            <th class="px-6 py-4 text-left">Kelas</th>
                            <th class="px-6 py-4 text-left">Periode</th>
                            <th class="px-6 py-4 text-left">Tagihan</th>
                            <th class="px-6 py-4 text-left">Dibayar</th>
                            <th class="px-6 py-4 text-left">Sisa</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($billings as $billing)
                            <tr class="hover:bg-[#F8F6F0] transition">
                                <td class="px-6 py-4">{{ ++$i }}</td>

                                <td class="px-6 py-4 font-semibold text-[#111827]">
                                    {{ $billing->siswa->nama_siswa ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $billing->kelas->nama_kelas ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $billing->bulan }} {{ $billing->tahun }}
                                </td>

                                <td class="px-6 py-4">
                                    Rp {{ number_format($billing->jumlah_tagihan, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-green-700 font-semibold">
                                    Rp {{ number_format($billing->jumlah_dibayar, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-red-700 font-semibold">
                                    Rp {{ number_format($billing->sisa_tagihan, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($billing->status == 'lunas')
                                        <div class="flex flex-col gap-1">
                                            <span
                                                class="inline-flex w-fit whitespace-nowrap px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
                                                Lunas
                                            </span>

                                            @php
                                                $lastPayment = $billing->pembayarans
                                                    ->sortByDesc('tanggal_bayar')
                                                    ->first();
                                            @endphp

                                            @if ($lastPayment)
                                                <span class="text-xs text-slate-500">
                                                    Dibayar:
                                                    {{ \Carbon\Carbon::parse($lastPayment->created_at)->format('d M Y H:i:s') }}
                                                </span>
                                            @endif
                                        </div>
                                    @elseif ($billing->status == 'sebagian')
                                        <div class="flex flex-col gap-1">
                                            <span
                                                class="inline-flex w-fit whitespace-nowrap px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                                                Sebagian
                                            </span>

                                            @php
                                                $lastPayment = $billing->pembayarans
                                                    ->sortByDesc('tanggal_bayar')
                                                    ->first();
                                            @endphp

                                            @if ($lastPayment)
                                                <span class="text-xs text-slate-500">
                                                    Terakhir:
                                                    {{ \Carbon\Carbon::parse($lastPayment->tanggal_bayar)->format('d/m/Y') }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span
                                            class="inline-flex whitespace-nowrap px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold">
                                            Belum Lunas
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">

                                        <button type="button" onclick="openModal('modal-detail-{{ $billing->id }}')"
                                            class="rounded-xl bg-blue-50 px-4 py-2 text-blue-700 font-semibold hover:bg-blue-100">
                                            Detail
                                        </button>

                                        @if ($billing->status != 'lunas')
                                            <button type="button"
                                                onclick="openModal('modal-bayar-{{ $billing->id }}')"
                                                class="rounded-xl bg-green-50 px-4 py-2 text-green-700 font-semibold hover:bg-green-100">
                                                Bayar
                                            </button>
                                        @endif

                                        @if ($billing->status != 'lunas')
                                            <a href="{{ route('admin.billing.pay-online', $billing->id) }}"
                                                class="rounded-xl bg-purple-50 px-4 py-2 text-purple-700 font-semibold hover:bg-purple-100">
                                                Bayar Online
                                            </a>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-10 text-center text-slate-500">
                                    Belum ada data tagihan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-[#F5E7B2]">
                {{ $billings->links() }}
            </div>
        </div>
    </div>

    @foreach ($billings as $billing)
        {{-- MODAL DETAIL --}}
        <div id="modal-detail-{{ $billing->id }}" onclick="closeModal('modal-detail-{{ $billing->id }}')"
            class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4 py-6 opacity-0 transition-opacity duration-300">

            <div onclick="event.stopPropagation()"
                class="modal-box w-full max-w-2xl max-h-[90vh] rounded-[2rem] bg-white shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 flex flex-col">

                <div class="bg-gradient-to-r from-[#111827] to-[#7A5C1E] p-6 text-white shrink-0">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold">Detail Tagihan</h3>
                            <p class="text-sm text-[#F5E7B2]">Informasi tagihan SPP siswa</p>
                        </div>

                        <button type="button" onclick="closeModal('modal-detail-{{ $billing->id }}')"
                            class="text-white text-2xl">×</button>
                    </div>
                </div>

                <div class="p-6 grid md:grid-cols-2 gap-4 overflow-y-auto">
                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Nama Siswa</p>
                        <p class="font-bold text-[#111827] mt-1">{{ $billing->siswa->nama_siswa ?? '-' }}</p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Kelas</p>
                        <p class="font-bold text-[#111827] mt-1">{{ $billing->kelas->nama_kelas ?? '-' }}</p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Periode</p>
                        <p class="font-bold text-[#111827] mt-1">{{ $billing->bulan }} {{ $billing->tahun }}</p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Status</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ str_replace('_', ' ', ucfirst($billing->status)) }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Jumlah Tagihan</p>
                        <p class="font-bold text-[#111827] mt-1">Rp
                            {{ number_format($billing->jumlah_tagihan, 0, ',', '.') }}</p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Jumlah Dibayar</p>
                        <p class="font-bold text-green-700 mt-1">Rp
                            {{ number_format($billing->jumlah_dibayar, 0, ',', '.') }}</p>
                    </div>

                    <div class="md:col-span-2 rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Sisa Tagihan</p>
                        <p class="font-bold text-red-700 mt-1">Rp
                            {{ number_format($billing->sisa_tagihan, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="p-6 border-t bg-slate-50 flex justify-end shrink-0">
                    <button type="button" onclick="closeModal('modal-detail-{{ $billing->id }}')"
                        class="rounded-2xl bg-[#111827] px-5 py-2.5 text-white font-semibold">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        {{-- MODAL BAYAR --}}
        <div id="modal-bayar-{{ $billing->id }}" onclick="closeModal('modal-bayar-{{ $billing->id }}')"
            class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4 py-6 opacity-0 transition-opacity duration-300">

            <div onclick="event.stopPropagation()"
                class="modal-box w-full max-w-xl rounded-[2rem] bg-white shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300">

                <div class="bg-gradient-to-r from-[#111827] to-[#7A5C1E] p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold">Input Pembayaran</h3>
                            <p class="text-sm text-[#F5E7B2]">
                                {{ $billing->siswa->nama_siswa ?? '-' }} - {{ $billing->bulan }}
                                {{ $billing->tahun }}
                            </p>
                        </div>

                        <button type="button" onclick="closeModal('modal-bayar-{{ $billing->id }}')"
                            class="text-white text-2xl">×</button>
                    </div>
                </div>

                <form action="{{ route('admin.billing.bayar', $billing->id) }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-5">
                        <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                            <p class="text-xs text-slate-500">Sisa Tagihan</p>
                            <p class="font-bold text-red-700 mt-1">
                                Rp {{ number_format($billing->sisa_tagihan, 0, ',', '.') }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Tanggal Bayar
                            </label>
                            <input type="date" name="tanggal_bayar" value="{{ date('Y-m-d') }}"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Jumlah Bayar
                            </label>
                            <input type="number" name="jumlah_bayar" max="{{ $billing->sisa_tagihan }}"
                                placeholder="Masukkan jumlah bayar"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Metode Bayar
                            </label>
                            <select name="metode_bayar"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
                                required>
                                <option value="tunai">Tunai</option>
                                <option value="transfer">Transfer</option>
                                <option value="payment_gateway">Payment Gateway</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Keterangan
                            </label>
                            <textarea name="keterangan" rows="3"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
                                placeholder="Opsional"></textarea>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <button type="button" onclick="closeModal('modal-bayar-{{ $billing->id }}')"
                            class="rounded-2xl bg-slate-100 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-200">
                            Batal
                        </button>

                        <button type="submit"
                            class="rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-8 py-3 font-bold text-[#111827] shadow hover:opacity-90">
                            Simpan Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            const modalBox = modal.querySelector('.modal-box');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalBox.classList.remove('scale-95', 'opacity-0', 'translate-y-4');
                modalBox.classList.add('scale-100', 'opacity-100', 'translate-y-0');
            }, 10);
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            const modalBox = modal.querySelector('.modal-box');

            modal.classList.add('opacity-0');
            modalBox.classList.remove('scale-100', 'opacity-100', 'translate-y-0');
            modalBox.classList.add('scale-95', 'opacity-0', 'translate-y-4');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK',
                confirmButtonColor: '#D4AF37',
                background: '#ffffff',
                color: '#111827'
            });
        @endif
    </script>
</x-app-layout>
