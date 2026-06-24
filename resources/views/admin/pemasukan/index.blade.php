<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Data Pemasukan
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Kelola seluruh pemasukan sekolah.
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- CARD TOTAL --}}
        <div class="grid md:grid-cols-3 gap-6 mb-6">

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">📥</div>

                <p class="text-sm text-slate-500">
                    Total Transaksi
                </p>

                <h3 class="text-2xl font-bold text-[#111827]">
                    {{ $pemasukans->total() }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow border border-[#F5E7B2]">
                <div class="text-3xl mb-3">💰</div>

                <p class="text-sm text-slate-500">
                    Total Pemasukan
                </p>

                <h3 class="text-2xl font-bold text-green-700">
                    Rp {{ number_format(\App\Models\Pemasukan::sum('jumlah'), 0, ',', '.') }}
                </h3>
            </div>

        </div>

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">

            <div class="p-6 flex justify-between items-center border-b border-[#F5E7B2]">

                <div>
                    <h3 class="text-xl font-bold text-[#111827]">
                        Daftar Pemasukan
                    </h3>
                </div>

                <a href="{{ route('admin.pemasukan.create') }}"
                    class="rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-5 py-3 font-bold text-[#111827]">
                    + Tambah Pemasukan
                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pemasukans as $pemasukan)
                            <tr class="border-b">

                                <td class="px-6 py-4">
                                    {{ ++$i }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($pemasukan->tanggal)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $pemasukan->kategori }}
                                </td>

                                <td class="px-6 py-4 text-green-700 font-bold">
                                    Rp {{ number_format($pemasukan->jumlah, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('admin.pemasukan.edit', $pemasukan->id) }}"
                                            class="rounded-xl bg-yellow-50 px-4 py-2 text-yellow-700 font-semibold">
                                            Edit
                                        </a>

                                        <form method="POST"
                                            action="{{ route('admin.pemasukan.destroy', $pemasukan->id) }}"
                                            class="delete-form" data-nama="{{ $pemasukan->kategori }}">

                                            @csrf
                                            @method('DELETE')

                                            <button class="rounded-xl bg-red-50 px-4 py-2 text-red-700 font-semibold">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="py-10 text-center text-slate-500">
                                    Belum ada data pemasukan.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="p-6 border-t border-[#F5E7B2]">
                {{ $pemasukans->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
