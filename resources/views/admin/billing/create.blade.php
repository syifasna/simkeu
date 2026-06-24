<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Generate Tagihan SPP
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Buat tagihan SPP berdasarkan kategori siswa.
            </p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">

            <div class="bg-gradient-to-r from-[#111827] to-[#7A5C1E] px-8 py-6 text-white">
                <h3 class="text-xl font-bold">Form Generate Tagihan</h3>
                <p class="text-sm text-[#F5E7B2]">
                    Sistem akan membuat tagihan untuk seluruh siswa aktif.
                </p>
            </div>

            <form action="{{ route('admin.billing.generate') }}" method="POST" class="p-8">
                @csrf

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Bulan
                        </label>

                        <select name="bulan"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
                            required>
                            <option value="">-- Pilih Bulan --</option>
                            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                <option value="{{ $bulan }}" {{ old('bulan') == $bulan ? 'selected' : '' }}>
                                    {{ $bulan }}
                                </option>
                            @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('bulan')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Tahun
                        </label>

                        <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
                            required>

                        <x-input-error :messages="$errors->get('tahun')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6 rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-5">
                    <p class="text-sm text-slate-600">
                        💡 Tagihan akan dihitung dari <b>biaya dasar kategori siswa</b> dikurangi
                        <b>persentase potongan</b>.
                    </p>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('admin.billing.index') }}"
                        class="rounded-2xl bg-slate-100 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-200">
                        Batal
                    </a>

                    <button type="submit"
                        class="rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-8 py-3 font-bold text-[#111827] shadow hover:opacity-90">
                        Generate Tagihan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
