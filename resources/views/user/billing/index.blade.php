<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Tagihan Saya
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Daftar tagihan SPP yang dimiliki.
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">

            <div class="p-6 border-b border-[#F5E7B2]">
                <h3 class="text-xl font-bold text-[#111827]">
                    Daftar Tagihan
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-6 py-4">Periode</th>
                            <th class="px-6 py-4">Tagihan</th>
                            <th class="px-6 py-4">Dibayar</th>
                            <th class="px-6 py-4">Sisa</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($billings as $billing)
                            <tr class="border-b">
                                <td class="px-6 py-4">
                                    {{ $billing->bulan }}
                                    {{ $billing->tahun }}
                                </td>

                                <td class="px-6 py-4">
                                    Rp {{ number_format($billing->jumlah_tagihan, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-green-700">
                                    Rp {{ number_format($billing->jumlah_dibayar, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-red-700">
                                    Rp {{ number_format($billing->sisa_tagihan, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
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

                                <td class="px-6 py-4 text-center">

                                    @if ($billing->status != 'lunas')
                                        <a href="{{ route('user.billing.pay', $billing->id) }}"
                                            class="rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-4 py-2 font-bold text-[#111827]">
                                            Bayar Online
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="p-6">
                {{ $billings->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
