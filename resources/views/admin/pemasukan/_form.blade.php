<div class="space-y-5">

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Tanggal
        </label>

        <input type="date" name="tanggal" value="{{ old('tanggal', $pemasukan->tanggal ?? date('Y-m-d')) }}"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            required>

        <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Kategori
        </label>

        <input type="text" name="kategori" value="{{ old('kategori', $pemasukan->kategori ?? '') }}"
            placeholder="Contoh: SPP, Donasi, Uang Gedung"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            required>

        <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Jumlah Pemasukan
        </label>

        <input type="number" name="jumlah" value="{{ old('jumlah', $pemasukan->jumlah ?? '') }}"
            placeholder="Masukkan nominal"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            required>

        <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Keterangan
        </label>

        <textarea rows="4" name="keterangan"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            placeholder="Opsional">{{ old('keterangan', $pemasukan->keterangan ?? '') }}</textarea>

        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
    </div>

</div>
