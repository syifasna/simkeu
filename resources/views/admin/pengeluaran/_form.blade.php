<div class="space-y-5">

    ```
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Tanggal
        </label>

        <input type="date" name="tanggal" value="{{ old('tanggal', $pengeluaran->tanggal ?? date('Y-m-d')) }}"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            required>

        <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Kategori
        </label>

        <input type="text" name="kategori" value="{{ old('kategori', $pengeluaran->kategori ?? '') }}"
            placeholder="Contoh: ATK, Listrik, Internet"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            required>

        <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Jumlah Pengeluaran
        </label>

        <input type="number" name="jumlah" value="{{ old('jumlah', $pengeluaran->jumlah ?? '') }}"
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
            placeholder="Opsional">{{ old('keterangan', $pengeluaran->keterangan ?? '') }}</textarea>

        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
    </div>
    ```

</div>
