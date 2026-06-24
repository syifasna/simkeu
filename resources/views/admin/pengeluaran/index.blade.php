<x-app-layout>

    ```
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Data Pengeluaran
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Kelola seluruh pengeluaran sekolah.
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid md:grid-cols-2 gap-6 mb-6">

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">📤</div>

                <p class="text-sm text-slate-500">
                    Total Transaksi
                </p>

                <h3 class="text-2xl font-bold text-[#111827]">
                    {{ $pengeluarans->total() }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">💸</div>

                <p class="text-sm text-slate-500">
                    Total Pengeluaran
                </p>

                <h3 class="text-2xl font-bold text-red-700">
                    Rp {{ number_format(\App\Models\Pengeluaran::sum('jumlah'), 0, ',', '.') }}
                </h3>
            </div>

        </div>

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">

            <div
                class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-[#F5E7B2]">

                <div>
                    <h3 class="text-xl font-bold text-[#111827]">
                        Daftar Pengeluaran
                    </h3>

                    <p class="text-sm text-slate-500">
                        Seluruh transaksi pengeluaran sekolah.
                    </p>
                </div>

                <a href="{{ route('admin.pengeluaran.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-5 py-3 text-[#111827] font-bold shadow hover:opacity-90">
                    + Tambah Pengeluaran
                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Tanggal</th>
                            <th class="px-6 py-4 text-left">Kategori</th>
                            <th class="px-6 py-4 text-left">Jumlah</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($pengeluarans as $pengeluaran)
                            <tr class="hover:bg-[#F8F6F0] transition">

                                <td class="px-6 py-4">
                                    {{ ++$i }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-[#111827]">
                                    {{ $pengeluaran->kategori }}
                                </td>

                                <td class="px-6 py-4 text-red-700 font-bold">
                                    Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        <button type="button" onclick="openModal('modal-{{ $pengeluaran->id }}')"
                                            class="rounded-xl bg-blue-50 px-4 py-2 text-blue-700 font-semibold hover:bg-blue-100">
                                            Detail
                                        </button>

                                        <a href="{{ route('admin.pengeluaran.edit', $pengeluaran->id) }}"
                                            class="rounded-xl bg-yellow-50 px-4 py-2 text-yellow-700 font-semibold hover:bg-yellow-100">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.pengeluaran.destroy', $pengeluaran->id) }}"
                                            method="POST" class="delete-form"
                                            data-nama="{{ $pengeluaran->kategori }}">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-xl bg-red-50 px-4 py-2 text-red-700 font-semibold hover:bg-red-100">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                    Belum ada data pengeluaran.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="p-6 border-t border-[#F5E7B2]">
                {{ $pengeluarans->links() }}
            </div>

        </div>

    </div>
    ```

</x-app-layout>
