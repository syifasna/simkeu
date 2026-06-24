<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Pembayaran Online
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Pembayaran SPP melalui Midtrans Sandbox.
            </p>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">
            <div class="bg-gradient-to-r from-[#111827] to-[#7A5C1E] px-8 py-6 text-white">
                <h3 class="text-xl font-bold">
                    Konfirmasi Pembayaran
                </h3>
                <p class="text-sm text-[#F5E7B2]">
                    {{ $billing->siswa->nama_siswa ?? '-' }}
                </p>
            </div>

            <div class="p-8 space-y-5">
                <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-5">
                    <p class="text-sm text-slate-500">Periode</p>
                    <p class="font-bold text-[#111827]">
                        {{ $billing->bulan }} {{ $billing->tahun }}
                    </p>
                </div>

                <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-5">
                    <p class="text-sm text-slate-500">Total Bayar</p>
                    <p class="font-bold text-red-700 text-2xl">
                        Rp {{ number_format($billing->sisa_tagihan, 0, ',', '.') }}
                    </p>
                </div>

                <button id="pay-button"
                    class="w-full rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-8 py-4 font-bold text-[#111827] shadow hover:opacity-90">
                    Bayar Sekarang
                </button>

                <a href="{{ route('admin.billing.index') }}"
                    class="block text-center rounded-2xl bg-slate-100 px-8 py-4 font-semibold text-slate-700 hover:bg-slate-200">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = "{{ route('admin.billing.index') }}";
                },
                onPending: function(result) {
                    window.location.href = "{{ route('admin.billing.index') }}";
                },
                onError: function(result) {
                    alert('Pembayaran gagal.');
                },
                onClose: function() {
                    alert('Kamu menutup popup pembayaran.');
                }
            });
        };
    </script>
</x-app-layout>
